<?php
namespace Customer\Controller;
use AjaxResponse;
use Customer\Event\CustomerEvent;
use Customer\Library\CustomerAppAuth;
use Flywheel\Factory;

class Customer extends CustomerBase{

   public function executeDefault(){
       $this->setLayout('default');  // đã xét nmsgu
       $this->setView( 'Customer/default');
       return $this->renderComponent();
   }
}
