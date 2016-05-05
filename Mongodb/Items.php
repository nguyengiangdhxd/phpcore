<?php

namespace Mongodb;
use Core\Common;
use Core\Translator;
use Flywheel\Queue\Queue;

/**
 * Mongodb\Items document.
 */
class Items extends \Mongodb\Base\Items
{
    const SYNC_STATUS_SUCCESS = 'SUCCESS',
        SYNC_STATUS_FAILED = 'FAILED';
    const ACTIVE = 'ACTIVE';
    const IN_ACTIVE = 'INACTIVE';

    /** @var ItemVariant[]  */
    protected $_variants = [];

    protected static $_pool = [];

    /**
     * retrieve item by original item id and customer id
     *
     * @param $item_original_id
     * @param $customer_id
     * @param $homeland
     * @return \Mongodb\Items|null
     */
    public static function retrieveByOriginalIdAndCustomerId($item_original_id, $customer_id, $homeland)
    {
        $repo = new ItemsRepository(ConnectMongoDB::getConnection());
        $om = $repo->createQuery([
            'originItemId' => $item_original_id,
            'customerId' => $customer_id,
            'homeLand' => $homeland
        ])->one();

        return $om;
    }

    /**
     * Retrieve object by id
     *
     * @param $item_id
     * @return Items|null
     */
    public static function retrieveById($item_id)
    {
        if ($obj = self::getInstanceFromPool($item_id)) {
            return $obj;
        }

        $repo = new ItemsRepository(ConnectMongoDB::getConnection());
        $obj = $repo->findOneById($item_id);
        if($obj) {
            self::addInstanceToPool($obj, $item_id);
        }
        return $obj;
    }

    /**
     * Translate item's options
     *
     * @param $original_options
     * @return array
     */
    public static function translateOptions($original_options)
    {
        $translate_options = [];
        if (!is_array($original_options)) {
            return $translate_options;
        }

        foreach($original_options as $key => $value) {
            $translate_options[$key] = [
                'name' => Translator::translateProperty($original_options[$key]['name']),
                'ordering' => $original_options[$key]['ordering']
            ];
        }

        return $translate_options;
    }

    /**
     * Translate item's specifications
     *
     * @author LuuHieu
     * @param $original_specs
     * @return array
     */
    public static function translateSpecs($original_specs)
    {
        $translated_specs = [];
        if (!is_array($original_specs)) {
            return $translated_specs;
        }

        for ($i = 0, $size = sizeof($original_specs); $i < $size; ++$i) {
            $translated_specs[] = [
                'title' => Translator::translateProperty($original_specs[$i]['title']),
                'value' => Translator::translateProperty($original_specs[$i]['value'])
                //'title' => $original_specs[$i]['title'],
                //'value' => $original_specs[$i]['value']
            ];
        }

        return $translated_specs;
    }

