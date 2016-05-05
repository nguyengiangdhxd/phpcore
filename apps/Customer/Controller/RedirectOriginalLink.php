<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2/1/2016
 * Time: 11:22 AM
 */

namespace Customer\Controller;

use Mongodb\ConnectMongoDB;
use Mongodb\ItemsRepository;

class RedirectOriginalLink extends CustomerBase {
    const BIZ_WEB = 'BIZWEB';
    const HARAVAN = 'HARAVAN';

    public function executeDefault()
    {
        $mandango = ConnectMongoDB::getConnection();

        $id = $this->get('id'); // id của sản phẩm trên bizweb
        $store = $this->get('store'); // store của người dùng
        $app_key = $this->get('app_key'); // app key có thể là bizweb hoặc haravan
       # $app_key = strtolower($app_key);
        $conditional = [];
        $conditional['integration'] = ['$exists' => true];
        if($app_key == self::BIZ_WEB || $app_key == self::HARAVAN){
            $conditional['integration.'.strtolower($app_key).'.store'] = $store;
        }
        $customerRepo = new \Mongodb\CustomerProfilesRepository($mandango);
        $customerProfile = $customerRepo->createQuery()
                            ->criteria($conditional)->one();
        /** @var \Mongodb\CustomerProfiles $customerProfile*/
        if(!$customerProfile){
            $this->raise404();
            return;
        }
        $customer_id = $customerProfile->getCustomerId();
        if($id){
            // lấy giá trị của item
            $conditionalItem = [];
            $conditionalItem['integrationItemVariants'] = ['$exists' => true];
            $conditionalItem['integrationItemVariants.'.$app_key.'.variant_id'] = $id;

            $itemVariantRepo = new \Mongodb\ItemVariantRepository($mandango);
            $item_variant = $itemVariantRepo->createQuery()
                ->criteria($conditionalItem)
                ->one();
            if($item_variant){
                /** @var \Mongodb\ItemVariant $item_variant */
                $itemId = $item_variant->getItemId();
                $repoItem = new ItemsRepository(ConnectMongoDB::getConnection());
                $itemProduct = $repoItem->findOneById($itemId);
                /** @var \Mongodb\Items $itemProduct */
                $originalLink = $itemProduct->getOriginalLink();
                $this->redirect($originalLink); // chuyển trang sang link gốc
            }else{
                $conditionProduct = [];
                $conditionProduct['integrationItems'] = ['$exists' => true];
                $conditionProduct['integrationItems.'.$app_key.'.product_id'] = $id;
                $conditionProduct['customerId'] = $customer_id;

                $itemRepo = new ItemsRepository($mandango);
                $items = $itemRepo->createQuery()
                    ->criteria($conditionProduct)
                    ->one();
                if($items){
                    /** @var \Mongodb\Items $items */
                    $linkOriginal = $items->getOriginalLink();
                    $this->redirect($linkOriginal);// chuyển trang sang chuaw link gốc
                }else{
                    $this->raise404();
                }
            }
        }
    }
}