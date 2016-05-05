<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 12/24/2015
 * Time: 8:44 AM
 */

namespace Customer\Controller;

use Comment\ItemsActivityLogger\ItemsLog;
use Core\Common;
use Core\CustomerAuth;
use Flywheel\Exception;
use Mongodb\ConnectMongoDB;
use Excel\TemplateExportExcel as excel;
use Mongodb\CustomerProfilesRepository;
use Mongodb\Items;
use Mongodb\ItemsRepository;
use Mongodb\ItemVariantRepository;
use PHPExcel_Style_NumberFormat;


class ProductList extends  CustomerBase{

    const SITE_TMALL = "TMALL";
    const SITE_ALIBABA = "1688";
    const ACTIVE = 'ACTIVE';
    const IN_ACTIVE = 'INACTIVE';
    # app service đã cài
    const APP_KEY_HARAVAN = 'HARAVAN';
    const APP_KEY_BIZWEB = 'BIZWEB';
    const APP_ALL = 'ALL';// cài cả 2
    const APP_EMPTY = 'EMPTY'; // nothing install service



    public function executeDefault()
    {
        $keyword = $this->get('keyword');
        $site_original = $this->get('siteOriginal');
        $seller_name = $this->get('seller_name');
        $product_title = $this->get('product_title');
        $product_id = $this->get('product_id');// id sản phẩm gốc
        $from_price_origin = $this->get('from_price_origin');
        $to_price_origin = $this->get('to_price_origin');
        $status = $this->get('status');
        $sys = $this->get('sys');
        $page = $this->get('page');
        $hasSys = $this->request()->get('hasSys','STRING','');
        $from_price_sale = $this->get('from_price_sale');
        $to_price_sale = $this->get('to_price_sale');

        if(!$page){
            $page = 1;
        }
        $this->setLayout('default');  // đã xét nmsgu
        /*$this->setView( 'Product/list' );*/
        $this->setView( 'Product/product_list' );
        $this->document()->title = 'Danh sách sản phẩm';
        $this->view()->assign('product_list', $this->createUrl('/product_list'));
        $array_data_condition= [];
        $array_data_condition['from_price_sale'] = $from_price_sale;
        $array_data_condition['to_price_sale'] = $to_price_sale;
        $array_data_condition['keyword'] = $keyword;
        $array_data_condition['page'] = $page;
        $array_data_condition['siteOriginal'] = $site_original;
        $array_data_condition['seller_name'] = $seller_name;
        $array_data_condition['product_title'] = $product_title;
        $array_data_condition['product_id'] = $product_id;
        $array_data_condition['from_price_origin'] = $from_price_origin;
        $array_data_condition['to_price_origin'] = $to_price_origin;
        $array_data_condition['status '] = $status;
        #$array_data_condition['sys'] = $sys;
        $array_data_condition['hasSys'] = $hasSys;

        // lấy điều kiện ktra xem người dùng đã cài mấy web dịch vụ

        $this->view()->assign(
            $array_data_condition
        );
        return $this->renderComponent();
    }

