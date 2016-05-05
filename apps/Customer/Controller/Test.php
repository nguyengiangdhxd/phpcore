<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 12/14/2015
 * Time: 6:15 PM
 */

namespace Customer\Controller;

use BizWeb\BizWebClient;
use BizWeb\BizWebService;
use Core\CustomerAuth;
use Core\IntergrationApp\UrlHelper;
use Core\Logger;
use Core\Queue;
use Flywheel\Db\Type\DateTime;
use Haravan\HaravanClient;
use Haravan\HaravanService;
use Mongodb\ConnectMongoDB;
use Mongodb\Items;
use Mongodb\ItemsRepository;

class Test extends CustomerBase
{

    public function executeDefault()
    {
        $client = BizWebService::createClient(CustomerAuth::getInstance()->getCusId());
        $service = new BizWebService($client);
        $repo = new ItemsRepository(ConnectMongoDB::getConnection());
        /** @var \MongoDb\Items $item */
        $item = $repo->findOneById("568b6e4481a40d5c7f000029");
        $service->syncItem($item);

        $client = new BizWebClient('kiennx.bizwebvietnam.net', '47c2aef49a7c4247aa2ab05f0b9a7918', '9d5fe526862ede00fe126768d8f212ce', '4506fc948bfdb2cfb3e27a1ef77e24fa');
        $test = $client->call('GET', '/admin/products/98.json');
        # $test = $client->call('GET','/admin/products.json', ['id'=>922161]);#922161

        // TODO: Implement executeDefault() method.
        // ["shop_domain" : "kiennx.bizwebvietnam.net",
        // "access_token" : "47c2aef49a7c4247aa2ab05f0b9a7918"
        // sau này cấu hình fix cứng
        // $api_key : 9d5fe526862ede00fe126768d8f212ce
        // $secret  : 4506fc948bfdb2cfb3e27a1ef77e24fa
        // có thể lấy lại giá trị của $api_key : thông qua quy trình
        /*POST /admin/products.json*/

        /*$test = $client->call('POST','/admin/products.json',[
            'name' => "Test22", // trường này là bắt buộc
            'alias' => 'san-pham-test-22',
            'vendor' =>'Alitech', // nhà cung cấp
            'options' => [  //đây là các thuộc tính của hàng
                [
                    'name' => 'Gia tri hang', // tên mặt hàng
                ],
                [
                   'name' => 'Mau sac', // màu sắc của đơn hàng
                ],
                [
                    'name' => 'Kích thước' // kích thước của đơn hàng
                ]
            ],
            'product_type'=> "Dày dép", // loại sản phẩm
            'tags' => 'Emotive, Flash Memory, MP3, Music' ,// tag cho tên sản phẩm
            'compare_at_price_min' => 0,
            'compare_at_price_varies' =>  false,
            'meta_title' =>'san-pham-test-meta',
            'meta_description' => 'áo hịn , áo hịn đây',
            'content' =>  'đây là đoạn thông tin về sản phẩm để đánh giá nó , đây là đoạn thông tin về sản phẩm để đánh giá nó',
            'variants' => [ // mô tả chi tiết về sản phẩm và các thuộc tính chi tiết
                [
                "title" => "Do 35",
                "option1" => '12345566',
                'option2' => 'Do',
                'option3' => '43',
                "barcode" => "1234_pink",
                "sku" =>"IPOD2008PINK" , // mã sku
                "fulfillment_service" => "manual",
                'price' => 10000,
                'compare_at_price' => 100,
                'weight' => 12.5,
                    'position' => 1
                ]
            ],
            'images' =>[ // gửi ảnh cho sản phẩm
                ["src"=> "http://xemanh.net/wp-content/uploads/2015/08/hinh-nen-gai-xinh-cho-may-tinh.jpg" ] ,
                ["src"=> "http://hinhnendepnhat.net/wp-content/uploads/2014/06/hinh-nen-girl-xinh-viet-nam-xinh-oi-la-xinh.jpg" ],
                ["src"=> "http://www.12cunghoangdao.com.vn/wp-content/uploads/2015/09/tu-vi-12-cung-hoang-dao-thu-ba-ngay-15-9-2015.jpg" ]
            ],

        ]);*/

        /*  $test = $client->call('POST','/admin/products.json',[
              'name' => "Test24", // trường này là bắt buộc
              'alias' => 'san-pham-test-24',
              'vendor' =>'Alitech', // nhà cung cấp
              'options' => [  //đây là các thuộc tính của hàng
                  [
                      'name' => 'Gia tri hang', // tên mặt hàng
                  ],
                  [
                      'name' => 'Mau sac', // màu sắc của đơn hàng
                  ],
                  [
                      'name' => 'Kích thước' // kích thước của đơn hàng
                  ]
              ],
              'product_type'=> "Dày dép", // loại sản phẩm
              'tags' => 'Emotive, Flash Memory, MP3, Music' ,// tag cho tên sản phẩm
              'compare_at_price_min' => 0,
              'compare_at_price_varies' =>  false,
              'meta_title' =>'san-pham-test-meta',
              'meta_description' => 'áo hịn , áo hịn đây',
              'content' =>  'đây là đoạn thông tin về sản phẩm để đánh giá nó , đây là đoạn thông tin về sản phẩm để đánh giá nó',
              'variants' => [ // mô tả chi tiết về sản phẩm và các thuộc tính chi tiết
                  [
                      "title" => "Do 35",
                      "option1" => '12345566',
                      'option2' => 'Do',
                      'option3' => '43',
                      "barcode" => "1234_pink",
                      "sku" =>"IPOD2008PINK" , // mã sku
                      "fulfillment_service" => "manual",
                      'price' => 10000,
                      'compare_at_price' => 100,
                      'weight' => 12.5,
                      'position' => 1
                  ]
              ],
              'images' =>[ // gửi ảnh cho sản phẩm
                  ["src"=> "http://xemanh.net/wp-content/uploads/2015/08/hinh-nen-gai-xinh-cho-may-tinh.jpg" ] ,
                  ["src"=> "http://hinhnendepnhat.net/wp-content/uploads/2014/06/hinh-nen-girl-xinh-viet-nam-xinh-oi-la-xinh.jpg" ],
                  ["src"=> "http://www.12cunghoangdao.com.vn/wp-content/uploads/2015/09/tu-vi-12-cung-hoang-dao-thu-ba-ngay-15-9-2015.jpg" ]
              ],

              "metafields"=> [
                  [
                  "key" => "new",
                  "value"=> "newvalue",
                  "value_type" => "string",
                  "namespace" => "global"
                  ] ,// gửi kèm theo giá trị metafield
                  [
                      "key" => "new1",
                      "value"=> "newvalue1",
                      "value_type" => "string",
                      "namespace" => "global"
                  ],
                  [
                      "key" => "new2",
                      "value"=> "newvalue2",
                      "value_type" => "string",
                      "namespace" => "global"
                  ]

              ]
          ]);*/

        var_dump($test);
        die;
    }

