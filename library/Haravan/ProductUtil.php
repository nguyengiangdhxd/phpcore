<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2/15/2016
 * Time: 3:39 PM
 */

namespace Haravan;


use BizWeb\ItemIntegrationData;
use BizWeb\ItemVariantIntegrationData;
use Core\IntergrationApp\UrlHelper;
use Core\Logger;
use Flywheel\Exception;
use Mongodb\ConnectMongoDB;
use Mongodb\ItemVariant;
use Mongodb\ItemVariantRepository;

class ProductUtil {

    const APP_KEY = 'HARAVAN';
    /**
     * Lưu lại giá trị trả về của variant trong đối tượng
     * @param $variantsResponse
     * @param $mapping
     */
    public static function saveIntegrationItemVariantResponse( $variantsResponse, $mapping){
        foreach($variantsResponse as $variantResponse){
            $position = $variantResponse['position'];
            /** @var \Mongodb\ItemVariant $variant */
            $variant = $mapping[$position]; // tại vị trí 1 này trả về một đối tượng trong variant
            if($variant) {
                $integrationVariant = $variant->getIntegration(HaravanService::HARAVAN_KEY);
                $integrationDataVariant = new ItemVariantIntegrationData($integrationVariant);
                $integrationDataVariant->setVariantId((string) $variantResponse['id']);
                $integrationDataVariant->setStatus(\Mongodb\ItemVariant::SYNC_STATUS_SUCCESS);
                $integrationDataVariant->setLastSuccessSync(new \MongoDate((new \DateTime())->getTimestamp()));
                $integrationDataVariant->setLastSync(new \MongoDate((new \DateTime())->getTimestamp()));



                // lưu lại id trả về của sản phẩm
                $variant->setIntegration(HaravanService::HARAVAN_KEY, $integrationDataVariant->toArray());
                $variant->save();
            }
        }
    }

    /**
     * Lưu lại response khi đồng bộ nên web dịch vụ
     * @param \mongodb\Items $productIDE
     * @param $dataResponse
     * @param $variantMapping
     * @param $dataToPost
     */
    public static function saveProductIntegration(\mongodb\Items $productIDE, $dataResponse, $variantMapping , $dataToPost)
    {
        if ($dataResponse && isset($dataResponse['id'])) {
            $integrationData = $productIDE->getIntegration(HaravanService::HARAVAN_KEY);
            $integrationData = new ItemIntegrationData($integrationData);
            $integrationData->setProductId((string) $dataResponse['id']);
            $integrationData->setStatus(\Mongodb\Items::SYNC_STATUS_SUCCESS);
            $integrationData->setLastSuccessSync(new \MongoDate((new \DateTime())->getTimestamp()));
            $integrationData->setLastSync(new \MongoDate((new \DateTime())->getTimestamp()));
            // lưu lại id trả về của sản phẩm
            $productIDE->setIntegration(HaravanService::HARAVAN_KEY, $integrationData->toArray());
            $productIDE->setSyncProcess(false);
            $productIDE->save();

            if (isset($dataResponse['variants'])) {
                self::saveIntegrationItemVariantResponse($dataResponse['variants'], $variantMapping);
            } else {
                // nếu ko tồn tại giá trị trả về thì đang lỗi
            }

        } else {
            $integrationData = $productIDE->getIntegration(HaravanService::HARAVAN_KEY);
            $integrationData = new ItemIntegrationData($integrationData);

            $integrationData->setStatus(\Mongodb\Items::SYNC_STATUS_FAILED);
            $integrationData->setLastSync(new \MongoDate((new \DateTime())->getTimestamp()));
            //TODO: lưu lý do lỗi vấn đề này đã được xử lý bằng cách gửi mail đến quản trị

            $productIDE->setIntegration(HaravanService::HARAVAN_KEY, $integrationData->toArray());
            //có lỗi trả về, vẫn set sync process về false nhưng có thông báo lỗi
            $productIDE->setSyncProcess(false);
            $productIDE->save();
            ############ GỬI MAIL BÁO LỖI ################
            $logger = Logger::factory('Haravan');
            $logger->addError('Lỗi không đồng bộ được sản phẩm', [ 'response' => $dataResponse , 'productId' => $productIDE->getId()->{'$id'} , 'params' =>$dataToPost]);
        }
    }

