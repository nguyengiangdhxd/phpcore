<?php
namespace Backend\Controller;
use Backend\Controller\BackendBase;
class Backend extends BackendBase{

    public function executeDefault(){
      return $this->renderComponent();
    }
}