    /**
     * lấy dữ liệu metafileds theo id của product
     */
    public function executeT()
    {


        $queue = Queue::factory('integration_synchronized');

        $item_id = $queue->pop();
        $logger = Logger::factory('synchronized');
        $repo = new ItemsRepository(ConnectMongoDB::getConnection());
        /** @var \MongoDb\Items $item */
        $item = $repo->findOneById($item_id);
        if (!$item) {
            $logger->error('item not found with id:' . $item_id);
            return;
        } else {
            //Luuhieu: về sau sẽ có setting của items hoặc customer đồng bộ qua kênh nào.
            // Cần check và lấy thêm ở đây. Trước mắt mặc định là bizweb
            $client = BizWebService::createClient($item->getCustomerId());
            $server = new BizWebService($client);
            $server->syncItem($item);
        }
    }

    /**
     * xóa một bản ghi , xóa thành công trả về null
     */
    public function executeDelete()
    {
        $client = new BizWebClient('kiennx.bizwebvietnam.net', '47c2aef49a7c4247aa2ab05f0b9a7918', '9d5fe526862ede00fe126768d8f212ce', '4506fc948bfdb2cfb3e27a1ef77e24fa');
        $test = $client->call('DELETE', '/admin/products/983930.json');

        var_dump($test);
        die();
    }


