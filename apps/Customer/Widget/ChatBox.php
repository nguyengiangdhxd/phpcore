<?php
/**
 * Created by PhpStorm.
 * User: NguyenHoangGiang
 * Date: 4/2/2016
 * Time: 10:27 AM
 */
use Flywheel\Base;
use Flywheel\Controller\Widget;
class ChatBox extends Widget{

    public function begin() {
        $this->viewPath = Base::getApp()->getController()->getTemplatePath() .DIRECTORY_SEPARATOR .'Widget' .DIRECTORY_SEPARATOR;
        $this->viewFile = "chatBox";
    }
    public function end()
    {
        return $this->render(array(
            'setting' => $this->setting
        ));
    }
}