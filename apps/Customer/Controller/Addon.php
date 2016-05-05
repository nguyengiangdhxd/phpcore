<?php

namespace Customer\Controller;

use Customer\Library\CustomerAppAuth;
use Flywheel\Db\Type\DateTime;
use Flywheel\Session\Session;

class Addon extends CustomerBase {

    public function executeDefault()
    {
        $this->setLayout('default');  // đã xét nmsgu
        $this->setView( 'Addon/intro' );
        $this->document()->title = 'Công cụ lấy thông tin sản phẩm';
        $customer = CustomerAppAuth::getInstance()->getCustomer();
        $this->view()->assign([]);
        return $this->renderComponent();

    }

}