    /**
     * check trường hợp nếu người dùng chỉ chọn cập nhật lại giá sản phẩm thì
     * chỉ cho cập nhật lại giá của sản phẩm
     * Clone item from OriginItem
     *
     * @param OriginalItem $originalItem
     */
    public function cloneFromOriginalItem(OriginalItem $originalItem) {
        // nếu bằng true thì chỉ cho cập nhật giá của sản phẩm
         // nếu sản phẩm bằng false mới cho cập nhật
        if(!$this->getOnlyUpdatePrice()){  // chỉ có giá trị true , false or null
            $this->setOriginItemId($originalItem->getOriginalId());
            $this->setHomeLand($originalItem->getHomeLand());

            //translate title
           # $this->setTitle(Translator::translateTitle($originalItem->getTitle())); // đẩy vào background
            $this->setTitleOrigin($originalItem->getTitle());
            //need store images
            $this->setImages($originalItem->getImages());
            //translate and store specifications
           /* $specs = self::translateSpecs($originalItem->getSpecifications()); // dịch background
            $this->setSpecifications($specs);*/
            $this->setSpecifications($originalItem->getSpecifications());
            //translate and store options
           /* $options = self::translateOptions($originalItem->getOptions()); // đẩy vào background
            $this->setOptions($options);*/
            $this->setOptions($originalItem->getOptions());

            $this->setItemLocation($originalItem->getItemLocation());
            $this->setQuantitySteps($originalItem->getQuantitySteps());
            $this->setBodyImages($originalItem->getBodyImages());
            $this->setHasDiscount($originalItem->getHasDiscount());

            //seller info
            $this->setSellerId($originalItem->getSellerId());
            $this->setSellerName($originalItem->getSellerName());
            $this->setSellerHomeUrl($originalItem->getSellerHomeUrl());
            $this->setSellerImage($originalItem->getSellerImage());
            $this->setSellerPolicy($originalItem->getSellerPolicy());
            # $this->setSellerPolicy($originalItem->getSellerPolicy());
            $this->setOriginalLink($originalItem->getOriginalLink());

            if ($this->isNew()) {
                $this->setCreatedTime(new \DateTime());
            }
            $this->setModifiedTime(new \DateTime());

            $this->setOriginId($originalItem->getId()->{'$id'});
        }
        $this->setLastUpdateFromSource(new \DateTime());

        $this->save();
        $idProduct =  $this->getId()->{'$id'};
        if(!$this->getOnlyUpdatePrice()){ // nếu chỉ cập giá
            // lấy ra được id của của đối tượng vừa insert tropng database
            if(!$this->getTitle()){
                #region lấy đẩy việc dịch dữ liệu vào queue --queue dich title--
                // sau khi save xong thì bắt đầu tiến hành lưu lại giá trị của key
                $queue = Queue::factory('translate_title');// đẩy các id của đối tượng vừa insert vào trong quue
                $queue->push($idProduct); // đẩy id của đối tượng cần dịch vào queue
                #endregion
            }
            #region đẩy vào que dịch specification
            $queueSpec = Queue::factory('translate_specifications');
            $queueSpec->push($idProduct);
            #endregion
            #region-- đẩy vào queue dịch variant--
            $queueVariant = Queue::factory('translate_variants');
            $queueVariant->push($idProduct);
        }

        #endregion
        //clone variants
        $this->cloneVariantsFromOriginal($this, $originalItem);
        $this->loadVariants();
        $this->analysisOriginPriceFromVariants(); // luôn chạy trong cả 2 trường hợp
        $this->analysisOriginalSalePriceFromVariants();
    }