    /**
     * hàm trả về giá ds items
     * @return string
     */
    public function executeGetListItem(){
        $keyword = $this->get('keyword','STRING','');
        $site_original = $this->get('siteOriginal','STRING' ,'');
        $seller_name = $this->get('seller_name','STRING','');
        $product_id = $this->get('product_id','STRING','');// id sản phẩm gốc
        $from_price_origin = $this->get('from_price_origin');
        $to_price_origin = $this->get('to_price_origin');
        $from_price_sale = $this->get('from_price_sale');
        $to_price_sale = $this->get('to_price_sale');
        $page = $this->get('page');
        $hasSys = $this->request()->get('hasSys','STRING','');
        ##################################
        ###       sort giá trị         ###
        ##################################
        $sortConditionName = $this->get('sortCondition');
        $sortCondition = $this->get('condition','INT');



        if(!$page){
            $page = 1;
        }
        $customerId = CustomerAuth::getInstance()->getCustomer()->getId();
        $conditional = [];
        $conditional['$or'] = [['isDeleted' =>['$exists' => false]],['isDeleted' => false]];//isDeleted
        $conditional['customerId'] = $customerId;
        /**
         * tìm theo keyWord
         */
        if($keyword){
           if(\MongoId::isValid($keyword)){
               $conditional['_id'] = new \MongoId($keyword);
           }else{
               $conditional['title'] = ['$regex' => $keyword];
           }
        }
        /**
         * đã đồng bộ hay chưa
         */
        if($hasSys){
            if($hasSys == 'has_sys'){
                $conditional['integrationItems']= ['$exists' => true];
            }
            if($hasSys == 'not_has_sys'){
                $conditional['integrationItems']= ['$exists' => false];
            }
        }
        /**
         * site gốc
         */
        if($site_original){
            $conditional['homeLand'] =  $site_original;
        }
        if($seller_name){
            $conditional['sellerName'] = ['$regex' => $seller_name]; // tên người bán
        }
        if($product_id){
            $conditional['originItemId'] = ['$regex' => $product_id];
        }
        // tìm theo giá gốc
        if($from_price_origin != null || $to_price_origin != null){
            if($from_price_origin != null){
                $conditional['minOriginPrice'] =['$gte' => floatval($from_price_origin)];
            }
            if($to_price_origin != null){
                $conditional['maxOriginPrice'] = ['$lte' =>  floatval($to_price_origin)];
            }
        }
        // tìm theo giá bán
        if($from_price_sale != null || $to_price_sale != null){
            if($from_price_sale != null){
                $conditional['minPriceSale'] = ['$gte' => floatval($from_price_sale)];
            }
            if($to_price_sale){
                $conditional['maxPriceSale'] = ['$lte' => floatval($to_price_sale)];
            }
        }
        // sort theo thời gian
        $sortTimed = [];
        if(!$sortConditionName && !$sortCondition){
            $sortTimed= array('createdTime'=> -1);
        }else if($sortConditionName && $sortCondition){
            $sortTimed = array($sortConditionName => $sortCondition);
        }

        #originItemId

        $load_more = false;
        $totalResult = 0;
        $limit = 20;
        $list_items = $this->_getListProduct($totalResult,$sortTimed, $load_more,$conditional, $page, $limit );
        $ajax = new \AjaxResponse();
        $ajax->type = \AjaxResponse::SUCCESS;
        $ajax->data = array( 'list_items' => $list_items );
        $ajax->web_service = $this->_getIntegrationOfUser();
        $ajax->total_product = $totalResult;
        $ajax->total_page = ceil( $totalResult / $limit );
        $ajax->page = $page;
        $ajax->load_more = $load_more;
        return $this->renderText( $ajax->toString() );
    }

    /**
     * @author nguyenhoanggiang
     * get integration of user
     */
    public function _getIntegrationOfUser()
    {
        $key_biz = strtolower(self::APP_KEY_BIZWEB);
        $key_haravan = strtolower(self::APP_KEY_HARAVAN);
        $customerId = CustomerAuth::getInstance()->getCustomer()->getId();
        $customer_repo = new CustomerProfilesRepository(ConnectMongoDB::getConnection());
        $customerObj = $customer_repo->createQuery(['customerId' => $customerId])->one();
        /** @var  \Mongodb\CustomerProfiles $customerObj */
        $integrations = $customerObj->getIntegration();
        $value_haravan = array_key_exists ( $key_haravan , $integrations );
        $value_biz = array_key_exists ( $key_biz , $integrations );
        if($value_biz && $value_haravan){
            return self::APP_ALL;
        }
        if($value_haravan && !$value_biz){
            return self::APP_KEY_HARAVAN;
        }
        if($value_biz && !$value_haravan){
            return self::APP_KEY_BIZWEB;
        }
        if(!$value_biz && !$value_haravan){
            return self::APP_EMPTY;
        }
        return self::APP_EMPTY;
    }

