<?php
/**
 * Created by PhpStorm.
 * User: luuhieu
 * Date: 2/24/16
 * Time: 11:55
 */

namespace Core\Items;


use Comment\ItemsActivityLogger\ItemsLog;

class EventHandler
{
    public static function updateItemEventHandling($event) {

    }

    public static function updateVariantEventHandling($event) {}

    /**
     * hàm xử lý log đồng bộ dữ liệu
     * @param $event : đây là data mà gửi liệu gửi
     */
    public static function getItemFromSourceEventHandling($event){
        $param = $event->params;
        $item = isset($param["data_item"]) ? $param["data_item"] : array();
        $customer_id = isset($param["customer_id"]) ? $param["customer_id"] : array();
        ItemsLog::logItemSysFromSource($item, $customer_id);
    }

    public static function SyncItemsEventHandling($event){
        $param = $event->params;
        $item = isset($param['item']) ? $param['item'] : array();
        /** @var \Mongodb\Items $item */
        $customer_id = $item->getCustomerId();
        $app_key = isset($param['app_key']) ? $param['app_key'] : array();
        ItemsLog::logItemSys($item, $customer_id,$app_key );
    }
}