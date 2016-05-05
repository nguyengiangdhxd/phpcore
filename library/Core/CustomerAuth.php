<?php
/**
 * Class quản lý phiên đăng nhập, đánh dấu người dùng đã được authenticate hay chưa?
 *
 * User: luuhieu
 * Date: 12/10/15
 * Time: 0:28
 */

namespace Core;


use Flywheel\Db\Type\DateTime;
use Flywheel\Factory;
use Flywheel\Session\Authenticate;
use Flywheel\Session\Session;

class CustomerAuth extends Authenticate {
    protected static $_instance = null;

    /**
     * @return CustomerAuth
     */
    public static function getInstance() {
        if(null === static::$_instance){
            static::$_instance = new static();
        }

        return static::$_instance;
    }

    /**
     * @throws \Exception
     * @throws \Flywheel\Storage\Exception
     */
    public function init() {
        if (null != ($id = Session::get('customer\id'))) { //session write
            if (\Customer::retrieveById($id)) {
                $this->_setIsAuthenticated(true);
            }
        } else {
            $cookie = Factory::getCookie();

            if ($data = $cookie->readSecure('customer')) {
                $data = json_decode($data, true);

                $customer = \Customer::retrieveByUsername($data['username']);
                if ($customer && $data['secret'] == $customer->getSecret()) {
                    //@TODO should throw a event, push to queue and tracking last login time in background
                    $customer->setLastLoginTime(new DateTime());
                    $customer->setLastLoginIp(\UsersPeer::getClientIp());
                    $customer->save();

                    $this->setSession($customer);
                    $this->_storeCookieAuth($customer);
                    $this->_setIsAuthenticated(true);
                }
            }
        }
    }

    /**
     * Authenticate
     *
     * @param $credential
     * @param $password
     * @param bool $save_login
     * @return bool|int
     * @throws \Exception
     */
    public function authenticate($credential, $password, $save_login = false) {
        $this->dispatch('onBeginCustomerAuthenticate', new GlobalEvent($this,array($credential)));

        if (empty($credential) || empty($password)) return self::ERROR_CREDENTIAL_INVALID;

        $this->_identity = $credential;
        $this->_credential = $password;

        $customer = \Customer::retrieveByUsername($credential);
      /*  if(!$customer){
            $customer = \Customer::retrieveByEmail($credential);
        }*/
        if(!$customer || empty($customer) || !($customer instanceof \Customer)){
            return self::ERROR_UNKNOWN_IDENTITY;
        }

        if(($customer instanceof \Customer)) {
            if ($customer->getPassword() != \Users::hashPassword($password, $customer->getPassword()))
            {
                return self::ERROR_CREDENTIAL_INVALID;
            }

            $this->setSession($customer);
            $this->_setIsAuthenticated(true);
            $customer->setLastLoginTime(new DateTime());
            $customer->setLastLoginIp(\UsersPeer::getClientIp());
            $customer->save();

            if ($save_login) {
                $this->_storeCookieAuth($customer);
            }

            $this->dispatch('onAfterCustomerAuthenticate', new GlobalEvent($this, [
                'customer_id' => $customer->getId()
            ]));

            return $this->isAuthenticated();
        }
        return false;
    }

    /**
     * @return \Customer
     */
    public function getCustomer() {
        return \Customer::retrieveById($this->getCusId());
    }

    public function getCusId() {
        return Session::get('customer\id');
    }

    /**
     * log out
     */
    public function logout() {
        Session::set('account',null);
        Session::getInstance()->remove('customer');
        $this->_setIsAuthenticated(false);
    }

    /**
     * set session
     * @param \Customer $cus
     */
    public function setSession(\Customer $cus) {
        Session::set('customer',  array('id' => $cus->getId()));
    }

    /**
     * @param \Customer $customer
     */
    protected function _storeCookieAuth(\Customer $customer)
    {
        $cookie = Factory::getCookie();
        $cookie->writeSecure('customer', json_encode($customer->getAttributes('username,secret')));
    }
}