    /**
     * trả về mảng các items
     * @param $total_result
     * @param array $sortTime
     * @param $load_more
     * @param array $conditional
     * @param int $page
     * @param int $limit
     * @return array
     */
    private function _getListProduct(&$total_result,$sortTime = array() ,&$load_more, $conditional = array(), $page = null, $limit){

        $from = ($page - 1) * $limit;
        $mandango = ConnectMongoDB::getConnection();
        $itemRepo = new \Mongodb\ItemsRepository($mandango);
        $total_result = $list_items_product = $itemRepo->createQuery()
            ->criteria($conditional)->count();
        $list_items_product = $itemRepo ->createQuery()
            ->criteria($conditional)
            ->sort($sortTime)  #->sort(array('createdTime' => -1))
            ->skip($from)
            ->limit($limit);

        if ($total_result <= ($from + $limit)) {
            $load_more = false;
        } else {
            $load_more = true;
        }
        $list_items = [];
        $number = 1;
        foreach($list_items_product as $itemProduct){
            $number++;
          /** @var \MongoDb\Items $itemProduct */
            $image = $itemProduct->getAbstractImage();
            $tmp_data = $itemProduct->toArray();
            $tmp_data['image'] = $image;
            $tmp_data['idItem'] = $itemProduct->getId()->{'$id'};
            // nếu ko có giá trị max và min thì thì lấy giá trị tiền lớn nhất và nhỏ nhất của các ItemVariant
            if($itemProduct->getMinOriginPrice() && !$itemProduct->getMaxOriginPrice()){
                $tmp_data['price_origin'] = $itemProduct->getMinOriginPrice();
            }
            if($itemProduct->getMaxOriginPrice() && !$itemProduct->getMinOriginPrice()){
                $tmp_data['price_origin'] = $itemProduct->getMaxOriginPrice();
            }
            if($itemProduct->getMinOriginPrice() && $itemProduct->getMaxOriginPrice()){
                $tmp_data['has_price'] = true;
                $tmp_data['max_price'] = $itemProduct->getMaxOriginPrice();
                $tmp_data['min_price'] = $itemProduct->getMinOriginPrice();
            }
            #region --lấy giá của sale price --
            if($itemProduct->getMinOriginalSalePrice() && !$itemProduct->getMaxOriginalSalePrice() ){
                $tmp_data['has_sale_price'] = true;
                $tmp_data['has_sale_price_min'] = true;
                $tmp_data['min_origin_sale_price'] = $itemProduct->getMinOriginalSalePrice();
            }
            if($itemProduct->getMaxOriginalSalePrice() && !$itemProduct->getMinOriginalSalePrice()){
                $tmp_data['has_sale_price'] = true;
                $tmp_data['has_sale_price_max'] = true;
                $tmp_data['max_origin_sale_price'] = $itemProduct->getMaxOriginalSalePrice();
            }
            if($itemProduct->getMaxOriginalSalePrice() && $itemProduct->getMinOriginalSalePrice()){
                $tmp_data['has_sale_price'] = true;
                $tmp_data['has_sale_price_min_max'] = true;
                $tmp_data['min_origin_sale_price'] = $itemProduct->getMinOriginalSalePrice();
                $tmp_data['max_origin_sale_price'] = $itemProduct->getMaxOriginalSalePrice();
            }
            #endregion
            $tmp_data['integration'] = $itemProduct->getIntegrationItems();
            $active = $itemProduct->getIsActive();
            if($active == self::ACTIVE){
                $tmp_data['active'] = true;
            }
            $tmp_data['status_active'] = $itemProduct->getIsActive();
            $inter = $itemProduct->getIntegrationItems();
            if($itemProduct->getIntegrationItems()){
                $tmp_data['had_sys'] = true;
                foreach($inter as $key => $val) {
                    $tmp_data['integration_product'][$key]['server_sys'] = $key;
                    if($val['status'] == 'FAILED'){
                        $tmp_data['integration_product'][$key]['status_sys'] = 'thất bại';
                        $tmp_data['integration_product'][$key]['approval_status_fail'] = true;
                        $tmp_data['sys_webservice_false'] = true;
                    }elseif($val['status'] == 'SUCCESS'){
                        $tmp_data['integration_product'][$key]['status_sys'] = 'thành công';
                        $tmp_data['integration_product'][$key]['approval_status_success'] = true;
                        $tmp_data['integration_product'][$key]['service_id'] = $val['product_id'];// chuyển từ bizweb_id sang
                    }
                    $tmp_data['integration_product'][$key]['time_sys'] = date('H:i d/m/Y',$val['last_sync']->sec);
                }
            }
            $tmp_data['favicon_service'] = $this->_getFavicon($itemProduct->getHomeLand());
            if($itemProduct->getTitle()){
                $tmp_data['has_title'] = true;
            }
            $tmp_data['integration_service'] = $this->_getIntegrationOfUser();
            // lấy giá trị của đơn
            $list_items[] = $tmp_data;
        }
        return $list_items;
    }