    /**
     * Clone variants from original
     *
     * @param Items $items
     * @param OriginalItem $originalItem
     */
    public function cloneVariantsFromOriginal(Items $items, OriginalItem $originalItem) {
        /** @var ItemVariant[] $currentVariants */
        $currentVariants = [];
        if (!$this->isNew()) {
            /** @var ItemVariant[] $t */
            $t = $items->getVariants(); // lấy toàn bộ variant theo id của item
            //assoc variants items by original keys
            foreach($t as $temp) { // theo variant item
                $currentVariants[$temp->getOriginalVariantsId()] = $temp;
            }
        }

        /** @var OriginalItemVariant[] $originalVariants */
        $originalVariants = [];
        $t = $originalItem->getVariants();
        #region -- sản phẩm đã tạo variant ảo nhưng sau đó được update variant thì xóa đi --
        if(count($t) > 1){
           foreach($t as $origin_tmp){
               /** @var \Mongodb\OriginalItemVariant $origin_tmp */
               if($origin_tmp->getHasOption() == 0){ // nếu uid == rỗng và hasOption == 0
                   OriginalItemVariant::deleteVariantHasNotOption($origin_tmp);
               }
           }
        }
        #endregion --kết thúc phần xóa varaint ảo--
        //assoc variants item by original keys
        foreach($t as $temp) { // theo origin key
            $originalVariants[$temp->getUid()] = $temp;
        }

        //save items variants follow original variants
        foreach($originalVariants as $uid => $originalVariant) {
            if(!$items->getOnlyUpdatePrice()){
                if (!isset($currentVariants[$uid])) {
                    $currentVariants[$uid] = new ItemVariant(ConnectMongoDB::getConnection());
                }
                $currentVariants[$uid]->setOriginalVariantsId($originalVariant->getUid());
                $currentVariants[$uid]->setInventoryQuantity($originalVariant->getInventoryQuantity());
                // lưu lại giá của sale price của variant từ origin variant
                $currentVariants[$uid]->setOriginalSalePrice($originalVariant->getSalePrice());
                //translate options title
                if($originalVariant->getHasOption() == 1){ // kiểm tra sản phẩm có option hay ko
                    $opts = [];
                    if (is_array($originalVariant->getOptKeys())) {
                        foreach($originalVariant->getOptKeys() as $opt_key => $opt_value) {
                            $opts[$opt_key] = [
                                'title'=> $opt_value['title'],
                                'value' => $opt_value['value']
                            ];

                        }
                    }
                    $currentVariants[$uid]->setOptKeys($opts);
                }

                $currentVariants[$uid]->setImage($originalVariant->getImage());
                if ($currentVariants[$uid]->isNew()) {
                    $currentVariants[$uid]->setCreatedTime(new \DateTime());
                }
                $currentVariants[$uid]->setModifiedTime(new \DateTime());
                $currentVariants[$uid]->setItemId($this->getId()->{'$id'});
            }
            ########## update trong mọi trường hợp #################
            $currentVariants[$uid]->setPrice($originalVariant->getPrice());
            $currentVariants[$uid]->setPricesTable($originalVariant->getPricesTable());
            $currentVariants[$uid]->setLastUpdateFromSource(new \DateTime());
            $currentVariants[$uid]->save();
            //cache variant
            $this->addVariant($currentVariants[$uid]);
        }
    }

    /**
     * @param ItemVariant $variant
     */
    public function addVariant($variant) {
        $this->addVariants([$variant]);
    }


    /**
     * @param ItemVariant[] $variants
     */
    public function addVariants($variants) {
        $cached_id = [];
        foreach($this->_variants as $variant) {
            $cached_id[] = $variant->getId()->{'$id'};
        }

        foreach($variants as $variant) {
            if (!in_array($variant->getId()->{'$id'}, $cached_id)) {
                $this->_variants[] = $variant;
            }
        }
    }

    /**
     * Get item's variants
     *
     * @return ItemVariant[]
     */
    public function getVariants()
    {
        if (empty($this->_variants)) {
            $this->loadVariants();
        }

        return $this->_variants;
    }

    /**
     * Load variants from database and set it in cached
     *
     * @return array
     */
    public function loadVariants() {
        $repo = new ItemVariantRepository(ConnectMongoDB::getConnection());
        $oms = $repo->createQuery([
            'itemId' => $this->getId()->{'$id'}
        ])->all();

        //sort by opt keys
        usort($oms, function (ItemVariant $a,ItemVariant $b) {
            $opt_keys = $a->getOptKeys();
            $opt_keys_b = $b->getOptKeys();
            foreach ($opt_keys as $key => $value) {
                if (!isset($opt_keys_b[$key])) {
                    return 1;
                }

                if ($value > $opt_keys_b[$key]) {
                    return 1;
                }
                elseif ($value < $opt_keys_b[$key]) {
                    return -1;
                }
            }
            return 0;
        });

        $this->addVariants($oms);

        return (array) $oms;
    }

