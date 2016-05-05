<?php
/**
 * Created by PhpStorm.
 * User: luuhieu
 * Date: 12/10/15
 * Time: 10:36
 */

namespace Core;

use Flywheel\Config\ConfigHandler;
use Flywheel\Filesystem\Filesystem;
use Flywheel\Log\Handler\RotatingFileHandler;
use \Flywheel\Log\Logger as BaseLogger;


class Logger extends BaseLogger {
    protected static $_instances = array();

    protected static $_mongo;

    const BUSINESS = 'business';
    const SYSTEM = 'system';


    /**
     * factory Logger by channel
     *
     * @param $channel
     * @param null $level
     * @return \Monolog\Logger
     */
    public static function factory($channel, $level = null) {

        if (!isset(self::$_instances[$channel])) {

            $logger = new self($channel);

            $loggerConfig = ConfigHandler::get('logger');
            $path   = $loggerConfig['path'];

            if (null == $level) {
                $debug  = $loggerConfig['level']
                    ? $loggerConfig['level']:Logger::INFO;
            } else {
                $debug = $level;
            }

            $filePath = $path.strtolower($channel);

            $logger->pushHandler(new RotatingFileHandler($filePath, 60, $debug));

            $logger->pushProcessor(array('\Core\Logger','errorHandle'));


            self::$_instances[$channel] = $logger;
        }
        return self::$_instances[$channel];
    }

    /**
     * Get list email recipients for email error alerts.
     *
     * @return array
     */
    public static function listEmailRecipientsAlert() {
        $loggerConfig = ConfigHandler::get('logger');
        $mail = $loggerConfig['mail'];

        $master = array($mail['master']);
        $follows = array();
        if(isset($mail['follow']) && !empty ($mail['follow']) ) {
            $follows = $mail['follow'];
        }

        $receivers = array_merge_recursive($master, $follows);
        return $receivers;
    }


    public static function errorHandle($record) {
        $traces = array_reverse(debug_backtrace());
        $trace = $traces[0];

        if(is_callable(array('\Core\ErrorHandler','errorHandling'))) {
            if($record['level'] > Logger::NOTICE) {
                $message = Logger::$levels[$record['level']].' -- '.$record['message'].'['.json_encode($record['context']).']';
                $log = call_user_func_array(
                    ['\Core\ErrorHandler','errorHandling'],
                    [
                        $record['level'], $message, $trace['file'], $trace['line']
                    ]);
                self::sendMailError($log);
            }

        }
        return $record;
    }

    /**
     * send mail error
     *
     * @param $log
     */
    public static function sendMailError($log) {
        $receivers = self::listEmailRecipientsAlert();
        try {
            $queue = Queue::emailError();
            if($receivers && !empty ($receivers)){
                foreach ($receivers as $receive) {
                    $data = array(
                        'email'=>$receive,
                        'subject'=>'A log has been created at '.date('Y/d/m H:i:s',time()),
                        'body'=>$log
                    );
                    $queue->push(json_encode($data));
                }
            }
        } catch(\Flywheel\Queue\Exception $e) {
            //something broken when push email error in queue. Do nothing. Use error log
            $path = RUNTIME_PATH .'/log/phperr-' .date('Y-m-d') .'.log';

            if(!file_exists($path)) {
                $filesystem = new Filesystem();
                $filesystem->dumpFile($path, $e->getMessage() .' in ' .$e->getFile() .' at' .$e->getLine(), 0777);
            }else{
                file_put_contents($path, $log, FILE_APPEND);
            }
        }
    }

    /**
     * @return \Mongo|\MongoClient
     * @throws \RuntimeException
     */
    public static function getMongoDBConnection() {
        if (null == self::$_mongo) {
            $config = ConfigHandler::get('logger');
            if (!isset($config['mongo'])) {
                throw new \RuntimeException('Logger: config mongo not found');
            }

            if (class_exists('MongoClient')) {
                $mongo = new \MongoClient($config['mongo']['dns']);
            } elseif (class_exists('Mongo')) {
                $mongo = new \Mongo($config['mongo']['dns']);
            } else {
                throw new \RuntimeException('Mongo extension does not existed!');
            }

            self::$_mongo = $mongo;
        }

        return self::$_mongo;
    }
}