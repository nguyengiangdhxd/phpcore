<?php
$r = array(
    '__urlSuffix__' => '.html',
    '__remap__' => array(
        'route' => 'Todo/default'
    ),
    '/' => array(
        'route' => 'Todo/default' // đổi tên controller thì sẽ hiển thị được
    ),
    '{controller}' => array(
        'route' => '{controller}/default'
    ),
    '{controller}/{action}' => array(
        'route' => '{controller}/{action}'
    ),
    '{controller}/{action}/{id:\d+}' => array(
        'route' => '{controller}/{action}'),
);
return $r;