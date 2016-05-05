<?php
/**
 * Created by PhpStorm.
 * User: Piggat
 * Date: 12/24/15
 * Time: 2:51 PM
 */

namespace Core\IntergrationApp;


use BizWeb\BizWebClient;
use BizWeb\BizWebService;
use Core\CustomerAuth;
use Customer\Controller\CustomerBase;
use Exception;

class BizwebApp implements IIntergrationApplication {
    /**
     * @param CustomerBase $controller
     * @return string
     * @author kiennx
     */
    function createAuthorizeUrl(CustomerBase $controller)
    {
        $store = $controller->get('store');

        $client = new \BizWeb\BizWebClient($store, '');
        $url = $client->getAuthorizeUrl('read_products,write_products',$controller->createUrl('intergration/authorize',['app_key' => 'BIZWEB']));

        return $url;
    }

    /**
     * @param CustomerBase $controller
     * @return bool|mixed
     * @author kiennx
     */
    function isConfirmed(CustomerBase $controller)
    {
        $confirm = $controller->get('confirm', 'BOOLEAN', false);
        if ($confirm) {
            return true;
        }

        $store = $controller->get('store');
        $settings = BizWebService::getCustomerSettings(CustomerAuth::getInstance()->getCusId());

        if ($settings) {
            if ($store == $settings['store']) {
                //cài đặt lại trên store cũ thì ok không cần confirm
                $confirm = true;
            }
        }

        return $confirm;
    }

    /**
     * Lấy về các thông tin cần thiết để hiển thị lên form Confirm
     * @param CustomerBase $controller
     * @return array
     * @author kiennx
     */
    function getConfirmData(CustomerBase $controller)
    {
        $data = [];
        $data['app_name'] = 'BizWeb';
        $data['external_account'] = $controller->get('store');

        return $data;
    }

    /**
     * @param CustomerBase $controller
     * @throws \Exception
     * @author kiennx
     */
    function authorize(CustomerBase $controller)
    {
        $code = $controller->get('code');
        $shop = $controller->get('store');

        $client = new BizWebClient($shop, '');
        $accessToken = $client->getAccessToken($code, $controller->createUrl('intergration/authorize'));

        if (empty($accessToken)) {
            //TODO: báo lỗi
            throw new Exception('Could not get access token');
        }
        else {
            $customerId = CustomerAuth::getInstance()->getCusId();
            BizWebService::install($customerId, $shop, $accessToken);
            $url = $controller->createUrl('customer/');
            $controller->redirect($url);
        }
    }

    /**
     * @param \MongoDb\Items $item
     * @throws Exception
     */
    public function sync($item) {
        $client = BizWebService::createClient($item->getCustomerId());
        $server = new BizWebService($client);
        $server->syncItem($item);
    }
}