    /**
     * tạo mới
     * gửi kèm ảnh trong varient ( theo option thuộc tính của sản phẩm )
     * status :: thành công
     */
    public function executeSendImage()
    {

        $client = new BizWebClient('kiennx.bizwebvietnam.net', 'f4fd9e1e1cc343bbb6ec668930ff7f2e', '9d5fe526862ede00fe126768d8f212ce', '4506fc948bfdb2cfb3e27a1ef77e24fa');
        $test = $client->call('POST', '/admin/products.json', [
            'name' => "gui kem metafile version 3332", // trường này là bắt buộc
            # 'alias' => 'quan-bo-hin-2', // cái nay có thể tự sinh
            'vendor' => 'Alitech', // nhà cung cấp
            'options' => [
            ],
            'product_type' => "Dày dép", // loại sản phẩm
            'tags' => 'Emotive, Flash Memory, MP3, Music',// tag cho tên sản phẩm
            'compare_at_price_min' => 0,
            'compare_at_price_varies' => false,
            'meta_title' => 'san-pham-test-meta',
            'meta_description' => 'áo hịn , áo hịn đây',
            'content' => 'đây là đoạn thông tin về sản phẩm để đánh giá nó , đây là đoạn thông tin về sản phẩm để đánh giá nó',
            'variants' => [ // mô tả chi tiết về sản phẩm và các thuộc tính chi tiết
                [
                    "barcode" => "1234_pink",
                    "sku" => "IPOD2008PINK", // mã sku
                    "fulfillment_service" => "manual",
                    'price' => 10000,
                    'compare_at_price' => 100,
                    'weight' => 12.5,
                    'position' => 1,
                    "image_position" => 1
                ],

            ],
            'images' => [ // gửi ảnh cho sản phẩm
                ["src" => "http://gd4.alicdn.com/bao/uploaded/i4/15211448/TB2e8FQgpXXXXaNXXXXXXXXXXXX_!!15211448.jpg",'position' => 4],
                ["src" => "http://hinhnendepnhat.net/wp-content/uploads/2014/06/hinh-nen-girl-xinh-viet-nam-xinh-oi-la-xinh.jpg",'position' => 3],
                ["src" => "http://www.12cunghoangdao.com.vn/wp-content/uploads/2015/09/tu-vi-12-cung-hoang-dao-thu-ba-ngay-15-9-2015.jpg",'position' => 2],
                #["src"=> "//gd4.alicdn.com/bao/uploaded/i4/15211448/TB2e8FQgpXXXXaNXXXXXXXXXXXX_!!15211448.jpg" ]
            ]
        ]);

        /*   $dataId = $test['id'];
           var_dump($dataId);die;*/

        #var_dump($test);
        return $this->renderText(json_encode($test));
        # die();
    }

    public function executeMetadata()
    {
        $client = new BizWebClient('kiennx.bizwebvietnam.net', 'f4fd9e1e1cc343bbb6ec668930ff7f2e', '9d5fe526862ede00fe126768d8f212ce', '4506fc948bfdb2cfb3e27a1ef77e24fa');
        $test = $client->call('PUT', '/admin/products/ 1356531.json', [
            "id" => 1356531,
            "metafields" => [
                [
                    "key" => "link gốc",
                    "value" => "newvalue",
                    "value_type" => "string",
                    "namespace" => "IDE"
                ]
            ]

        ]); # theem id
        return $this->renderText(json_encode($test));
    }

    /**
     * update ảnh trong varient
     * lưu ý : cần truyền id của varient  vào vào trong "variant_ids" của image ,
     * chú ý bổ sung truyền id cho cả varient
     */
    public function executePutProduct()
    {
        $client = new BizWebClient('kiennx.bizwebvietnam.net', 'f4fd9e1e1cc343bbb6ec668930ff7f2e', '9d5fe526862ede00fe126768d8f212ce', '4506fc948bfdb2cfb3e27a1ef77e24fa');
        $test = $client->call('PUT', '/admin/products/1143435.json', [
            'id' => 985271,
            'name' => "Test27", // trường này là bắt buộc
            'alias' => 'san-pham-test-2745',
            'vendor' => 'Alitech', // nhà cung cấp
            'options' => [  //đây là các thuộc tính của hàng
                [
                    'name' => 'Gia tri hang', // tên mặt hàng
                ],
                [
                    'name' => 'Mau sac', // màu sắc của đơn hàng
                ],
                [
                    'name' => 'Kích thước' // kích thước của đơn hàng
                ]
            ],
            'product_type' => "Dày dép", // loại sản phẩm
            'tags' => 'Emotive, Flash Memory, MP3, Music',// tag cho tên sản phẩm
            'compare_at_price_min' => 0,
            'compare_at_price_varies' => false,
            'meta_title' => 'san-pham-test-meta',
            'meta_description' => 'áo hịn , áo hịn đây',
            'content' => 'đây là đoạn thông tin về sản phẩm để đánh giá nó , đây là đoạn thông tin về sản phẩm để đánh giá nó',
            'variants' => [ // mô tả chi tiết về sản phẩm và các thuộc tính chi tiết
                [
                    "id" => 1778997,
                    "title" => "Do 35",
                    "option1" => '12345566',
                    'option2' => 'Do',
                    'option3' => '43',
                    "barcode" => "1234_pink",
                    "sku" => "IPOD2008PINK", // mã sku
                    "fulfillment_service" => "manual",
                    'price' => 10000,
                    'compare_at_price' => 100,
                    'weight' => 12.5,
                    'position' => 1,
                    "image_position" => 2
                ]
            ],
            'images' => [ // gửi ảnh cho sản phẩm
                ["src" => "http://xemanh.net/wp-content/uploads/2015/08/hinh-nen-gai-xinh-cho-may-tinh.jpg",
                    "variant_ids" => [1778997]
                ],
                ["src" => "http://hinhnendepnhat.net/wp-content/uploads/2014/06/hinh-nen-girl-xinh-viet-nam-xinh-oi-la-xinh.jpg",
                    "variant_ids" => []
                ],
                ["src" => "http://www.12cunghoangdao.com.vn/wp-content/uploads/2015/09/tu-vi-12-cung-hoang-dao-thu-ba-ngay-15-9-2015.jpg",
                    #  "variant_ids" =>[1778997]
                ]
            ],

        ]);

        /* $data = json_encode($data);
         echo $data; die();*/

        return $this->renderText(json_encode($test));

    }

