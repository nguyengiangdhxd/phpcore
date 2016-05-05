<?php
$r = array(
    '__urlSuffix__' => '.html',
    '__remap__' => array(
        #'route'=>'customer/default' // thay đổi hiển thị thì ở đây
        'route' => 'customer_profile/default'
    ),
    '/' => array(
        'route' => 'customer/default' // đổi tên controller thì sẽ hiển thị được
        #'route'=>'customer_profile/default' // đổi tên controller thì sẽ hiển thị được
        #'route'=>'productlist'
    ),
    '{controller}' => array(
        'route' => '{controller}/default'
    ),
    '{controller}/{action}' => array(
        'route' => '{controller}/{action}'
    ),
    '{controller}/{action}/{id:\d+}' => array(
        'route' => '{controller}/{action}'),
    'intergration/{app_key}' => [
        'route' => 'intergration/default'
    ],
    'intergration/authorize/{app_key}' => [
        'route' => 'intergration/authorize'
    ],
    'RedirectOriginalLink/{app_key}' => [ // từ trang quản trị của bizweb khi click vào link trên app thì sẽ redirect sang trang gốc
        'route' => 'RedirectOriginalLink'
    ],
    'danh-sach-san-pham'=>[
        'route'=>'ProductList'
    ],
    'khong-thay-trang'=>[
        'route'=>'PageNotFound'
    ],
    'ProductDetail/{app_key}' => [ // từ trang quản trị của bizweb khi click vào link trên app thì sẽ hiển thị trên trang chi tiết
        'route' => 'ProductDetail'
    ],
    'chi-tiet-san-pham/{id:[_a-zA-Z0-9-]+}' => array(
        'route' => 'ProductDetail')
);
return $r;