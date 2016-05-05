<?php
/**
 * Created by PhpStorm.
 * User: luuhieu
 * Date: 2/20/16
 * Time: 17:47
 */

namespace Core;


use Flywheel\Object;

class GlobalEventDispatcher extends Object
{
    protected static $_instance;

    /**
     * @return GlobalEventDispatcher
     */
    public static function getInstance() {
        if (null == self::$_instance) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    /**
     * add handling event
     * @param $event
     */
    public static function addEvent($event) {
        $handling = self::getInstance();
        self::getEventDispatcher()->addListener($event, array($handling, $event));
    }

    /**
     * add handling many events
     * @param $events
     */
    public static function addEvents($events) {
        for($i = 0; $i < sizeof($events); ++$i) {
            self::addEvent($events[$i]);
        }
    }
}