    /**
     * lấy về metafile theo product
     */
    public function executeGetMetaFiledFromProduct()
    {
        $client = new BizWebClient('kiennx2.bizwebvietnam.net', '8f80d4f470864575b93e6dfeb28c4eb8', '9d5fe526862ede00fe126768d8f212ce', '4506fc948bfdb2cfb3e27a1ef77e24fa');
        $test = $client->call('GET', '/admin/products/1401010/metafields.json');
        # GET /admin/products/#{id}/metafields.json
        return $this->renderText(json_encode($test));
    }

    /**
     * gửi metafiles cho toàn bộ store
     * gửi metafields thành công với tiếng việt
     */
    public function executeGetMeta()
    { // 1356686
        $client = new BizWebClient('kiennx.bizwebvietnam.net', '47c2aef49a7c4247aa2ab05f0b9a7918', '9d5fe526862ede00fe126768d8f212ce', '4506fc948bfdb2cfb3e27a1ef77e24fa');
        $test = $client->call('POST', '/admin/metafields.json', [
            "namespace" => "inventory",
            "key" => "手机版您",#手机版您
            "value" => 25,
            "value_type" => "integer"
        ]);
        var_dump($test);
        die();

    }

    /**
     * tham số cần là giá id của product sản phẩm
     * tạo mới metafiles kèm theo product
     */
    public function executePostMetaProduct()
    {
        $client = new BizWebClient('kiennx.bizwebvietnam.net', '47c2aef49a7c4247aa2ab05f0b9a7918', '9d5fe526862ede00fe126768d8f212ce', '4506fc948bfdb2cfb3e27a1ef77e24fa');
        $test = $client->call('POST', '/admin/products/985271/metafields.json', [
            "namespace" => "inventory",
            "key" => "nguyễn hoàng giang",#手机版您
            "value" => 25,
            "value_type" => "integer"
        ]);
        echo $test['key'];
        die;
    }

    /**
     * get metafileds theo product
     */
    public function executeGetMetaProduct()
    {
        $client = new BizWebClient('kiennx.bizwebvietnam.net', '47c2aef49a7c4247aa2ab05f0b9a7918', '9d5fe526862ede00fe126768d8f212ce', '4506fc948bfdb2cfb3e27a1ef77e24fa');
        $test = $client->call('GET', '/admin/products/985271/metafields.json');

        $test_convert = $test[0]['key'];

        return $this->renderText(json_encode($test));
    }


    /**
     * tham số cần truyền là id của sản phẩm và id của metafiles
     * ko thể sửa lại giá trị của key
     * sửa lại giá trị của meta file trong product
     */
    public function executePutMetaProduct()
    {
        $client = new BizWebClient('kiennx.bizwebvietnam.net', '47c2aef49a7c4247aa2ab05f0b9a7918', '9d5fe526862ede00fe126768d8f212ce', '4506fc948bfdb2cfb3e27a1ef77e24fa');
        $test = $client->call('PUT', '/admin/products/985271/metafields/58120.json', [
            "namespace" => "inventory",
            "key" => "手机版您 拍无模特",#手机版您 giá trị này là ko thể thay đổi
            "value" => 2578,
            "value_type" => "integer"
        ]);
        var_dump($test);
        die;
        /* $create_time = $test['created_on'];
         $key['key'] = $test['key'];
         echo $create_time.$key;
         die;*/

    }

