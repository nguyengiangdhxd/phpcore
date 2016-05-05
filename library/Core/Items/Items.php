<?php
/**
 * Created by PhpStorm.
 * User: luuhieu
 * Date: 12/23/15
 * Time: 15:11
 */

namespace Core\Items;


use Core\Event\ItemsEvent;
use Core\GlobalEventDispatcher;
use Mongodb\ConnectMongoDB;

class Items
{
    /**
     * $author LuuHieu
     * @param \Mongodb\OriginalItem $originalItem
     * @param \Customer $customer
     * @return \Mongodb\Items|void
     */
    public static function cloneFromOriginalItem(\Mongodb\OriginalItem $originalItem, \Customer $customer)
    {
        //check items exists
        $items = \Mongodb\Items::retrieveByOriginalIdAndCustomerId($originalItem->getOriginalId(),
            $customer->getId(),
            $originalItem->getHomeLand());
        if (!$items) {
            $items = new \Mongodb\Items(ConnectMongoDB::getConnection());
            $items->setCustomerId($customer->getId());
            if(!$items->getIsActive()){ // nếu ko có giá trị thì set vào
                $items->setIsActive(\Mongodb\Items::IN_ACTIVE);
            }

           // khi crawl dữ iệu từ nguồn mặc định là inactive
        }else{
            if($items->getIsDeleted() == true){
                $items->setIsDeleted(false);
            }
        }

        $items->cloneFromOriginalItem($originalItem);
        // lấy ra mã id người đồng bộ
        $modified_fields = $items->getFieldsModified();
        #ItemsLog::logItemSys($items, $customerId); // chuyển từ log code sang bắt event
        GlobalEventDispatcher::getInstance()->dispatch('afterGetItemFromSource', new ItemsEvent(null, [
            'data_item' => $items,
            'customer_id' => $customer->getId(),
            'modified_fields' => $modified_fields
        ]));
        return $items;
    }
}