    /**
     * hàm này nếu có nhiều hơn 3 option thì các option cuối sẽ được gộp lại vào option 3 , hạn chế gửi lên quá nhiều option
     * @param \Mongodb\Items $item
     * @return array
     */
    public static function getOptions($item)
    {
        $optionBizWeb = [];
        if($item->getOptions()) {
            $optionIDEs = self::compareOptionItemsAndVariant($item);
            if (count($optionIDEs) <= 3) {
                foreach ($optionIDEs as $key => $option) {
                    $optionBizWeb[] = ['name' => $option['name']];
                    //$optionIndex[$key] = count($optionBizWeb); //count sau vì tính từ 1 chứ không phải từ 0
                }
            } else {
                $tmp = [];
                foreach ($optionIDEs as $key => $val) {
                    $tmp[] = $val['name'];
                }
                $optionBizWeb = [
                    ['name' => $tmp[0]],
                    ['name' => $tmp[1]],
                ];
                unset($tmp[0]);
                unset($tmp[1]);
                $optionBizWeb [] = ['name' => implode(' - ', $tmp)];
            }
        }
        return $optionBizWeb;
    }

    /**
     * hàm truyền vào mã hóa md5 của src gửi lên , nếu có mã hóa đó thì trả lại Id của ảnh
     * tương ứng
     * @param \Mongodb\Items $product
     * @param $image
     * @return string
     */
    public static function getIntegrationBizWeb($product, $image){
        $integrations = $product->getIntegration(self::APP_KEY);
        if(isset($integrations['image_key'])){
            if(count($integrations['image_key']) > 0){
                $image_key = $integrations['image_key'][md5($image)];
                return $image_key;
            }else{
                return '';
            }
        }else{
            return '';
        }
    }

    /**
     * @param \Mongodb\Items $item
     * @param ItemVariant[] $variants
     * @return array
     */
    public static function getImages(\Mongodb\Items $item, $variants){
        //mảng ảnh sẽ bao gồm cả ảnh sản phẩm chung lấy từ item và ảnh variant lấy từ itemVariant

        $imageBizWeb = [];
        $imageMapping = [];

        #region -- ảnh chung --
        $countImageIDEs = 0;
        $integration_image = $item->getIntegration(self::APP_KEY);
        $img_item_key = [];
        $imageIDEs = self::removeDuplicateImage($item);
        foreach($imageIDEs as $itemImage){
            $countImageIDEs++;
            $imageUrl = $itemImage['src'];
            $imageUrl = UrlHelper::normalizeImageUrl($imageUrl);
            $img_item_key[] = $imageUrl;
            // đẩy dữ liệu vào bên trong mảng
            try{
                if(isset($integration_image['image_key']) && count($integration_image['image_key']) > 0){
                    // nếu có tồn tại thì đã từng đồng bộ thành công và trả về ids
                    $imageID = self::getIntegrationBizWeb($item , $imageUrl);
                    $imageMapping[$imageUrl] = ['src' => $imageUrl , 'position' => $countImageIDEs , 'id' => $imageID ];
                }else{
                    $imageMapping[$imageUrl] = ['src' => $imageUrl , 'position' => $countImageIDEs]; // bổ sung gửi thêm giá trị
                }
            }catch (Exception $e){
                $imageMapping[$imageUrl] = ['src' => $imageUrl , 'position' => $countImageIDEs]; // bổ sung gửi thêm giá trị
            }

        }
        #endregion

        #region -- ảnh riêng --
        foreach ($variants as $itemVariant) {
            $integration = $itemVariant->getIntegration(HaravanService::HARAVAN_KEY);
            $integration = new ItemVariantIntegrationData($integration);
            $bizwebVariantId = $integration->getVariantId();

            $imageUrl = $itemVariant->getImage();
            if(!in_array(UrlHelper::normalizeImageUrl($imageUrl),$img_item_key)){ // nếu key đó ko tồn tại trong mảng thì mới tăng chỉ số
                $countImageIDEs++;
            }
            if (!$bizwebVariantId) {
                continue; //nếu chưa có variant thì không cần ảnh này
            }

            if ($imageUrl) {
                $imageUrl = UrlHelper::normalizeImageUrl($imageUrl);
                if (isset($imageMapping[$imageUrl]['variant_ids'])) { // nếu đã có mảng variant_ids rồi thì thêm vào
                    $imageMapping[$imageUrl]['variant_ids'][] = (int)$bizwebVariantId; // gộp thêm mảng [$id] vào
                    if(self::getIntegrationBizWeb($item , $imageUrl)){ // id ảnh
                        $imageMapping[$imageUrl]['id'] = self::getIntegrationBizWeb($item , $imageUrl);
                    }
                } else { // nếu chưa có thì tạo mảng mới
                    $imageMapping[$imageUrl] = [
                        'src' => $imageUrl,
                        'variant_ids' => [(int)$bizwebVariantId],
                        'position' => $countImageIDEs
                    ];
                    if( self::getIntegrationBizWeb($item , $imageUrl)){ // gửi lên id ảnh
                        $imageMapping[$imageUrl]['id'] = self::getIntegrationBizWeb($item , $imageUrl);
                    }
                }
            }
        }
        #endregion

        //sau khi có một mảng ảnh thống nhất thì chuyển sang dạng dữ liệu bizweb
        foreach ($imageMapping as $image) {
            $imageBizWeb[] = $image;
        }

        Logger::factory('harvan-image')->addDebug('ảnh của sản phẩm',['params' => $imageBizWeb]);
        return $imageBizWeb;
    }