    public function executeGetProductId()
    {
        $client = new BizWebClient('kiennx.bizwebvietnam.net', '47c2aef49a7c4247aa2ab05f0b9a7918', '9d5fe526862ede00fe126768d8f212ce', '4506fc948bfdb2cfb3e27a1ef77e24fa');
        $test = $client->call('GET', '/admin/products/992501.json');
        # return $this->renderText(json_encode($test));
        var_dump($test);
        die();
    }

    public function executeGetProductTest()
    {
        $client = new BizWebClient('kiennx2.bizwebvietnam.net', '8f80d4f470864575b93e6dfeb28c4eb8');
        $test = $client->call('GET', '/admin/products/1408623.json');
        # return $this->renderText(json_encode($test));
       return $this->renderText(json_encode($test));
    }


    public function executeSendDataFromDb()
    {
        $client = new BizWebClient('kiennx.bizwebvietnam.net', '1771acd30fc846c3836d6644a11f6b23');
        $sever = new BizWebService($client);
        $mandango = ConnectMongoDB::getConnection();
        $itemRepo = new \Mongodb\ItemsRepository($mandango);
        $Item = $itemRepo->createQuery()->all();
        foreach ($Item as $itemValue) {
            $sever->syncItem($itemValue);
        }
        return $this->renderText(json_encode($sever));
        #var_dump($Item);die();
    }

    /* public function executeSetItems(){
         $mandango = ConnectMongoDB::getConnection();
         $item = new \Mongodb\Items($mandango);
         // set dữ liệu tạm
         $item->setCreatedTime( new DateTime());
         $item->setBodyImages([]);
         $item->setCustomerId('');
         $item->setUid('');
         $item->setOriginItemId('');
         $item->setHomeLand('');
         $item->setTitle('Nike耐克官方NIKEHAYWARD2.0雙肩包BA5065-421-001');
         $item->setImages([]);
         $item->setOptions([]);
         $item->save();
     }*/

    public function executeTestTimeFunction()
    {
        $result = 0;
        for ($i = 0; $i < 100000; $i++) {
            $result += $i;
        }
        return $result;
    }

    public function executeTime()
    {

        return $this->executeTestTimeFunction();
    }

    /**
     * bắt buộc phải có loại sản phẩm
     * @return string
     */
    public function executeSendHaravan()
    {

        $client = new BizWebClient('itemd-shop.myharavan.com', 'f4fd9e1e1cc343bbb6ec668930ff7f2e', '9d5fe526862ede00fe126768d8f212ce', '4506fc948bfdb2cfb3e27a1ef77e24fa');
        $test = $client->call('POST', '/admin/products.json', [
            'name' => "abc1234567899", // trường này là bắt buộc
            # 'alias' => 'quan-bo-hin-2', // cái nay có thể tự sinh
            'vendor' => 'Alitech', // nhà cung cấp
            'options' => [  //đây là các thuộc tính của hàng
                array('name' => 'Gia tri hang'), // tên mặt hàng)
                [
                    'name' => 'Mau sac', // màu sắc của đơn hàng
                ],
                [
                    'name' => 'Kích thước' // kích thước của đơn hàng
                ]
            ],
            'product_type' => "Dày dép", // loại sản phẩm
            'tags' => 'Emotive, Flash Memory, MP3, Music',// tag cho tên sản phẩm
            'compare_at_price_min' => 0,
            'compare_at_price_varies' => false,
            'meta_title' => 'san-pham-test-meta',
            'meta_description' => 'áo hịn , áo hịn đây',
            'content' => 'đây là đoạn thông tin về sản phẩm để đánh giá nó , đây là đoạn thông tin về sản phẩm để đánh giá nó',
            'variants' => [ // mô tả chi tiết về sản phẩm và các thuộc tính chi tiết
                [
                    "title" => "Do 35",
                    "option1" => '12345566',
                    'option2' => '【lông ánh sáng mẫu  Lớn 黃',
                    'option3' => 'nguyengiang',
                    "barcode" => "1234_pink",
                    "sku" => "IPOD2008PINK", // mã sku
                    "fulfillment_service" => "manual",
                    'price' => 10000,
                    'compare_at_price' => 100,
                    'weight' => 12.5,
                    'position' => 1,
                    "image_position" => 1
                ],
                [
                    "title" => "Xanh 35",
                    "option1" => '10000',
                    'option2' => '【lông ánh sáng mẫu  Lớn 黃',
                    'option3' => 'nguyengiang',
                    "barcode" => "1234_pink",
                    "sku" => "IPOD2008PINK", // mã sku
                    "fulfillment_service" => "manual",
                    'price' => '80000',
                    'compare_at_price' => 100,
                    'weight' => 12.5,
                    'position' => 2,
                    "image_position" => 2
                ]

            ],
            'images' => [ // gửi ảnh cho sản phẩm
                ["src" => "http://gd4.alicdn.com/bao/uploaded/i4/15211448/TB2e8FQgpXXXXaNXXXXXXXXXXXX_!!15211448.jpg"],
                ["src" => "http://hinhnendepnhat.net/wp-content/uploads/2014/06/hinh-nen-girl-xinh-viet-nam-xinh-oi-la-xinh.jpg"],
                ["src" => "http://www.12cunghoangdao.com.vn/wp-content/uploads/2015/09/tu-vi-12-cung-hoang-dao-thu-ba-ngay-15-9-2015.jpg"],
                #["src"=> "//gd4.alicdn.com/bao/uploaded/i4/15211448/TB2e8FQgpXXXXaNXXXXXXXXXXXX_!!15211448.jpg" ]
            ]
        ]);

        /*   $dataId = $test['id'];
           var_dump($dataId);die;*/

        #var_dump($test);
        return $this->renderText(json_encode($test));
        # die();
    }



