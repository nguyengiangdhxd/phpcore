<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 1/21/2016
 * Time: 9:53 AM
 */

namespace Haravan;


use Core\IntergrationApp\UrlHelper;
use Haravan\ProductUtil;
use Core\Logger;
use Flywheel\Db\Type\DateTime;
use Flywheel\Exception;

class HaravanService {
    const HARAVAN_KEY = 'HARAVAN';
    const SERVICE_KEY = 'HARAVAN';

    private $_client;
    private $_shopDomain;
    private $_apiKey;
    private $_accessToken;
    private $_secretKey;

    /**
     * lấy theo customer của khách
     * @param HaravanClient $client
     */
    public function __construct($client){
        $this->_client = $client;
        // ở đây phải được chú ý rằng các các hành động chỉ được sử dụng cho một customer
    }

    public function getClient()
    {
        if (!isset($_client)) {
            $this->_client = new HaravanClient($this->_shopDomain, $this->_accessToken, $this->_apiKey, $this->_secretKey);
        }
        return $this->_client;
    }

    /**
     * truyền vào đối tượng mà một items
     * xử lý convert sang dữ liệu chuẩn của haravan gửi lên
     * TODO : dữ liệu chuẩn của haravan
     */
    public function syncItem(\mongodb\Items $productIDE){

        try{
            $productId = $productIDE->getIntergrationValue(self::SERVICE_KEY, 'product_id');

            $optionBizWeb = ProductUtil::getOptions($productIDE);

            $variantMapping = []; //mảng cho biết position trên BizWeb ứng với variant nào trên IDE
            $variantsBizWeb = ProductUtil::getVariants($productIDE, $variantMapping);

            $content = ProductUtil::getContent($productIDE);

            #region -- POST lan 1: thong tin san pham --
            $dataToPost = [
                'title' => $productIDE->getTitle() ? $productIDE->getTitle() : $productIDE->getTitleOrigin() , // trường này là bắt buộc
                'options' => $optionBizWeb , // option của sản phẩm , thuộc tính của sản phẩm
                'tags' => $productIDE->getTagsProduct() ? implode(',',$productIDE->getTagsProduct()) :'',
                'body_html' => $content,// nội dung thong tin sản phẩm
                'variants'=> $variantsBizWeb,
                'product_type' => 'Quần áo'
            ];
            if(!$optionBizWeb){
              return "sản phẩm ko đủ điều kiện đồng bộ !";
            }
            if ($productId) {
                $dataResponse = $this->_client->call('PUT',"/admin/products/$productId.json",['product' => $dataToPost ]);
                if($dataResponse == 'Not Found'){
                    $productId = 0 ;
                }
            }

            if (!$productId) {
                $dataResponse= $this->_client->call('POST','/admin/products.json',['product' => $dataToPost]);
            }

            #endregion
            if (isset($dataResponse)) {
                ProductUtil::saveProductIntegration($productIDE, $dataResponse, $variantMapping , $dataToPost);
            }

            #region -- POST lan 2: anh san pham --
            $imageBizWeb = ProductUtil::getImages($productIDE, $variantMapping); //tai thoi diem nay moi get image de da co thong tin ve variant tra ve

            // Chi thuc hien duoc neu nhu lan post dau thanh cong
            if ($dataResponse && isset($dataResponse['id'])) {
                $productId = $dataResponse['id'];
                $dataToPost = [
                    'images' => $imageBizWeb,
                ];
                $dataResponse = $this->_client->call('PUT',"/admin/products/$productId.json",['product'=> $dataToPost]);
                // sau khi gửi ảnh lên lấy giá trị của trả về của ProductId
                if($dataResponse){
                    // xử lý lưu lại id của ảnh
                    $imageResponses = $dataResponse['images'];
                    ProductUtil::saveImagesIds($productIDE,$imageResponses,$dataToPost);
                }
            }
            // nếu mà trống thì post giá trị của image
            if($dataResponse){
                $this->sendImageToService($productIDE, $dataResponse);
            }
            #endregion
        }catch ( Exception $e){
            $e->getMessage();
        }
    }