    /**
     * trả về favicon của webService
     * @param $homeLand
     * @return mixed
     */
    private function _getFavicon($homeLand){
        $arrFavicon = [
            'TAOBAO' =>'http://www.google.com/s2/favicons?domain=http://taobao.com',
            'TMALL' => 'http://www.google.com/s2/favicons?domain=http://tmall.com',
            '1688' => 'http://www.google.com/s2/favicons?domain=http://1688.com'
        ];
        return $arrFavicon[$homeLand];
    }

    /**
     *lấy các variant theo id của product
     * @return string
     */
    public function executeGetItemsVariantFollowItem(){
        $ajax = new \AjaxResponse();
        $item_id = $this->request()->post('id');
        if(!$item_id){
            $ajax->type =  \AjaxResponse::ERROR;
            $ajax->message = 'Mã sản phẩm không tồn tại !';
            return $this->renderText($ajax->toString());
        }
        $repo = new ItemsRepository(ConnectMongoDB::getConnection());
        /** @var \Mongodb\Items $item */
        $item = $repo->findOneById($item_id);
        $image = $item->getAbstractImage();
        // lấy được đối tượng id
        $list_item_variants = $this->_getItemVariants($item);


        //
        $ajax->data = ['list_variants' => $list_item_variants,'items' => $this->_getItems($item)];
        $ajax->message = 'Lấy được variant';
        $ajax->type = \AjaxResponse::SUCCESS;
        return $this->renderText($ajax->toString());
    }

    /**
     * lấy ra mảng giá trị của item
     * @param $item
     * @return array
     */
    private function _getItems($item){
        /** @var \Mongodb\Items  $item*/
        $arrItems = [];
        $arrItems = $item->toArray();
        if($item->getTagsProduct()){
            $arrItems['tags_product'] = implode(',',$item->getTagsProduct()); // thay đổi cấu trúc và trường lưu tag của các sản phẩm trước đó
        }

        $arrItems['image'] = $item->getAbstractImage();
        if($item->getOnlyUpdatePrice() == true){
            $arrItems['onlyUpdatePriceItems'] = true;
        }
        if($item->getHomeLand() == '1688'){
            $arrItems['isHomeland'] = true;
        }
        if($item->getTitle()){
            $arrItems['hasTitle'] = true;
        }
        return $arrItems;
    }
    /**
     * @param \Mongodb\Items $item
     * @return array
     */
    private function _getItemVariants($item){
        $mandango = ConnectMongoDB::getConnection();
        $conditional = [];
        $conditional['itemId'] = $item->getId()->{'$id'};
        $itemVariantRepo = new \Mongodb\ItemVariantRepository($mandango);
        $list_item_variant = $itemVariantRepo->createQuery()
            ->criteria($conditional)
            ->all()
        ;
        $homeLand = $item->getHomeLand();

        $list_variants = [];
        foreach($list_item_variant as $variant){
            /**@var \Mongodb\ItemVariant $variant*/
            $variantArray = $variant->toArray();
            $variantArray['homeLand'] = $homeLand;
            if($homeLand == '1688'){
                $isHomeLand = true;
                $variantArray['isHomeLand'] = $isHomeLand;
                $variantArray['minPriceOrigin'] = $item->getMinOriginPrice();
                $variantArray['maxPriceOrigin'] = $item->getMaxOriginPrice();
            }

            if($variant->getOriginalSalePrice()){
                $variantArray['has_sale_price'] = true;
            }
            $list_variants[] = $variantArray;

        }
        return $list_variants;
    }

