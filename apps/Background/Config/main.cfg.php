<?php
defined('APP_PATH') or define('APP_PATH', dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR);
\Flywheel\Loader::addNamespace('Background', dirname(APP_PATH));

return array(
  'app_name'=>'Background',
  'app_path'=> APP_PATH,
  'import'=>array(
    'app.Library.*',
    'app.Task.*',
    'root.model.*'
  ),
  'namespace'=> 'Background',
  'timezone'=>'Asia/Ho_Chi_Minh',
);