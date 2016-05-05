<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 1/20/2016
 * Time: 5:51 PM
 */

namespace Core\IntergrationApp;


use Core\CustomerAuth;
use Customer\Controller\CustomerBase;
use Flywheel\Exception;
use Haravan\HaravanClient;
use Haravan\HaravanService;

class HaravanApp implements IIntergrationApplication{

    /**
     * hàm được gọi khi click vào nút cài đặt ứng dụng trên haravan
     * @param CustomerBase $controller
     * @return string
     */
    function createAuthorizeUrl(CustomerBase $controller)
    {
        $shop = $controller->get('shop');
        $client = new HaravanClient($shop, '');
        $url = $client->getAuthorizeUrl('read_products write_products',$controller->createUrl('intergration/authorize',['app_key' => 'HARAVAN']));
        //$url = $client->getAuthorizeUrl('read_products write_products',$controller->createUrl('ket-noi-haravan'));
       # var_dump($url);die();
        return $url;
    }

    /**
     * kiểm tra xem người dùng đã cài đặt haravan chưa
     * @param CustomerBase $controller
     * @return bool|mixed
     * @throws \Exception
     */
    function isConfirmed(CustomerBase $controller)
    {
        $confirm = $controller->get('confirm', 'BOOLEAN', false);
        if ($confirm) {
            return true;
        }

        $store = $controller->get('shop');
        $settings = HaravanService::getCustomerSettings(CustomerAuth::getInstance()->getCusId());

        if ($settings) {
            if ($store == $settings['shop']) {
                //cài đặt lại trên store cũ thì ok không cần confirm
                $confirm = true;
            }
        }

        return $confirm;
    }

    /**
     * lấy các thông tin cần thiết để hiển thị lên form confirm
     * @param CustomerBase $controller
     * @return array
     */
    function getConfirmData(CustomerBase $controller)
    {
        $data = [];
        $data['app_name'] = 'Haravan';
        $data['external_account'] = $controller->get('shop');

        return $data;
    }

    function authorize(CustomerBase $controller)
    {
        $code = $controller->get('code');
        $shop = $controller->get('shop');

        $client = new HaravanClient($shop, '');
        $accessToken = $client->getAccessToken($code, $controller->createUrl('intergration/authorize',['app_key' => 'HARAVAN']));

        if (empty($accessToken)) {
            //TODO: báo lỗi
            throw new Exception('Could not get access token');
        }
        else {
            $customerId = CustomerAuth::getInstance()->getCusId();
            HaravanService::install($customerId, $shop, $accessToken);
            $url = $controller->createUrl('customer/');
            $controller->redirect($url);
        }
    }

    /**
     * @param \Mongodb\Items $item
     * @throws \Exception
     */
    function sync($item)
    {
        $client = HaravanService::createClient($item->getCustomerId());
        $server = new HaravanService($client);
        $server->syncItem($item); // hàm chạy đồng bộ chính
    }
}