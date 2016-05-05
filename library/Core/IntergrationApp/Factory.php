<?php
/**
 * Created by PhpStorm.
 * User: Piggat
 * Date: 12/24/15
 * Time: 2:48 PM
 */

namespace Core\IntergrationApp;


class Factory {
    /**
     * @param $app_key
     * @return BizwebApp
     * @author kiennx
     */
    public static function createApplication($app_key) {
        $app_key = strtoupper($app_key);
        if ($app_key=='BIZWEB') {
            return new BizwebApp();
        }
        // nếu là Haravan thì trả lại app của haravan
        if($app_key == 'HARAVAN'){
             return new HaravanApp();
        }
        return null;
    }
} 