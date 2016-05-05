<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 4/18/2016
 * Time: 5:37 PM
 */

namespace Customer\Controller;


use Core\Common;
use Core\CustomerAuth;
use Mongodb\ConnectMongoDB;
use Mongodb\CustomerProfilesRepository;

class ProductIntegration extends CustomerBase{

    public function executeDefault()
    {
        $this->setLayout('default');
        $this->document()->title = 'Danh sách log sản phẩm';
        $this->setView('Product/product_integration');
        $customer_id = CustomerAuth::getInstance()->getCustomer()->getId();
        $conditionProduct = [];
        $conditionProduct['customerId'] = $customer_id;
        $customerRepo = new \Mongodb\CustomerProfilesRepository(ConnectMongoDB::getConnection());
        $customerProfile = $customerRepo->createQuery()
            ->criteria($conditionProduct)->one();
        $serviceType = Common::executeGetIntegrationOfUser();
        $arr_data = $customerProfile->toArray();
        $arr_data['service_integration'] = $serviceType;

        $array_data_condition = [];
        $array_data_condition['data'] = $arr_data;
        $this->view()->assign(
            $array_data_condition
        );
        return $this->renderComponent();
    }

    /**
     * get value install service
     * @return string
     */
    public function executeRemoveService(){

        $service_type = $this->request()->post('service_type');
        $ajax = new \AjaxResponse();
        $customer_id = CustomerAuth::getInstance()->getCustomer()->getId();
        $conditionProduct = [];
        $conditionProduct['customerId'] = $customer_id;
        $customerRepo = new \Mongodb\CustomerProfilesRepository(ConnectMongoDB::getConnection());
        $customerProfile = $customerRepo->createQuery()
            ->criteria($conditionProduct)->one();
        /** @var  \Mongodb\CustomerProfiles  $customerProfile*/
        if($customerProfile->getIntegration()){ // nếu có tồn tại thì mới thực hiện 1 tỏng 2
            $integrations = $customerProfile->getIntegration();
            $exists_key = array_key_exists ( $service_type , $integrations);
            if($exists_key){ // nếu có tồn tại thì mới xử lý tiếp
                unset($integrations[$service_type]);
                $customerProfile->setIntegration($integrations);
                if($customerProfile->save()){
                    $ajax->message = "Xóa thành công !";
                    $ajax->type = \AjaxResponse::SUCCESS;
                    return $this->renderText($ajax->toString());
                }
            }else{
                $ajax->message = "Dịch vụ chưa được cài đặt !";
                $ajax->type = \AjaxResponse::ERROR;
                return $this->renderText($ajax->toString());
            }
        }
        $ajax->message = "Dịch vụ chưa được cài đặt !";
        $ajax->type = \AjaxResponse::ERROR;
        return $this->renderText($ajax->toString());
    }



}