    /**
     * chuyển trạng thái của sản phẩm từ active thành inactive hoặc ngược lại
     * @return string
     */
    public function executeChangeStatusProduct(){
        $product_ids = $this->post('product_id','ARRAY',[]);
        $activeCode = $this->post('activeValue', 'STRING','');
        $ajax = new \AjaxResponse();
        $repoItem = new ItemsRepository(ConnectMongoDB::getConnection());
        if(count($product_ids) > 0 && $activeCode){
            foreach($product_ids as $product_id){
                $itemProduct = $repoItem->findOneById($product_id);
                /** @var \Mongodb\Items $itemProduct */
                if($activeCode == Items::IN_ACTIVE){ // thì khóa hết sản phẩm chuyển sang dạng INACTIVE
                    $itemProduct->setIsActive(Items::IN_ACTIVE);
                    $itemProduct->save();
                    $ajax->success_active[] = $itemProduct->getId()->{'$id'};

                }
                if($activeCode == Items::ACTIVE){
                    $itemProduct->setIsActive(Items::ACTIVE);
                    $itemProduct->save();
                    $ajax->success_active[] = $itemProduct->getId()->{'$id'};
                }
            }
            $ajax->message = sizeof($ajax->success_active) .' sản phẩm đã được thêm vào danh sách đồng bộ!';
            $ajax->type = \AjaxResponse::SUCCESS;
            return $this->renderText($ajax->toString());
        }
        $ajax->type = \AjaxResponse::ERROR;
        return $this->renderText($ajax->toString());
    }

    /**
     * hàm kiểm tra sản  phẩm và variant của sp có
     * giá gốc hay chưa
     * @return string
     */
    public function executeCheckHasPrice(){
        $ajax = new \AjaxResponse();
        try{
            $product_id = $this->request()->post('product_id');
            $repo = new ItemsRepository(ConnectMongoDB::getConnection());
            $product = $repo->findOneById($product_id);
            /** @var \Mongodb\Items $product */
            $maxPrice = $product->getMaxOriginPrice();
            $minPrice = $product->getMinOriginPrice();
            $hasPrice = false;
            if ($maxPrice && $minPrice) {
                $hasPrice = true;
            }
            $productVariants = $this->executeGetItemsVariant($product);
            $priceVariant = [];
            foreach($productVariants as $variant){
                /** @var \Mongodb\ItemVariant $variant */
                $priceVariant[] = $variant->getPrice();
            }
            if(!$hasPrice && count($priceVariant) == 0){
                $ajax->type = \AjaxResponse::ERROR;
                $ajax->message = 'Sản phẩm chưa nhập giá tiền !';
                return $this->renderText($ajax->toString());

            }else{
                $ajax->type = \AjaxResponse::SUCCESS;
                $ajax->message = 'Đủ điều kiện đồng bộ !';
                return $this->renderText($ajax->toString());
            }
        }catch (Exception $e){
            $ajax->type = \AjaxResponse::ERROR;
            $ajax->message = 'Sản phẩm chưa nhập giá tiền !';
            return $this->renderText($e->getMessage());
        }
    }

    /**
     * lấy ds của items
     * @return array
     */
    public function executeGetItems(  $conditional = [] , $limit){
        $mandango = ConnectMongoDB::getConnection();
        $customerId = CustomerAuth::getInstance()->getCustomer()->getId();
        $conditional['customerId'] = $customerId;
        $itemRepo = new \Mongodb\ItemsRepository($mandango);
        $list_items_product = $itemRepo ->createQuery()
            ->criteria($conditional)
            ->limit($limit)
            ->all()
        ;
        return $list_items_product;
    }

    /**
     * xóa mảng sản phẩm gủi lên
     * @return string
     */
    public function executeDeleteArrayItems(){
        $ajax = new \AjaxResponse();
        try{
            $product_id = $this->request()->post('product_id','ARRAY',[]);
            $repo = new ItemsRepository(ConnectMongoDB::getConnection());

            if(count($product_id) == 0){
                $ajax->type = \AjaxResponse::ERROR;
                $ajax->message = 'id bạn gửi lên ko phải là id của sản phẩm';
                return $this->renderText($ajax->toString());
            }
            foreach($product_id as $item){
                $product = $repo->findOneById($item);
                /**@var \Mongodb\Items $product */
                if($product->getIsActive() == self::ACTIVE){
                    $product->setIsDeleted(true);
                    if($product->save()){
                        $ajax->success[] = $item;
                    }else{
                        $ajax->fail[] = $item;
                    }
                }else{
                    $ajax->fail[] = $item;
                }

            }
            $ajax->type = \AjaxResponse::SUCCESS;
            $ajax->message = "Xóa sản phẩm thành công !";
            return $this->renderText($ajax->toString());
        }catch ( Exception $e){
            return $this->renderText($e->getMessage());
        }

    }

