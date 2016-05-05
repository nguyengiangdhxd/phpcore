<?php
use Flywheel\Loader;
define('ROOT_PATH', dirname(__FILE__));
define('GLOBAL_PATH', __DIR__ .'/global');
define('GLOBAL_INCLUDE_PATH', __DIR__ .'/global/include');
define('GLOBAL_TEMPLATES_PATH', __DIR__ .'/global/templates');
define('LIBRARY_PATH', __DIR__ .'/library');
define('RUNTIME_PATH', __DIR__ .DIRECTORY_SEPARATOR.'runtime');
define('PUBLIC_DIR', __DIR__ .'/www_html/');

require_once __DIR__ .'/vendor/autoload.php';

Loader::register();
Loader::setPathOfAlias('root', ROOT_PATH);
Loader::setPathOfAlias('global', GLOBAL_PATH);
Loader::addNamespace('Core', LIBRARY_PATH);
Loader::addNamespace('BizWeb', LIBRARY_PATH);
Loader::addNamespace('Comment', LIBRARY_PATH);
Loader::addNamespace('Mongodb', ROOT_PATH);
Loader::addNamespace('Excel', LIBRARY_PATH);
Loader::addNamespace('AdapterApi',LIBRARY_PATH);
Loader::addNamespace('AdapterSys',LIBRARY_PATH);
Loader::addNamespace('Haravan', LIBRARY_PATH);
Loader::addNamespace('CommentResource',LIBRARY_PATH);
Loader::addNamespace('RemoteSFS', LIBRARY_PATH);
//global event processing
require_once ROOT_PATH .'/global_event.php';

Loader::import('global.include.*');

\Flywheel\Config\ConfigHandler::import('root.config');

set_error_handler(['Core\ErrorHandler', 'errorHandling']);
set_exception_handler(['Core\ErrorHandler', 'exceptionHandling']);