    /**
     * send image to haravan
     * @author nguyenhoanggiang
     * @param \Mongodb\Items $product
     * @param $dataResponse
     * @throws HaravanApiException
     */
    public function sendImageToService(\Mongodb\Items $product,$dataResponse){
        // check điều kiện để push hay để post giá trị
        $integration = $product->getIntegration(self::SERVICE_KEY);
        $productId = $dataResponse['id'];
        // lấy ra tất cả các variant
        $variants = $product->getVariants();
        $params = [];
        foreach($variants as $item_variant){
            /** @var \Mongodb\ItemVariant  $item_variant*/
            $tmp = [];
            $tmp_app =  $item_variant->getIntegration(self::SERVICE_KEY);
            $tmp['variant_ids'] = (array)$tmp_app['variant_id'];
            $tmp['src'] = $item_variant->getImage();
            $params[] = $tmp;
        }
        if(!$integration){
            foreach($params as $param ){
                $result = $this->_client->call('POST',"/admin/products/$productId/images.json",['image'=> $param]);
            }
        }else{
            $integration = $product->getIntegration(self::SERVICE_KEY);
            $image_key = $integration['image_key'];
            $variants = $product->getVariants();
            $param_tmp = [];
            foreach($variants as $item_variant){
                /** @var \Mongodb\ItemVariant  $item_variant*/
                $tmp = [];
                $tmp_app =  $item_variant->getIntegration(self::SERVICE_KEY);
                $tmp['variant_ids'] = (array)$tmp_app['variant_id'];
                if(array_key_exists(md5(UrlHelper::normalizeImageUrl($item_variant->getImage())),$image_key)){
                    $tmp['id'] = $image_key[md5(UrlHelper::normalizeImageUrl($item_variant->getImage()))];
                }
                $param_tmp[] = $tmp;

            }
            Logger::factory('haravan-variant')->addDebug('giá trị của params', ['params' => $param_tmp]);
            foreach($param_tmp as $item_tmp ){
                $result = $this->_client->call('PUT',"/admin/products/$productId/images/{$item_tmp['id']}.json",['image'=> $item_tmp]);
            }
        }
    }

    /**
     * Lấy về setting của khách hàng với haravan; nếu khách hàng chưa có đủ store và access_token thì trả về false tức
     * khách hàng chưa cài đặt
     * @param \Customer|int $customer
     * @return bool|array
     * @throws \Exception
     * @author kiennx
     */
    public static function getCustomerSettings($customer) {
        if (is_int($customer)) {
            $customer_id = $customer;
        }

        if ($customer instanceof \Customer) {
            $customer_id = $customer->getId();
        }

        if (!isset($customer_id)) {
            throw new \Exception('$customer must be int or Customer object');
        }

        $profiles = \Mongodb\CustomerProfilesRepository::findOneOrCreateByCustomerId($customer_id);
        $integration = $profiles->getIntegration();
        if (!is_array($integration)) {
            return false;
        }

        if (isset($integration['haravan'])) {
            $settings = $integration['haravan'];

            if (!is_array($settings)) {
                return false;
            }

            if (!isset($settings['store']) || !isset($settings['access_token'])) {
                return false;
            }

            return $settings;
        };

        return false;
    }

    /**
     * Cài đặt app haravan cho customer
     * @param $customer
     * @param $store
     * @param $access_token
     * @return array
     * @throws \Exception
     */
    public static function install($customer, $store, $access_token) {
        if (is_int($customer)) {
            $customer_id = $customer;
        }

        if ($customer instanceof \Customer) {
            $customer_id = $customer->getId();
        }

        if (!isset($customer_id)) {
            throw new \Exception('$customer must be int or Customer object');
        }

        $profiles = \Mongodb\CustomerProfilesRepository::findOneOrCreateByCustomerId($customer_id);
        $integration = $profiles->getIntegration();
        if (!is_array($integration)) {
            $integration = [];
        }

        if (!isset($integration['haravan'])) {
            $settings = [];
        }
        else {
            $settings = $integration['haravan'];
        }
        $settings['createdTime'] = new \MongoDate(strtotime(new DateTime()));

        $settings['store'] = $store;
        $settings['access_token'] = $access_token;

        $integration['haravan'] = $settings;
        $profiles->setIntegration($integration);
        $profiles->save();

        return $settings;
    }

    static $_clients = [];
    /**
     * trả về client của haravan khi đông bộ
     * @param $customer_id
     * @throws \Exception
     * @return \BizWeb\BizWebClient
     */
    public static function createClient($customer_id) {
        if (isset(self::$_clients[$customer_id])) {
            return self::$_clients[$customer_id];
        }

        $settings = HaravanService::getCustomerSettings($customer_id); // đối tượng cusotomer

        if ($settings) {
            $storeCustomer = $settings['store'];
            $customerAccess = $settings['access_token'];
            $client = new HaravanClient($storeCustomer, $customerAccess);
            self::$_clients[$customer_id] = $client;
            return $client;
        }

        throw new \Exception("Customer is not install Haravan App yet");
    }
    #endregion
}