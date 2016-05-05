<?php
defined('APP_PATH') or define('APP_PATH', dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR);
\Flywheel\Loader::addNamespace('API', dirname(APP_PATH));

return array(
    'app_name'=>'API',
    'app_path'=> APP_PATH,
    'import' => array(
        'root.model.*',
        'app.Include.*'
    ),
    'namespace'=> 'API',
    'timezone'=>'Asia/Ho_Chi_Minh',
);