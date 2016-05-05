<?php
/**
 * Class xử lý các vấn đề liên quan đến sản phẩm gốc như lưu thông tin sản phẩm từ các công cụ lấy sản phẩm khác nhau
 * xóa, clone v.v....
 *
 * User: luuhieu
 * Date: 12/9/15
 * Time: 23:50
 */

namespace Core\Items;


use Mongodb\ConnectMongoDB;

class OriginalItem
{
    public static function addItems($items) {
        //check items is existed ?
        $originItem = \Mongodb\OriginalItem::retrieveByOriginId($items['id'], $items['home_land']);
        if (!$originItem) {
            $originItem = new \Mongodb\OriginalItem(ConnectMongoDB::getConnection());
        }

        //save original items
        $originItem->saveFromSource($items);
        return $originItem;
    }
}