    /**
     * Nội dung sản phẩm
     * @param \Mongodb\Items $item
     * @return string
     */
    public static function getContent(\Mongodb\Items $item){
        $render = new \Flywheel\View\Render();
        $template = GLOBAL_TEMPLATES_PATH . '/product_description';

        $body = $render->render($template, ['item' => $item]);
        //$body = implode(",", $item->getBodyImages());

        return $body;
    }

    /**
     * hàm xử lý xóa mảng nếu key trong mảng trùng nhau
     * @param \Mongodb\Items $item
     * @return array
     */
    public static function removeDuplicateImage($item){
        $images = $item->getImages();
        if(count($images) <= 1){
            return $images;
        }
        for($i = 0 ; $i < (count($images) - 1) ; $i++){
            for($j = $i+1 ; $j < count($images); $j++){
                if($images[$i]['src'] == $images[$j]['src']){
                    unset($images[$i]);
                }
            }
        }
        return $images;
    }

    /**
     * Hàm lưu lại id của ảnh trên haravan khi tra ve du lieu
     * @param \Mongodb\Items $product
     * @param $imageResponses
     * @param $dataToPostImg
     * @throws \Exception
     */
    public static function saveImagesIds($product , $imageResponses ,  $dataToPostImg){

        //dựa vào trường src của data post lên để ghi vào mapping
        // image_mapping[md5(src)] = responseId
        $image_img = [];
        foreach($imageResponses as $remote_image){
            $remote_pos = $remote_image['position'];
            $image_data = $dataToPostImg["images"];

            foreach ($image_data as $image) {
                $posted_pos = $image['position'];

                if ($posted_pos == $remote_pos) {
                    //found it
                    $image_img[md5($image['src'])] = $remote_image['id'];
                }
            }
        }
        $integrationData = $product->getIntegration(HaravanService::HARAVAN_KEY);
        $integrationData = new ItemIntegrationData($integrationData);
        $integrationData->setLastSuccessSync(new \MongoDate((new \DateTime())->getTimestamp()));
        if(isset($image_img)){
            $integrationData->setImageKey($image_img);
        }
        $product->setIntegration(HaravanService::HARAVAN_KEY, $integrationData->toArray());
        $product->save();
    }