    /**
     * dữ liệu gửi lên từ ảnh phải là từng rq 1
     * @return string
     * @throws \Haravan\HaravanApiException
     */
    public function executeSendProductHaravan()
    {
        $client = new HaravanClient('itemd-shop.myharavan.com', 'DeCZ6X2gpTLhHbO0tRpKMGsrWJQwC-gEdnLP-jjQwIetDYpjg58gfjt_7V-QBmXFdLKcmxywQ04vh0O42r9NzFp_FBgzKTf1t32OZREoT090_qMkgYavo4vVaH43PbOSkYPfvhnYsCm6dLxbn3fLFIbs2i6WJ1D_YMSvl8rhp-KU7ChSgKcybCxSOe95K_nL_qAxVClMFETBIZsNgWcRgHNaKj5NEsd_tkZYT1-QHwDYubdjR9G42B_IrfFbnWUTdXutfhoI0fXtlTyUYXalMggWSOueYdnWUK3kbDmuvUCZ74od7VOOkAO5XkhcImKLBSxvACF-PcGJVRhcIMT9HIkWP9hQAzf80vTJc3h7n9hDtzop9IvKA2MnfYnoRWutxTphFrJOUoqqd9VoOHwxHbwWwt1JvPK9lf5hT0H9Iq40GTB0MXDJjNEzlcri_pE7PwuGI4BRNG0StKXqWv1Nc4AwAI7MS9qY-YM6jTaG4OOKkplsBG4Lz4-pwIyu4i5Mg81NzQ');
        $test = $client->call('POST', '/admin/products.json', ["product" => [
            'title' => "abc1234567899", // trường này là bắt buộc
            # 'alias' => 'quan-bo-hin-2', // cái nay có thể tự sinh
            'vendor' => 'Alitech', // nhà cung cấp
            'options' => [  //đây là các thuộc tính của hàng
                array('name' => 'Gia tri hang'), // tên mặt hàng)
                [
                    'name' => 'Mau sac', // màu sắc của đơn hàng
                ],
                [
                    'name' => 'Kích thước' // kích thước của đơn hàng
                ]
            ],
            "product_type" => "Cult Products",
            'body_html' => 'đây là đoạn thông tin về sản phẩm để đánh giá nó , đây là đoạn thông tin về sản phẩm để đánh giá nó',
            'variants' => [ // mô tả chi tiết về sản phẩm và các thuộc tính chi tiết
                [
                    "title" => "Do 35",
                    "option1" => '12345566',
                    'option2' => '【lông ánh sáng mẫu  Lớn 黃',
                    'option3' => 'nguyengiang',
                    "barcode" => "1234_pink",
                    "sku" => "IPOD2008PINK", // mã sku
                    "fulfillment_service" => "manual",
                    'price' => 10000,
                    'compare_at_price' => 100,
                    'weight' => 12.5,
                    'position' => 1,
                    "image_position" => 1
                ],
                [
                    "title" => "Xanh 35",
                    "option1" => '10000',
                    'option2' => '【lông ánh sáng mẫu  Lớn 黃',
                    'option3' => 'nguyengiang',
                    "barcode" => "1234_pink",
                    "sku" => "IPOD2008PINK", // mã sku
                    "fulfillment_service" => "manual",
                    'price' => '80000',
                    'compare_at_price' => 100,
                    'weight' => 12.5,
                    'position' => 2,
                    "image_position" => 2
                ]

            ],
            'images' => [ // gửi ảnh cho sản phẩm
                ["src" => "http://gd4.alicdn.com/bao/uploaded/i4/15211448/TB2e8FQgpXXXXaNXXXXXXXXXXXX_!!15211448.jpg"],
                ["src" => "http://hinhnendepnhat.net/wp-content/uploads/2014/06/hinh-nen-girl-xinh-viet-nam-xinh-oi-la-xinh.jpg"],
                ["src" => "http://www.12cunghoangdao.com.vn/wp-content/uploads/2015/09/tu-vi-12-cung-hoang-dao-thu-ba-ngay-15-9-2015.jpg"],
                #["src"=> "//gd4.alicdn.com/bao/uploaded/i4/15211448/TB2e8FQgpXXXXaNXXXXXXXXXXXX_!!15211448.jpg" ]
            ]
        ]
        ]);

        return $this->renderText(json_encode($test)); // lưu lại giá trị id của sản phẩm
    }

