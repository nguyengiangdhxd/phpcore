<?php
use Flywheel\Base;

chdir(__DIR__);
set_time_limit(1800);
require __DIR__ .'/../bootstrap.php';
$globalCnf = require ROOT_PATH . '/config.cfg.php';

$config = array_merge( $globalCnf, require __DIR__ . '/../apps/Background/Config/main.cfg.php');

register_shutdown_function('fatal_catch');

define('APP_DIR',ROOT_PATH.'/'.'apps'.'/Background');

$env = Base::ENV_DEV;

if ($env == Base::ENV_DEV) {
    restore_error_handler();
    restore_exception_handler();
}

try {
    $app = Base::createConsoleApp($config, $env, true);
    $app->run();
} catch (\Exception $e) {
    \Flywheel\Exception::printExceptionInfo($e);
    \Core\ErrorHandler::exceptionHandling($e);
}

function fatal_catch()
{
    define('E_FATAL', E_ERROR | E_USER_ERROR | E_PARSE | E_CORE_ERROR |
        E_COMPILE_ERROR | E_RECOVERABLE_ERROR);
    $error = error_get_last();

    if($error && ($error['type'] & E_FATAL)){
        \Core\ErrorHandler::errorHandling($error['type'], $error['message'], $error['file'], $error['line']);
    }
}