    /**
     * Analysis origin price from variants
     * Save if change
     *
     * @author LuuHieu
     */
    public function analysisOriginPriceFromVariants()
    {
        if (empty($this->_variants)) {
            //LuuHieu: về sau nên làm thêm load lại danh sách variants
            return;
        }

        $min_price = $this->getMinOriginPrice();
        $max_price = $this->getMaxOriginPrice();
        foreach($this->_variants as $variant) {
            $prices_table = $variant->getPricesTable();
            if (!empty($prices_table) && isset($prices_table['CNY'])) {
                //process for prices table
                for ($j = 0, $sop = sizeof($prices_table['CNY']); $j < $sop; ++$j) {
                    $tables = $prices_table['CNY'][$j];
                    if (!$min_price || $min_price > $tables['price']) {
                        $min_price = $tables['price'];
                    }
                    if ($max_price < $tables['price']) {
                        $max_price = $tables['price'];
                    }
                }

            } else {
                if (!$min_price || $min_price > $variant->getPrice()) {
                    $min_price = $variant->getPrice();
                }

                if ($max_price < $variant->getPrice()) {
                    $max_price = $variant->getPrice();
                }
            }
        }

        if ($min_price == $max_price) {
            $max_price = 0;
        }

        $need_save = false;
        if ($min_price != $this->getMinOriginPrice()) {
            $need_save = true;
            $this->setMinOriginPrice($min_price);
        }

        if ($max_price && $max_price != $this->getMaxOriginPrice()) {
            $need_save = true;
            $this->setMaxOriginPrice($max_price);
        }

        if ($need_save) {
            $this->save();
        }
    }

    /**
     * hàm phân tích giá của salePriceOrigin để lưu vào Min và maxOriginPrice của Items
     *
     */
    public function analysisOriginalSalePriceFromVariants(){
        if (empty($this->_variants)) {
            return;
        }
        $min_original_sale_price  = $this->getMinOriginalSalePrice(); // giá trị nhỏ nhất của giá khuyến mãi
        $max_original_sale_price = $this->getMaxOriginalSalePrice(); // giá trị lớn nhất của giá khuyến mãi
        ###############lấy giá trị của các variant#####################
        foreach($this->_variants as $variant) {
            if(!$min_original_sale_price || $min_original_sale_price > $variant->getOriginalSalePrice()){
                $min_original_sale_price = $variant->getOriginalSalePrice();
            }
            if($max_original_sale_price < $variant->getOriginalSalePrice()){
                $max_original_sale_price = $variant->getOriginalSalePrice();
            }
        }
        if ($min_original_sale_price == $max_original_sale_price) {
            $max_original_sale_price = 0;
        }
        $need_save = false;
        if ($min_original_sale_price != $this->getMinOriginalSalePrice()) {
            $need_save = true;
            $this->setMinOriginalSalePrice($min_original_sale_price);
        }

        if ($max_original_sale_price && $max_original_sale_price != $this->getMaxOriginalSalePrice()) {
            $need_save = true;
            $this->setMaxOriginalSalePrice($max_original_sale_price);
        }
        if ($need_save) {
            $this->save();
        }

    }

    /**
     * get Original item linked with this item
     *
     * @author LuuHieu
     * @return OriginalItem|null
     * @throws \MongoException
     */
    public function getOriginalItem()
    {
        $repo = new OriginalItemRepository(ConnectMongoDB::getConnection());
        $om = $repo->findOneById($this->getOriginId());
        if (!$om) {
            throw new \MongoException('Original item not found with id' .$this->getOriginId());
        }
        return $om;
    }

    /**
     * Get main image's url
     *
     *
     * @author LuuHieu
     * @return string
     */
    public function getMainImgUrl()
    {
        $url = '';
        $images = (array) $this->getImages();
        foreach($images as $image) {
            if ($image['main']) {
                $url = $image['src'];
            }
        }

        if (!$url && isset($images[0])) {
            $url = @$images[0]['src'];
        }
        return $url;
    }

    /**
     * @param $app_key
     * @param $value
     * @author kiennx
     */
    public function setIntegration($app_key, $value){
        $integration = $this->getIntegrationItems();
        $integration[$app_key] = $value;
        $this->setIntegrationItems($integration);
    }

    /**
     * @param $app_key
     * @return array|mixed
     * @author kiennx
     */
    public function getIntegration($app_key){
        $integration = $this->getIntegrationItems();
        if (isset($integration[$app_key])) {
            return $integration[$app_key];
        }
        return [];
    }

