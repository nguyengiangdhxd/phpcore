<?php
defined('APP_PATH') or define('APP_PATH', dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR);
\Flywheel\Loader::addNamespace('Backend', dirname(APP_PATH));

return array(
  'app_name'=>'Backend',
  'app_path'=> APP_PATH,
  'view_path'=> APP_PATH .DIRECTORY_SEPARATOR.'Template/',
  'import'=>array(
    'app.Library.*',
    'app.Controller.*',
    'root.model.*'
  ),
  'namespace'=> 'Backend',
  'timezone'=>'Asia/Ho_Chi_Minh',
  'template'=>'Default'
);