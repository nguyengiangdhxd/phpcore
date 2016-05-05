<?php

namespace Mongodb;

/**
 * Mongodb\OriginalItem document.
 */
class OriginalItem extends \Mongodb\Base\OriginalItem
{
    /**
     * Source to fields setting
     *
     * @var array
     */
    protected static $_files_mapping = [
        'id'                => 'originalId',
        'home_land'         => 'homeLand',
        'original_title'    => 'title',
        'images'            => 'images',
        'item_location'     => 'itemLocation',
        'has_discount'      => 'hasDiscount',
        'specifications'    => 'specifications',
        'original_link'     => 'originalLink',
        'quantity_steps'    => 'quantitySteps',
        'options'           => 'options',
        'seller_id'         => 'sellerId',
        'seller_home_url'   => 'sellerHomeUrl',
        'seller_name'       => 'sellerName',
        'seller_image'      => 'sellerImage',
        'seller_policy'     => 'sellerPolicy',
        'seller_require_min'=> 'sellerRequireMin',
        'body_images'       => 'bodyImages'
    ];

    /**
     * Retrieve By Origin Id
     *
     * @author LuuHieu
     * @param $oid
     * @param $homeland
     * @return OriginalItem|null
     */
    public static function retrieveByOriginId($oid, $homeland)
    {
        $repo = new OriginalItemRepository(ConnectMongoDB::getConnection());
        $om = $repo->createQuery([
            'originalId' => $oid,
            'homeLand' => $homeland
        ])->one();
        return $om;
    }

    /**
     * Save original item from source
     *
     * @param array $items
     * @return \Mongodb\OriginalItem
     */
    public function saveFromSource($items) {
        foreach($items as $key => $value) {
            if (isset(self::$_files_mapping[$key])) {
                $setter = 'set' .ucfirst(self::$_files_mapping[$key]);
                $this->{$setter}($value);
            }
        }

        if ($this->isNew()) {
            $this->setCreatedTime(new \DateTime());
        }

        $this->setModifiedTime(new \DateTime());
        $this->save();
        $this->saveVariants($items);
    }

    /**
     * Save item's variants from source
     *
     * @param $items
     */
    public function saveVariants($items) {
        $variants = $items['variants'];
        $current = [];
        if (!$this->isNew()) {
            /** @var OriginalItemVariant[] $t */
            $t = $this->getVariants();
            foreach($t as $currentVariant) {
                $current[$currentVariant->getUid()] = $currentVariant;
            }
        }

        for($j = 0, $size = sizeof($variants); $j < $size; ++$j) {
            if (!isset($current[$variants[$j]['id']])) {
                $om = new OriginalItemVariant(ConnectMongoDB::getConnection());
            } else {
                $om = $current[$variants[$j]['id']];
            }
            $om->setUid($variants[$j]['id']); // nếu ko có giá trị thì lưu lại giá trị rỗng
            #region --lưu lại trươngf đánh dấu xem sản phẩm có option hay ko có--
            $om->setHasOption($items['has_option']); // 1 là có , 0 là ko có
            #endregion
            $om->setOriginItemId($items['id']);
            $om->setInventoryQuantity(@$variants[$j]['inventory_quantity']);
            $om->setPricesTable(@$variants[$j]['prices_table']);
            $om->setPrice(@$variants[$j]['price']);
            $om->setOptKeys(@$variants[$j]['opt_key']);
            $om->setImage(@$variants[$j]['image']);
            // lưu lại giá trị của sale_price vào trong salePrice cuar original Items , lưu từ nguồn
            $om->setSalePrice(@$variants[$j]['sale_price']);
            if ($om->isNew()) {
                $om->setCreatedTime(new \DateTime());
            }
            $om->setModifiedTime(new \DateTime());
            $om->setOriginId($this->getId()->{'$id'});
            $om->save();
        }
    }

    /**
     * @return OriginalItemVariant[]
     */
    public function getVariants() {
        $repo = new OriginalItemVariantRepository(ConnectMongoDB::getConnection());
        $oms = $repo->createQuery([
            'originId' => $this->getId()->{'$id'}
        ])->all();
        return (array) $oms;
    }
}