    /**
     * xóa sản phẩm
     * @return string
     */
    public function executeDeleteItems(){
        $ajax = new \AjaxResponse();
        $product_id = $this->request()->post('product_id');
        $repo = new ItemsRepository(ConnectMongoDB::getConnection());
        $product = $repo->findOneById($product_id);
        if(!$product){
            $ajax->type = \AjaxResponse::ERROR;
            $ajax->message = 'id bạn gửi lên ko phải là id của sản phẩm';
            return $this->renderText($ajax->toString());
        }
        /**@var \Mongodb\Items $product */
        if($product->getIsActive() == self::IN_ACTIVE){
            $ajax->type = \AjaxResponse::ERROR;
            $ajax->message = 'Bạn không thể xóa sản phẩm này !';
            return $this->renderText($ajax->toString());
        }
        $product->setIsDeleted(true);
        if($product->save()){
            $ajax->type = \AjaxResponse::SUCCESS;
            $ajax->message = 'Xóa sản phẩm thành công !';
            return $this->renderText($ajax->toString());
        }else{
            $ajax->type = \AjaxResponse::ERROR;
            $ajax->message = 'Có lỗi';
            return $this->renderText($ajax->toString());
        }
    }

    /**
     * thay đổi trạng thái của sản phẩm
     * @return string
     *
     */
    public function executeChangeActiveItems(){
        $ajax = new \AjaxResponse();
        $active = $this->request()->post('active');
        $product_id = $this->request()->post('product_id');
        $repoItem = new ItemsRepository(ConnectMongoDB::getConnection());
        $itemProduct = $repoItem->findOneById($product_id);
        /** @var \Mongodb\Items $itemProduct */
        if($active == self::ACTIVE || $active == self::IN_ACTIVE){ // fixed gaaos trường hợp của dữ liệu cũ
            if($active == self::ACTIVE){
                $itemProduct->setIsActive(self::IN_ACTIVE);
                $itemProduct->save();
            }
            if($active == self::IN_ACTIVE){
                $itemProduct->setIsActive(self::ACTIVE);
                $itemProduct->save();
            }
            $ajax->type = \AjaxResponse::SUCCESS;
            $ajax->message = "Đổi trạng thái thành công";
            return $this->renderText($ajax->toString());
        }else{
            $ajax->type = \AjaxResponse::ERROR;
            $ajax->message = "Thất bại";
            return $this->renderText($ajax->toString());
        }

    }

    /**
     * hàm sưa nhanh giá sản phẩm
     * @return string
     */
    public function executeUpdateItems(){
        $ajax = new \AjaxResponse();
        try{
            $product_id = $this->request()->post('product_id');
            $list_variant = $this->request()->post('list_variant','ARRAY',[]);
            $product_title = $this->request()->post('product_title');
            $updatePrice = $this->request()->post('only_update_price');
            $inputTags = $this->request()->post('input_tags'); // cập nhật tags của sản phẩm

            /**
             * lấy giá trị của item theo Id items
             */

            $repoItem = new ItemsRepository(ConnectMongoDB::getConnection());
            $itemProduct = $repoItem->findOneById($product_id);
            // sẽ thêm các điều kiện khác
            // sửa giá của variant
            if(count($list_variant) > 0){
                foreach($list_variant as $variant){
                    $variant_id = $variant['id'];
                    $variant_price = $variant['price'];
                    $repo = new ItemVariantRepository(ConnectMongoDB::getConnection());
                    $item_variant = $repo->findOneById($variant_id);
                    /** @var \Mongodb\ItemVariant $item_variant */
                    if($item_variant->getPrice() == $variant_price){
                        continue;
                    }
                    $old_price = $item_variant->getSalePrice();
                    $variant_price = Common::moneyToFloat($variant_price);
                    $item_variant->setSalePrice($variant_price);
                    $item_variant->save();
                    // sau khi save thì cập nhật lại giá bán
                    \Mongodb\Items::updatePriceFromVariant($itemProduct);
                    $customer_id = CustomerAuth::getInstance()->getInstance()->getCustomer()->getId();
                    if($old_price != $variant_price ){
                        ItemsLog::logUpdatePrice($itemProduct,$variant_id,$old_price,$variant_price,$customer_id);
                    }
                }
            }
            /**
             * sửa tiêu để sản phẩm
             */
            if($product_id){
                /** @var \Mongodb\Items $itemProduct */
                if($itemProduct->getTitle() != $product_title){
                    $itemProduct->setTitle($product_title);
                }
                // lưu lại giá trị của tag từ chuỗi chuyển thành mảng
                // nếu trong một phần tag có giá trị là là khoảng trắng thì bỏ khoảng trắng sau đó mới lưu lại giá trị
                $itemProduct->setTagsFromString($inputTags); // lưu lại mảng giá trị của tag
                if($updatePrice == 'true'){
                    $itemProduct->setOnlyUpdatePrice(true);
                }else{
                    $itemProduct->setOnlyUpdatePrice(false);
                }

                $itemProduct->save();
            }

            // khi cập nhật xong thì tính lại phí của sản phẩm

            $ajax->type = \AjaxResponse::SUCCESS;
            $ajax->message = "Thành công";
            return $this->renderText($ajax->toString());
        }catch (Exception $e){
            $ajax->type = \AjaxResponse::ERROR;
            $ajax->message = "Lỗi";
            return $this->renderText($ajax->toString());
        }


    }