    /**
     * @param $app_key
     * @param $key
     * @return null|mixed
     */
    public function getIntergrationValue($app_key, $key) {
        $intergration = $this->getIntegrationItems();
        if (isset($intergration[$app_key])) {
            if (isset($intergration[$app_key][$key])) {
                return $intergration[$app_key][$key];
            }
        }
        return null;
    }

    /**
     * Lấy ảnh đại diện cho sản phẩm
     * @return string
     */
    public function getAbstractImage() {
        $images = $this->getImages();
        if (is_array($images) && count($images) > 0) {
            foreach ($images as $image) {
                if ($image['main'] === "true") {
                    return $image;
                }
            }
            $image = $images[0];
            return $image;
        }
        return '';
    }

    /**
     * Save the document.
     *
     * @param array $options The options for the batch insert or update operation, it depends on if the document is new or not (optional).
     *
     * @return \Mandango\Document\Document The document (fluent interface).
     *
     * @api
     */
    public function save(array $options = array())
    {
        $obj = parent::save($options); // TODO: Change the autogenerated stub
        self::addInstanceToPool($obj, $obj->getId()->{'$id'});
        return $this;
    }


    /**
     * retrieve instance from static
     *
     * @param $id
     * @return null | \Mongodb\ItemsSalePriceFile
     */
    public static function getInstanceFromPool($id)
    {
        return isset(self::$_pool[$id])? self::$_pool[$id] : null;
    }

    /**
     * @param $obj
     * @param $id
     */
    public static function addInstanceToPool($obj, $id)
    {
        self::$_pool[$id] = $obj;
    }

    /**
     * nếu nhập vào giá min mà min nhỏ hơn giá min của item thì mới thay đổi giá trị min
     * cập nhật lại giá bán lớn nhất hoặc nhỏ nhất của sản phẩm khi cập nhật lại variant
     * @param \Mongodb\Items $item
     */
    public static function updatePriceFromVariant($item){
        $minPriceSale = $item->getMinPriceSale();
        $maxPriceSale = $item->getMaxPriceSale();
        $repo = new ItemVariantRepository(ConnectMongoDB::getConnection());
        $variantItems = $repo->createQuery([
            'itemId' => $item->getId()->{'$id'}
        ])->all();
        /** @var \Mongodb\ItemVariant $variant */
        $price_variant = [];
        foreach($variantItems as $variant){
            $price_variant[] = $variant->getSalePrice();
        }
        $min_price_variant = min($price_variant);
        $max_price_variant = max($price_variant);
        if(!$minPriceSale){ // nếu giá trị không tồn tại thì mặc định sẽ là giá nhỏ nhất của variant
            $item->setMinPriceSale($min_price_variant);
        }
        if($minPriceSale > $min_price_variant){
            $item->setMinPriceSale($min_price_variant);
        }
        if($maxPriceSale < $max_price_variant){
            $item->setMaxPriceSale($max_price_variant);
        }
        $item->save();
    }

    /**
     * overwirte lai ham dich tieu de
     * @param mixed $value
     * @param bool $is_user_edit
     * @return Items|void
     */
    public function setTitle($value ,$is_user_edit = true){
        parent::setTitle($value);
        $this->setIsAutoTranslate($is_user_edit);
    }

    /**
     * hàm lưu giá trị tags của sản phẩm giá trị truyền vào có thể là string hoặc mảng
     * @param $value
     */
    public function setTagsFromString($value){
        $tagProduct = Common::analysisTag($value);
        $this->setTagsProduct($tagProduct);
    }

    /**
     * save lưu lại option sản phẩm và đánh dấu là dịch bằng tay
     * @param $value
     * @param bool $is_user_edit
     * @return Items|void
     */
    public function setOptions($value ,$is_user_edit = true){
        parent::setOptions($value);
        $this->setIsAutoTranslateOption($is_user_edit);
    }

}