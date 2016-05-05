<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2/15/2016
 * Time: 8:47 AM
 */

namespace Background\Library;


use Mongodb\ConnectMongoDB;

class TranslateItemHelper {

    /**
     * hàm dùng để lấy các variant theo id của itemProduct
     * @param \Mongodb\Items $item
     * @return array
     */
    public static function getItemsVariant($item){
        $mandango = ConnectMongoDB::getConnection();
        $conditional = [];
        $conditional['itemId'] = $item->getId()->{'$id'};
        $itemVariantRepo = new \Mongodb\ItemVariantRepository($mandango);
        $list_item_variant = $itemVariantRepo->createQuery()
            ->criteria($conditional)
            ->all();
        return $list_item_variant;
    }
}