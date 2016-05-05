<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 12/17/2015
 * Time: 12:11 PM
 */

namespace BizWeb;

use Core\Logger;
use Flywheel\Db\Type\DateTime;
use Mongodb\ConnectMongoDB;
use SeuDo\Common\RedisCache;
use Symfony\Component\Config\Definition\Exception\Exception;

class BizWebService {
    const BIZWEB_KEY = 'BIZWEB';

    private $_client;
    private $_shopDomain;
    private $_apiKey;
    private $_accessToken;
    private $_secretKey;

    /**
     * lấy theo customer của khách
     * @param BizWebClient $client
     */
    public function __construct($client){
        $this->_client = $client;
        // ở đây phải được chú ý rằng các các hành động chỉ được sử dụng cho một customer
    }

    public function getClient()
    {
        if (!isset($_client)) {
            $this->_client = new BizWebClient($this->_shopDomain, $this->_accessToken, $this->_apiKey, $this->_secretKey);
        }
        return $this->_client;
    }



    /**
     * trả về một mảng chứa datapost gửi lên
     * Thêm mới sản phẩm nếu chưa có, cập nhật nếu đã có
     * @param \mongodb\Items $productIDE
     * @throws \Flywheel\Exception
     */
    public function syncItem(\mongodb\Items $productIDE){
        try{


            $productId = $productIDE->getIntergrationValue(self::BIZWEB_KEY, 'product_id');

            $optionBizWeb = ProductUtil::getOptions($productIDE);

            $variantMapping = []; //mảng cho biết position trên BizWeb ứng với variant nào trên IDE
            $variantsBizWeb = ProductUtil::getVariants($productIDE, $variantMapping);

            $content = ProductUtil::getContent($productIDE);

            #region -- POST lan 1: thong tin san pham --
            $dataToPost = [
                'name' => $productIDE->getTitle() ? $productIDE->getTitle() : $productIDE->getTitleOrigin() , // trường này là bắt buộc
                #'vendor' => $productIDE->getHomeLand(), // nhà cung cấp
                'options' => $optionBizWeb , // option của sản phẩm , thuộc tính của sản phẩm
                //'tags' =>$productIDE->getTags(),// tag của sp
                'tags' => $productIDE->getTagsProduct() ? implode(',',$productIDE->getTagsProduct()) :'',
                'content' => $content,// nội dung thong tin sản phẩm
                'variants'=> $variantsBizWeb,

            ];
            #$arTest = ['variants' => $variantsBizWeb];

            #Logger::factory("has-error-when-get-product-info")->addDebug(json_encode($arTest));

            if ($productId) {
                $dataResponse = $this->_client->call('PUT',"/admin/products/$productId.json",$dataToPost);
                if($dataResponse == 'Not Found'){
                    $productId = 0 ;
                }
            }

            if (!$productId) {
                $dataResponse= $this->_client->call('POST','/admin/products.json',$dataToPost);
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
                $dataResponse = $this->_client->call('PUT',"/admin/products/$productId.json",$dataToPost);
                // sau khi gửi ảnh lên lấy giá trị của trả về của ProductId
                if($dataResponse){
                    // xử lý lưu lại id của ảnh
                    $imageResponses = $dataResponse['images'];
                    ProductUtil::saveImagesIds($productIDE,$imageResponses,$dataToPost);
                }

            }
            /**
             * gửi lên giá trị của metafile là link gốc của sản phẩm trên site trung quốc
             */
            if($dataResponse && isset($dataResponse['id'])){
                $productId = $dataResponse['id'];
                $dataToPostMetaData = [
                    "id" => $productId,
                    "metafields"=> [
                        [
                            "key" => "link gốc",
                            "value"=> $productIDE->getOriginalLink(),
                            "value_type"=> "string",
                            "namespace"=> "IDE"
                        ]
                    ]
                ];
                $dataResponseMeta = $this->_client->call('PUT',"/admin/products/$productId.json",$dataToPostMetaData);
            }
            #region --gửi giá trị của spec lên server--
            if($dataResponse && isset($dataResponse['id'])){
                $product_id = $dataResponse['id'];
                $dataToPostSpec = [
                    "id" => $product_id,
                    "metafields"=> [
                        [
                            "key" => "Spec",
                            "value"=> json_encode($productIDE->getSpecifications()),
                            "value_type"=> "string",
                            "namespace"=> "IDE"
                        ]
                    ]
                ];
                $dataResponseSpec = $this->_client->call('PUT',"/admin/products/$product_id.json",$dataToPostSpec);

            }
            #endregion
            #endregion
        }catch ( Exception $e){
            $e->getMessage();
        }

    }

    #region -- CÁC HÀM BUILD DỮ LIỆU GỬI LÊN BIZWEB TỪ ITEM --
    #endregion

    #region -- Static function --

    static $_clients = [];

    /**
     * Kiểm tra xem khách hàng đã cài đặt BizWeb hay chưa
     * @param \Customer|int $customer
     * @return bool
     * @throws \Exception
     * @author Kiennx
     */
    public static function isInstalled($customer) {
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

        if (isset($integration['bizweb'])) {
            $settings = $integration['bizweb'];

            //cần 2 thông tin là shop và access_token
            if (!is_array($settings)) {
                return false;
            }

            if (!isset($settings['store']) || !isset($settings['access_token'])) {
                return false;
            }

            $store = $settings['store'];
            $access_token = $settings['access_token'];

            if (!empty($store) && !empty($access_token)) {
                return true;
            }

            return false;
        };

        return false;
    }

    /**
     * Lấy về setting của khách hàng với bizweb; nếu khách hàng chưa có đủ store và access_token thì trả về false tức
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

        if (isset($integration['bizweb'])) {
            $settings = $integration['bizweb'];

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
     * Cài đặt app BizWeb cho customer
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

        if (!isset($integration['bizweb'])) {
            $settings = [];
        }
        else {
            $settings = $integration['bizweb'];
        }
        #region bổ sung thêm việc lưu lại thời gian khi cài dặt app
        $settings['createdTime'] = new \MongoDate(strtotime(new DateTime()));
        #endregion
        $settings['store'] = $store;
        $settings['access_token'] = $access_token;

        $integration['bizweb'] = $settings;
        $profiles->setIntegration($integration);
        $profiles->save();

        return $settings;
    }

    /**
     * @param $customer_id
     * @throws \Exception
     * @return \BizWeb\BizWebClient
     */
    public static function createClient($customer_id) {
        if (isset(self::$_clients[$customer_id])) {
            return self::$_clients[$customer_id];
        }

        $settings = BizWebService::getCustomerSettings($customer_id); // đối tượng cusotomer

        if ($settings) {
            $storeCustomer = $settings['store'];
            $customerAccess = $settings['access_token'];
            $client = new BizWebClient($storeCustomer, $customerAccess);
            self::$_clients[$customer_id] = $client;
            return $client;
        }

        throw new \Exception("Customer is not install Bizweb App yet");
    }
    #endregion
}