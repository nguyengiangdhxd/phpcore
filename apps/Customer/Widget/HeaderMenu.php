<?php
use Flywheel\Base;
use Flywheel\Controller\Widget;

class HeaderMenu extends \Flywheel\Html\Widget\Menu {
    public $viewFile = 'headerMenu';

    private $_menus = [];
    protected function _init()
    {
        parent::_init();
        $this->_menus['tool'] = [
            'label' => 'Công cụ',
            'url' => ['addon'],
            'id' => '_addon',
            'icon' =>'pg-settings_small'
        ];

        //trading order
        $this->_menus['private'] = [
            'label' => 'Cá nhân',
            'url' => ['customer_profile'],
            'id' => '_customer_profile',
            'icon'=> 'fa fa-user'
        ];

        //finance
        $this->_menus['logout'] = [
            'label' => 'Đăng xuất',
            'url' => ['login/logout'],
            'id' => '_logout',
            'icon'=>'pg-power'

        ];

        $this->_buildMenu();

        $this->viewPath = Base::getApp()->getController()->getTemplatePath() . DIRECTORY_SEPARATOR . 'Widget' . DIRECTORY_SEPARATOR;
    }

    public function end() {
        return $this->render([
            'items' => $this->items,
            'auth' => Base::getApp()->getController()->customerLogin()
        ]);
    }
    private function _buildMenu() {
        foreach($this->_menus as $m) {
            if (!empty($m['items']) || (isset($m['url']) && $m['url'] != '#')) {
                $this->items[] = $m;
            }
        }
    }
}