    public function executeSendImageProduct()
    {
        $client = new HaravanClient('itemd-shop.myharavan.com', 'DeCZ6X2gpTLhHbO0tRpKMGsrWJQwC-gEdnLP-jjQwIetDYpjg58gfjt_7V-QBmXFdLKcmxywQ04vh0O42r9NzFp_FBgzKTf1t32OZREoT090_qMkgYavo4vVaH43PbOSkYPfvhnYsCm6dLxbn3fLFIbs2i6WJ1D_YMSvl8rhp-KU7ChSgKcybCxSOe95K_nL_qAxVClMFETBIZsNgWcRgHNaKj5NEsd_tkZYT1-QHwDYubdjR9G42B_IrfFbnWUTdXutfhoI0fXtlTyUYXalMggWSOueYdnWUK3kbDmuvUCZ74od7VOOkAO5XkhcImKLBSxvACF-PcGJVRhcIMT9HIkWP9hQAzf80vTJc3h7n9hDtzop9IvKA2MnfYnoRWutxTphFrJOUoqqd9VoOHwxHbwWwt1JvPK9lf5hT0H9Iq40GTB0MXDJjNEzlcri_pE7PwuGI4BRNG0StKXqWv1Nc4AwAI7MS9qY-YM6jTaG4OOKkplsBG4Lz4-pwIyu4i5Mg81NzQ');
        $test = $client->call('POST', '/admin/products/1002046521/images/1019427546.json', ["image" => [
            'id' => '1019427546',
            'variant_ids' => [1006464563],
            // của variant
            #'src' => 'http://img.alicdn.com/imgextra/i2/1963781599/TB26vM1gFXXXXaPXpXXXXXXXXXX_!!1963781599.jpg' // id của ảnh
        ]]);

        return $this->renderText(json_encode($test)); // lưu lại giá trị id của sản phẩm
    }


    public function executeRunCmd(){
        $client = HaravanService::createClient(1);
        $itemRepo = new ItemsRepository(ConnectMongoDB::getConnection());
        $item = $itemRepo->findOneById('56cacaaedf30a46004000069');
        $server = new HaravanService($client);
        $server->syncItem($item);

    }

