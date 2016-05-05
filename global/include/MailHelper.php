<?php

class MailHelper extends \Core\MailSender {

    private $template = '', $params = array();


    public static function mailHelperWithBody($template, $params, $body = "") {
        $instance = new self();
        $instance->template = $template;
        $instance->params = $params;
        if($body != ""){
            $instance->body = $body;
        }
        return $instance;
    }

    public function parseData(){
        $render = new \Flywheel\View\Render();
        if($this->template != '' and !empty($this->params)){
            $this->body = $render->render($this->template,$this->params);
        }
        if(!is_array($this->params) and $this->params!=''){
            $this->body = $this->params;
        }
        return $this;
    }

    public function validEmail() {
        return true;
    }

    public function sendMail(){
        $this->parseData();
        if($this->validEmail() !=true) {
            throw new \Flywheel\Exception('Email is not valid ! '.$this->getReciver());
        }

        if($this->getBody() =='') {
            throw new \Flywheel\Exception('Body must be set !'.$this->getReciver());
        }

        return ( $this->send() > 0 );
    }

    public static function getEmailToAlertByGroup($group) {
        $alert_email_group = \Flywheel\Config\ConfigHandler::get($group);
        $receivers = $alert_email_group['mail'];
        return $receivers;
    }


}