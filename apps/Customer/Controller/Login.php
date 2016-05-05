<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 12/12/2015
 * Time: 11:37 AM
 */
namespace Customer\Controller;

use Customer\Event\CustomerEvent;
use Customer\Library\CustomerAppAuth;
use Flywheel\Factory;
use Flywheel\Session\Session;

class Login extends CustomerBase {

    public function beforeExecute() {
        $this->_need_login = false;
        parent::beforeExecute();
    }
    public function executeDefault() {
        $this->document()->title = 'Đăng nhập';
        $this->setLayout('login');
        $this->setView('Login/login');
        /** @var CustomerAppAuth $auth */
        $auth = CustomerAppAuth::getInstance();
        #$customer = CustomerAppAuth::getInstance()->getCustomer();
        $comeback = $this->get('r');
        $comeback = (null != $comeback) ? urldecode($comeback) : '/';
        if ($auth->isAuthenticated()) {
            $this->redirect($comeback); // $comeback là cái gì
        }

        $display = $this->post('username');
        if (!$display) {
            $display = Factory::getCookie()->read('username');
        }

        $error = array();

        if ($this->request()->isPostRequest()) {
            //check captcha first
            $password = $this->post('password');
            $credential = $this->post('username'); //don't care display name
            Factory::getCookie()->write('username', $credential);

            if (empty($error) && true === ($result = $auth->authenticate($credential, $password))) {
                $this->dispatch(LOGIN_SUCCESS_TO_CUSTOMER_CP, new CustomerEvent($this, array(
                    'auth' => $auth
                )));
                //authenticated, redirect to pre-page
                if ($comeback) {
                    $this->redirect($comeback);
                }
                else {
                    $this->redirect('CustomerProfile');
                }
            } else if (isset($result)) {
                switch ($result) {
                    case CustomerAppAuth::ERROR_CREDENTIAL_INVALID:
                        $error[] = 'Vui lòng điền đúng email và mật khẩu';
                        break;
                    case CustomerAppAuth::ERROR_UNKNOWN_IDENTITY:
                        $error[] = 'Không tìm thấy thông tin khách hàng';
                        break;
                    default:
                        $error[] = 'Đăng nhập không thành công';
                }
            }
        }
        $this->view()->assign('display', $display);
        $this->view()->assign('error', $error);
        return $this->renderComponent();
    }

    public function executeLogout() {
        CustomerAppAuth::getInstance()->logout();
        $this->request()->redirect($this->createUrl('/login'));
    }
}