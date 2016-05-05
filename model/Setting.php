<?php 
/**
 * Setting
 * @version		$Id$
 * @package		Model

 */

require_once dirname(__FILE__) .'/Base/SettingBase.php';
class Setting extends \SettingBase {

    /**
     * Lấy về giá trị setting theo key; trả về $default nếu chưa tồn tại bản ghi
     * @param $key
     * @param mixed $default
     * @return null|string
     */
    public static function getSetting($key, $default = null) {
        $setting = self::retrieveBySettingKey($key);
        if (!$setting) {
            return $default;
        }
        return $setting->getSettingValue();
    }

}