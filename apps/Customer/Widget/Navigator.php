<?php
use CMSBackend\Library\CMSBackendAuth;
use Flywheel\Base;
use Flywheel\Html\Widget\Menu;

class Navigator extends Menu {
    #public $viewFile = 'navigator';
    public $viewFile = 'navigatorMenu';
    private $_menus = [];
    protected function _init() {
        parent::_init();
        $this->viewPath = Base::getApp()->getController()->getTemplatePath() .DIRECTORY_SEPARATOR .'Widget' .DIRECTORY_SEPARATOR;
        //cart

        //trading order
        $this->_menus['dashboard'] = [
            'label' => 'Dashboard',
            'url' => ['Customer/default'],
            'items' => [],
            'icon' => 'pg-home',
            'id' =>'_home'
        ];

        //finance
        $this->_menus['product'] = [
            'label' => 'Sản phẩm',
            'url' => 'javascript:',
            'icon' => 'fa fa-list',
            'items' => [
                [
                    'label' => 'DS sản phẩm',
                    'url' => 'danh-sach-san-pham',
                    'icon' => 'ds',
                    'id' => '_product_list',
                ],
                [
                    'label' => 'Up file giá',
                    'url' => 'price_policy/upload_items_price',
                    'icon' => 'up',
                    'id' => '_upload_items_price'
                ],
                [
                    'label' => 'DS hành động',
                    'url' => 'product_log',
                    'icon' => 'lo',
                    'id' =>'_product_log'
                ],
                [
                    'label' => 'DS dịch vụ',
                    'url' => 'product_integration',
                    'icon' => 'dv',
                    'id' =>'_product_integration'
                ]

            ],
            'id'=>'_product'
        ];
        $this->_menus['profile'] = [
            'label' => 'Cá nhân',
            'url' => 'customer_profile',
            'icon' => 'fa fa-user',
            'items' => [],
            'id' =>'_customer_profile'
        ];


        //profiles
        $this->_menus['addon'] = [
            'label' => 'Công cụ',
            'url' => 'addon',
            'icon' => 'fa fa-wrench',
            'items' => [],
            'id' =>'_addon'
        ];

        $this->_buildMenu();
    }


    private function _buildMenu() {
        foreach($this->_menus as $m) {
            if (!empty($m['items']) || (isset($m['url']) && $m['url'] != '#')) {
                $this->items[] = $m;
            }
        }
    }

    public function end() {
        return $this->render(array(
            'items' => $this->items,
            'deep' => $this->deep
        ));
    }
} 