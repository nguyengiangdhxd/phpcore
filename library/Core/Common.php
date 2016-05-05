<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 1/15/2016
 * Time: 11:22 AM
 */

namespace Core;


use Mongodb\ConnectMongoDB;
use Mongodb\CustomerProfilesRepository;

class Common {

    const ROUNDING = 1;
    # app service đã cài
    const APP_KEY_HARAVAN = 'HARAVAN';
    const APP_KEY_BIZWEB = 'BIZWEB';
    const APP_ALL = 'ALL';// cài cả 2
    const APP_EMPTY = 'EMPTY'; // nothing install service
    public static function numberFormat($number,$round=false, $rounding = Common::ROUNDING){

        $rounding = Common::ROUNDING;
        #$number = str_replace(',00', '', $number);
        if(!is_numeric($number)){
            return $number;
        }
        if(!$round){
            $number = number_format($number, 2, ',', '.');
            $number = str_replace(',00', '', $number);
            return $number;
        }

        $number = doubleval($number);

        $number = $number < $rounding ?
            $number : ceil($number / $rounding) * $rounding;
        if (intval($number) >= 1000) {
            $number = number_format($number, 2, ',', '.');
            $number = str_replace(',00', '', $number);
        }

        return $number;
    }

    /**
     * hàm format số tiền
     * @param $money
     * @return mixed
     */
    public static function moneyToFloat($money) {
        $money_exploded = explode(",", $money);
        $money_float = $money_exploded[0];
        $money_float = str_replace(".", "", $money_float);
        return $money_float;
    }

    /**
     * truyền vào một mảng,
     * hàm xử lý tags của sản phẩm
     * @param $inputTags
     * @param bool $is_trim
     * @return array
     */
    public static function analysisTag($inputTags, $is_trim = true){
        $arrTagTmp = [];
        if(is_array($inputTags)){
            if(!$is_trim){return $arrTagTmp;}
            foreach($inputTags as $tag){
                $arrTagTmp[] = trim($tag);
            }
        }else{
            $arrTag = explode(',',$inputTags);
            if($is_trim){
                foreach($arrTag as $item) {
                    $arrTagTmp[] = trim($item);
                }
            }
        }
        return $arrTagTmp;
    }

    /**
     * function check user use what service ?
     * @return string
     */
    public static function executeGetIntegrationOfUser()
    {
        $key_biz = strtolower(self::APP_KEY_BIZWEB);
        $key_haravan = strtolower(self::APP_KEY_HARAVAN);
        $customerId = CustomerAuth::getInstance()->getCustomer()->getId();
        $customer_repo = new CustomerProfilesRepository(ConnectMongoDB::getConnection());
        $customerObj = $customer_repo->createQuery(['customerId' => $customerId])->one();
        /** @var  \Mongodb\CustomerProfiles $customerObj */
        $integrations = $customerObj->getIntegration();
        $value_haravan = array_key_exists ( $key_haravan , $integrations );
        $value_biz = array_key_exists ( $key_biz , $integrations );
        if($value_biz && $value_haravan){
            return self::APP_ALL;
        }
        if($value_haravan && !$value_biz){
            return self::APP_KEY_HARAVAN;
        }
        if($value_biz && !$value_haravan){
            return self::APP_KEY_BIZWEB;
        }
        if(!$value_biz && !$value_haravan){
            return self::APP_EMPTY;
        }
        return self::APP_EMPTY;
    }


}