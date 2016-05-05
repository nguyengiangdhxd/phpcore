<?php
use Flywheel\Loader;
$loader = require __DIR__.'/vendor/autoload.php';
define('ROOT_PATH', __DIR__);
define('GLOBAL_PATH', ROOT_PATH .DIRECTORY_SEPARATOR .'global');
define('LIBRARY_PATH', ROOT_PATH .DIRECTORY_SEPARATOR .'library');
Loader::register();
Loader::addNamespace('Mandango', LIBRARY_PATH);
// mondator
$configClasses = require __DIR__.'/configMongoDb.php';

use Mandango\Mondator\Mondator;

$mondator = new Mondator();
$mondator->setConfigClasses($configClasses);
$mondator->setExtensions(array(
    new Mandango\Extension\Core(array(
        'metadata_factory_class'  => 'Mongodb\Mapping\Metadata',
        'metadata_factory_output' => __DIR__.'/Mongodb/Mapping',
        'default_output'          => __DIR__.'/Mongodb',
    )),
    new Mandango\Extension\DocumentArrayAccess(),
    new Mandango\Extension\DocumentPropertyOverloading(),
));


$mondator->process();
echo "DONE";