    /**
     * lấy các itemvariant theo items
     * @param \Mongodb\Items $item
     * @return array
     */
    public function executeGetItemsVariant($item){
        $mandango = ConnectMongoDB::getConnection();
        $conditional = [];
        $conditional['itemId'] = $item->getId()->{'$id'};
        $itemVariantRepo = new \Mongodb\ItemVariantRepository($mandango);
        $list_item_variant = $itemVariantRepo->createQuery()
            ->criteria($conditional)
            ->all()
        ;
        return $list_item_variant;
    }

    public function executeExportExcelItems()
    {
        $keyword = $this->request()->get('keyword'); // tiêu đề hoặc id của sản phẩm
        $seller_name = $this->request()->get('seller_name'); // tên người bán
        $hasSys = $this->request()->get('hasSys'); // trạng thái đã đồng bộ hay chưa
        $site_original = $this->request()->get('siteOriginal');// site gốc của sản phẩm
        $from_price_origin = $this->request()->get('from_price_origin');// giá gốc từ
        $to_price_origin = $this->request()->get('to_price_origin'); // gía gốc đến
        $from_price_sale = $this->request()->get('from_price_sale'); // giá bán từ
        $to_price_sale = $this->request()->get('to_price_sale'); // giá bán đến
        $customerId = CustomerAuth::getInstance()->getCustomer()->getId();
        $conditional = [];
        $conditional['$or'] = [['isDeleted' =>['$exists' => false]],['isDeleted' => false]];//isDeleted
        $conditional['customerId'] = $customerId;
        /**
         * tìm theo keyWord
         */
        if($keyword){
            if(\MongoId::isValid($keyword)){
                $conditional['_id'] = new \MongoId($keyword);
            }else{
                $conditional['title'] = ['$regex' => $keyword];
            }
        }
        /**
         * đã đồng bộ hay chưa
         */
        if($hasSys){
            if($hasSys == 'has_sys'){
                $conditional['integrationItems']= ['$exists' => true];
            }
            if($hasSys == 'not_has_sys'){
                $conditional['integrationItems']= ['$exists' => false];
            }
        }
        /**
         * site gốc
         */
        if($site_original){
            $conditional['homeLand'] =  $site_original;
        }
        if($seller_name){
            $conditional['sellerName'] = ['$regex' => $seller_name]; // tên người bán
        }
        // tìm theo giá gốc
        if($from_price_origin != null || $to_price_origin != null){
            if($from_price_origin != null){
                $conditional['minOriginPrice'] =['$gte' => floatval($from_price_origin)];
            }
            if($to_price_origin != null){
                $conditional['maxOriginPrice'] = ['$lte' =>  floatval($to_price_origin)];
            }
        }
        // tìm theo giá bán
        if($from_price_sale != null || $to_price_sale != null){
            if($from_price_sale != null){
                $conditional['minPriceSale'] = ['$gte' => floatval($from_price_sale)];
            }
            if($to_price_sale){
                $conditional['maxPriceSale'] = ['$lte' => floatval($to_price_sale)];
            }
        }

        $filename = 'DANH SÁCH SẢN PHẨM' . "-" . date('Y/m/d H:i', time());
        excel::exportExcelProduct($filename , $conditional );
    }

}