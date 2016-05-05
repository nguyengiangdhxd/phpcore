<?php

/**
 * Created by PhpStorm.
 * User: luuhieu
 * Date: 12/24/15
 * Time: 21:59
 */
class GravatarHelper
{
    /**
     * Gen gravatar url
     *
     * @param $email
     * @param null $size
     * @param string $d
     * @param string $r
     * @return string
     */
    public static function getGravatar($email, $size = null, $d = 'identicon', $r = 'g')
    {
        $url = 'http://www.gravatar.com/avatar/';
        $url .= md5(strtolower(trim($email)));
        $url .= "?s=$size&d=$d&r=$r";
        return $url;
    }
}