<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2/24/2016
 * Time: 1:46 PM
 */

namespace Excel;


use Core\CustomerAuth;
use Mongodb\ConnectMongoDB;

class ItemHelper {
    /**
     * hàm lấy ra giá min của variant trên web trên tất cả các website
     * @param \Mongodb\ItemVariant $itemVariant
     * @return mixed|string
     */
    public static function getMinPriceTable($itemVariant){
        $prices_table = $itemVariant->getPricesTable();
        if (!empty($prices_table) && isset($prices_table['CNY'])) {
            //process for prices table
            $tables_price = [];
            for ($j = 0, $sop = sizeof($prices_table['CNY']); $j < $sop; ++$j) {
                $tables_price[] = $prices_table['CNY'][$j]['price'];
            }
            $min_price_table = min($tables_price);
        }else{
            $min_price_table = $itemVariant->getPrice() ? $itemVariant->getPrice() : '';

        }
        return $min_price_table;
    }

    /**
     * hàm lấy giá trị max của price_table trên variant
     * @param \Mongodb\ItemVariant $itemVariant
     * @return mixed
     */
    public static function getMaxPriceTable($itemVariant){
        $prices_table = $itemVariant->getPricesTable();
        if (!empty($prices_table) && isset($prices_table['CNY'])) {
            //process for prices table
            $tables_price = [];
            for ($j = 0, $sop = sizeof($prices_table['CNY']); $j < $sop; ++$j) {
                $tables_price[] = $prices_table['CNY'][$j]['price'];
            }
            $min_price_table = max($tables_price);
        }else{
            $min_price_table = '';
        }
        return $min_price_table;
    }

    /**
     * lấy các itemvariant theo items
     * @param \Mongodb\Items $item
     * @return array
     */
    public static function executeGetItemsVariant($item){
        $mandango = ConnectMongoDB::getConnection();
        $conditional = [];
        $conditional['itemId'] = $item->getId()->{'$id'};
        $itemVariantRepo = new \Mongodb\ItemVariantRepository($mandango);
        $list_item_variant = $itemVariantRepo->createQuery()
            ->criteria($conditional)
            ->sort(['createdTime' => -1])
            ->all()
        ;

        return $list_item_variant;
    }

    /**
     * lấy item theo các điều kiện tìm kiếm
     * @param array $conditional
     * @param $limit
     * @return array
     */
    public static function executeGetItems(  $conditional = [] , $limit){
        $mandango = ConnectMongoDB::getConnection();
        $customerId = CustomerAuth::getInstance()->getCustomer()->getId();
        $conditional['customerId'] = $customerId;
        $itemRepo = new \Mongodb\ItemsRepository($mandango);
        $list_items_product = $itemRepo ->createQuery()
            ->criteria($conditional)
            ->sort(['createdTime' => -1])
            ->limit($limit)
            ->all()
        ;
        return $list_items_product;
    }

}