    /**
     * trong truong hop neu post thi ko can gui len gia tri ciar id
     * @return string
     * @throws \Haravan\HaravanApiException
     */
    public function executePostImage(){
        $client = new HaravanClient('itemd-shop.myharavan.com', 'DeCZ6X2gpTLhHbO0tRpKMGsrWJQwC-gEdnLP-jjQwIetDYpjg58gfjt_7V-QBmXFdLKcmxywQ04vh0O42r9NzFp_FBgzKTf1t32OZREoT090_qMkgYavo4vVaH43PbOSkYPfvhnYsCm6dLxbn3fLFIbs2i6WJ1D_YMSvl8rhp-KU7ChSgKcybCxSOe95K_nL_qAxVClMFETBIZsNgWcRgHNaKj5NEsd_tkZYT1-QHwDYubdjR9G42B_IrfFbnWUTdXutfhoI0fXtlTyUYXalMggWSOueYdnWUK3kbDmuvUCZ74od7VOOkAO5XkhcImKLBSxvACF-PcGJVRhcIMT9HIkWP9hQAzf80vTJc3h7n9hDtzop9IvKA2MnfYnoRWutxTphFrJOUoqqd9VoOHwxHbwWwt1JvPK9lf5hT0H9Iq40GTB0MXDJjNEzlcri_pE7PwuGI4BRNG0StKXqWv1Nc4AwAI7MS9qY-YM6jTaG4OOKkplsBG4Lz4-pwIyu4i5Mg81NzQ');
        $test = $client->call('POST', '/admin/products/1002046879/images.json', ["image" => [
            'variant_ids' => [1006466850],
            // của variant
            'src' => 'http://img.alicdn.com/imgextra/i2/1963781599/TB26vM1gFXXXXaPXpXXXXXXXXXX_!!1963781599.jpg' // id của ảnh
        ]]);

        return $this->renderText(json_encode($test)); // lưu lại giá trị id của sản phẩm
    }

    /**
     * nếu push sản phẩm lên thì phải kèm theo giá trị của id muốn update
     * @return string
     * @throws \Haravan\HaravanApiException
     */
    public function executePutImage(){
        $client = new HaravanClient('itemd-shop.myharavan.com', 'DeCZ6X2gpTLhHbO0tRpKMGsrWJQwC-gEdnLP-jjQwIetDYpjg58gfjt_7V-QBmXFdLKcmxywQ04vh0O42r9NzFp_FBgzKTf1t32OZREoT090_qMkgYavo4vVaH43PbOSkYPfvhnYsCm6dLxbn3fLFIbs2i6WJ1D_YMSvl8rhp-KU7ChSgKcybCxSOe95K_nL_qAxVClMFETBIZsNgWcRgHNaKj5NEsd_tkZYT1-QHwDYubdjR9G42B_IrfFbnWUTdXutfhoI0fXtlTyUYXalMggWSOueYdnWUK3kbDmuvUCZ74od7VOOkAO5XkhcImKLBSxvACF-PcGJVRhcIMT9HIkWP9hQAzf80vTJc3h7n9hDtzop9IvKA2MnfYnoRWutxTphFrJOUoqqd9VoOHwxHbwWwt1JvPK9lf5hT0H9Iq40GTB0MXDJjNEzlcri_pE7PwuGI4BRNG0StKXqWv1Nc4AwAI7MS9qY-YM6jTaG4OOKkplsBG4Lz4-pwIyu4i5Mg81NzQ');
        $test = $client->call('PUT', '/admin/products/1002046879/images/1019434580.json', ["image" => [
            "id" => '1019434580',
            'variant_ids' => [1006466850],
            // của variant
           # 'src' => 'http://img.alicdn.com/imgextra/i2/1963781599/TB26vM1gFXXXXaPXpXXXXXXXXXX_!!1963781599.jpg' // id của ảnh
        ]]);

        return $this->renderText(json_encode($test)); // lưu lại giá trị id của sản phẩm
    }

    public function executeGetImage(){
        $itemRepo = new ItemsRepository(ConnectMongoDB::getConnection());
        $product =  $itemRepo->findOneById('570b1457df30a4f00d00002b');
        /** @var \Mongodb\Items $product */
        $integration = $product->getIntegration('HARAVAN');
        $image_key = $integration['image_key'];
        $variants = $product->getVariants();
        $params = [];
        foreach($variants as $item_variant){
            /** @var \Mongodb\ItemVariant  $item_variant*/
            $tmp = [];
            $tmp_app =  $item_variant->getIntegration('HARAVAN');
            $tmp['variant_ids'] = (array)$tmp_app['variant_id'];
            $tmp['src'] = $item_variant->getImage();
            if(array_key_exists(md5(UrlHelper::normalizeImageUrl($item_variant->getImage())),$image_key)){
                $tmp['id'] = $image_key[md5(UrlHelper::normalizeImageUrl($item_variant->getImage()))];
            }
            $params[] = $tmp;
        }
        return $this->renderText(json_encode($params)); // lưu lại giá trị id của sản phẩm
    }




}