<?php

/**
 * Class UsersPeer
 * Static util methods for Users packages
 */

class UsersPeer {
    /**
     * hasting user's password
     * @param $plainText
     * @param null $salt
     * @return string
     */
    public static function hashPassword($plainText, $salt = null) {
        $salt = (null == $salt) ? \ModelUtil::randSha1(40) : substr($salt, 0, 40);
        return $salt . md5($salt . $plainText);
    }

    /**
     * Get Client's Ip
     * @return string
     */
    public static function getClientIp() {
        if (getenv('HTTP_CLIENT_IP')) {
            $ipAddress = getenv('HTTP_CLIENT_IP');
        }
        else if(getenv('HTTP_X_FORWARDED_FOR')) {
            $ipAddress = getenv('HTTP_X_FORWARDED_FOR');
        }
        else if(getenv('HTTP_X_FORWARDED')) {
            $ipAddress = getenv('HTTP_X_FORWARDED');
        }
        else if(getenv('HTTP_FORWARDED_FOR')) {
            $ipAddress = getenv('HTTP_FORWARDED_FOR');
        }
        else if(getenv('HTTP_FORWARDED')) {
            $ipAddress = getenv('HTTP_FORWARDED');
        }
        else if(getenv('REMOTE_ADDR')) {
            $ipAddress = getenv('REMOTE_ADDR');
        }
        else {
            $ipAddress = 'UNKNOWN';
        }

        return $ipAddress;
    }

    /**
     * Check username available
     * @param $username
     * @return bool
     */
    public static function checkAvailableUsername($username)
    {
        $c = \Users::read()
            ->count('id')
            ->where('`username` = ?')
            ->setParameter(0, $username, \PDO::PARAM_STR)
            ->execute();

        return ($c == 0);
    }

    /**
     * Check email available
     * @param $email
     * @return bool
     */
    public static function checkAvailableEmail($email)
    {
        $c = \Users::read()
            ->count('id')
            ->where('`email` = ?')
            ->setParameter(0, $email, \PDO::PARAM_STR)
            ->execute();

        return ($c == 0);
    }
}