    /**
     * nếu option của item lớn hơn của variant thì hủy đi
     * @param \Mongodb\Items $item
     * @return mixed
     */
    public static function compareOptionItemsAndVariant(\Mongodb\Items $item){
        $optionIDEs = $item->getOptions();#$opt_keys as $key => $val
        $option_key_option = [];
        foreach($optionIDEs as $key => $val ){
            $option_key_option[] = $key;
        }
        // lấy các opton key của variant tương ứng
        $repo = new ItemVariantRepository(ConnectMongoDB::getConnection());
        $variants = $repo->createQuery([
            'itemId' => $item->getId()->{'$id'}
        ])->all();
        foreach($variants as $variant ){
            /** @var \Mongodb\ItemVariant $variant */
            $opt_keys = $variant->getOptKeys();
            $opt_key_variant = [];
            foreach($opt_keys as $k => $v){
                $opt_key_variant[] = $k;
            }
            if(count($option_key_option) > count($opt_key_variant)){
                $keyDifferent =  implode(',',array_diff($option_key_option,$opt_key_variant));
                unset($optionIDEs[$keyDifferent]);
            }
            // merge 2 mảng , nếu có mảng merge đó lớn hơn ko thì uset gía trị của nó đi
        }
        return $optionIDEs;
    }

    /**
     * Lấy về dữ liệu variants
     * @param \Mongodb\Items $item
     * @param array $variantMapping
     * @return array
     */
    public static function getVariants(\Mongodb\Items $item, &$variantMapping) {
        $variantMapping = []; //Tạo ra mảng mapping
        $variantsBizWeb = [];
        /** @var \MongoDB\ItemVariant[] $itemVariants */
        $itemVariants = $item->getVariants();
        $optionVariants = [];
        if($itemVariants){
            $variantIndex = 1;
            foreach($itemVariants as $itemVariant){
                if($itemVariant->getOptKeys()){
                    $opt_keys = $itemVariant->getOptKeys();
                    $optionIndex = 1;
                    #region -- Option keys --
                    if(count($opt_keys) <= 3){
                        foreach ($opt_keys as $key => $val) {
                            if(strlen($val['title']) > 49){ // nếu chuỗi dài hơn 50 thì cắt
                                $newValue =  substr($val['title'], 0, 49);
                            }else{
                                $newValue = $val['title'];
                            }
                            $optionVariants['option'.$optionIndex] = $newValue;
                            $optionIndex++;
                        }
                    }else{
                        $tmp = [];
                        foreach($opt_keys as $key => $val){
                            $tmp[] = $val['title'];
                        }
                        // nếu chiều dài của chuỗi lớn hơn 49 thì cắt : chỉ hỗ trợ chiều dài giữ 0 - 50
                        if(strlen($tmp[0]) > 49 ){
                            $tmp[0] =  substr($tmp[0], 0, 49);
                        }
                        if(strlen($tmp[1]) > 49){
                            $tmp[1] = substr($tmp[1], 0, 49);
                        }

                        $optionVariants = [
                            'option1' => $tmp[0],
                            'option2' => $tmp[1]
                        ];
                        unset($tmp[0]);
                        unset($tmp[1]);
                        $strLengthRestArray = implode(' - ',$tmp);
                        if(strlen($strLengthRestArray) > 49 ){
                            $strLengthRestArray = substr($strLengthRestArray, 0, 49);
                        }
                        $optionVariants[] = ['option3' => $strLengthRestArray];
                    }

                }else{
                    $optionVariants = [];
                }
                #endregion

                #region -- Tao doi tuong variant gui len Bizweb; Update neu da co id --
                $integrationData = $itemVariant->getIntegration(HaravanService::HARAVAN_KEY);
                $integrationData = new ItemVariantIntegrationData($integrationData);
                $id = $integrationData->getVariantId();

                $salePrice = $itemVariant->getSalePrice();
                $sku = $itemVariant->getSku();

                $bizwebVariant =  [
                        'sku' => $sku ? $sku : '',
                        'price' => $salePrice ? $salePrice : 0,
                        'position' => $variantIndex,
                    ]+ $optionVariants;

                if ($id) {
                    $bizwebVariant['id'] = $id;
                }

                $variantsBizWeb[] = $bizwebVariant;
                #endregion

                $variantMapping[$variantIndex] = $itemVariant;
                $variantIndex++;
            }
        }

        return $variantsBizWeb;
    }

   /* public static function sendImageToService(\Mongodb\Items $product,$dataResponse){
        // check điều kiện để push hay để post giá trị
        $integration = $product->getIntegration(self::APP_KEY);
        if(!$integration){
            $dataResponse = _client->call('PUT',"/admin/products/$productId.json",['product'=> $dataToPost]);
        }
    }*/




}