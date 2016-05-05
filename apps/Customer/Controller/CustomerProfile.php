<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 12/12/2015
 * Time: 3:32 PM
 */

namespace Customer\Controller;


use Customer\Library\CustomerAppAuth;
use Flywheel\Db\Type\DateTime;
use Flywheel\Session\Session;
use Mongodb\ConnectMongoDB;
use Mongodb\CustomerProfilesRepository;

class CustomerProfile extends CustomerBase {

    public function executeDefault()
    {
        $this->setLayout('default');  // đã xét nmsgu
        $this->setView( 'Customer/profile' );
        $this->document()->title = 'Thông tin cá nhân ';

        $customer = CustomerAppAuth::getInstance()->getCustomer();
        $customerId = $customer->getId();
         #region thông tin cài đặt
        $mandango = ConnectMongoDB::getConnection();
        $repoCustomerProfile = new \Mongodb\CustomerProfilesRepository($mandango);
        $customerProfile = $repoCustomerProfile->createQuery(['customerId' => $customerId])->one();
        /** @var \Mongodb\CustomerProfiles $customerProfile */
        $inter = $customerProfile->getIntegration();
        $customer_profile = [];
        foreach($inter as $key => $value){
            $temp['service'] = $key;
            $temp['createdTime'] = date('H:i d/m/Y',$value['createdTime']->sec);
            $customer_profile[] = $temp;
        }
        #endregion
        $this->view()->assign('customer_profile', $customer_profile);
        $this->view()->assign('customer', $customer);
        $this->document()->addJsVar('logout_url', $this->createUrl('/login'));
        ########################################
        if ($this->request()->isPostRequest()) {
            $email = $this->post('email');
            $mobile = $this->post('mobile');
            $name = $this->post('name');
            $select_province = $this->post('select_province');
            $select_district = $this->post('select_district');
            $address = $this->post('address');
            $id = $this->post('id');//mobile
            $birthday = DateTime::createFromFormat('d/m/Y', $this->post('birthday'));
            $customer = CustomerAppAuth::getInstance()->getCustomer();
            if ($customer instanceof \Customer) {
                $customer->setEmail($email);
                $customer->setMobile($mobile);
                $customer->setName($name);
                $customer->setAddress($address);
                $customer->setBirthday($birthday);
                $customer->setProvinceId($select_province);
                $customer->setDistrictId($select_district);

                $error_message = array();

                if ($email != '' && \Flywheel\Validator\Util::isValidEmail($email) != 1) {
                    $error_message[] = 'Email không đúng định dạng';
                }
                if ($mobile == '' || \Flywheel\Validator\Util::isValidPhoneNumber($mobile) != 1) {
                    $error_message[] = 'Số điện thoại không hợp lệ';
                }
                if (!$birthday instanceof \DateTime) {
                    $error_message[] = 'Ngày sinh không đúng định dạng.';
                }
                if (!empty($error_message)) {
                    Session::getInstance()->setFlash('error_message', $error_message);
                    $this->request()->redirect($this->createUrl('CustomerProfile'));
                }
                if($customer->save()){
                    Session::getInstance()->setFlash('success_message', 'CẬP NHẬT THÔNG TIN THÀNH CÔNG');
                    $this->request()->redirect($this->createUrl('CustomerProfile'));
                }
            }
        }


        return $this->renderComponent();

    }



    /**
     * thực hiện đổi pass
     * @return string
     */
    public function executeChangePassWord(){
        $customer = CustomerAppAuth::getInstance()->getCustomer();
        $ajax = new \AjaxResponse();
        $ajax->type = \AjaxResponse::ERROR;
        $errors = [];

        if (false === $this->request()->isPostRequest() || empty($customer)) {
            $errors[] = 'Lỗi xác thực.';
        } else {
            $oldPass = $this->post('old_pass');
            $newPass = $this->post('new_pass');
            if (true === \CustomerPeer::changePassword($customer , $oldPass, $newPass)) {
                $ajax->message = 'Đổi mật khẩu thành công.';
                $ajax->type = \AjaxResponse::SUCCESS;
                return $this->renderText($ajax->toString());
            } else {
                $errors[] = 'Bạn đã nhập sai mật khẩu';
            }
        }
        foreach ($customer->getValidationFailures() as $validationFailure) {
            $errors[$validationFailure->getColumn()] = $validationFailure->getMessage();
        }
        $ajax->message = json_encode($errors);
        return $this->renderText($ajax->toString());

    }




}