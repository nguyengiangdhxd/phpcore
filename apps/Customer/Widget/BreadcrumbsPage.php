<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 12/11/2015
 * Time: 3:18 PM
 */
use Flywheel\Base;
class BreadcrumbsPage extends \Flywheel\Html\Widget\Breadcrumbs {
    public $viewFile = 'breadCrumbsPage';

    protected function _init() {
        parent::_init();
        $this->viewPath = Base::getApp()->getController()->getTemplatePath() .DIRECTORY_SEPARATOR .'Widget' .DIRECTORY_SEPARATOR;
    }


    public function end() {
        return $this->render(array(
            'activesLink' => $this->_actives,
            'inActivesLink' => $this->_inactive,
        ));
    }
}