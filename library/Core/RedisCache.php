<?php
/**
 * Created by PhpStorm.
 * User: Piggat
 * Date: 7/17/15
 * Time: 2:44 PM
 */

namespace SeuDo\Common;

use \Flywheel\Redis\Client as RedisClient;
class RedisCache {
    /**
     * Pool chứa dữ liệu của process này, đảm bảo dữ liệu lưu trên process này, đọc ở process này có cùng giá trị
     * Không có tác dụng nếu chạy trên 2 process khác nhau; support các switch on/off trên cùng process, tăng tốc độ và
     * đảm bảo không bị redis delay
     * @var array
     */
    public static $_pool = [];

    public static function get($key) {
        if (array_key_exists($key, self::$_pool)) {
            return self::$_pool[$key];
        }

        $client = RedisClient::getConnection('common_cache');
        $data = $client->get($key);
        return json_decode($data, true);
    }

    /**
     * Set giá trị cho cache, thời gian mặc định 2 tiếng
     * @param $key
     * @param $value
     * @param int $ttl
     */
    public static function set($key, $value, $ttl = 7200) {
        $client = RedisClient::getConnection('common_cache');
        $value = json_encode($value);
        $client->setex($key, $ttl, $value);

        self::$_pool[$key] = $value;
    }

    /**
     * Xóa cache theo key
     * @param $key
     */
    public static function delete($key) {
        $client = RedisClient::getConnection('common_cache');
        $client->delete($key);
    }
} 