<?php
/**
 * Created by PhpStorm.
 * User: Piggat
 * Date: 1/6/16
 * Time: 4:33 PM
 */

namespace Core\IntergrationApp;


class UrlHelper {

    /**
     * Chuẩn hóa link ảnh
     * TODO: cho phép không bỏ https
     * @param $url
     * @param bool $remove_https
     * @return mixed
     * @author kiennx
     */
    public static function normalizeImageUrl($url, $remove_https = true) {
        $url = trim($url);
        $result = preg_replace('%^(?:http)?s?:?//(.*)%si', 'http://$1', $url);
        return $result;
    }
} 