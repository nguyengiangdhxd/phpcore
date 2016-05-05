<?php
/**
 * Created by PhpStorm.
 * User: luuhieu
 * Date: 12/25/15
 * Time: 14:39
 */

namespace Core\Items;


use Flywheel\Util\Inflection;
use Mongodb\Items;
use Mongodb\ItemVariant;

/**
 * Class SalePriceFileParseResult
 * Lưu thông tin phân tích từ file excel
 *
 *
 * @package Core\Items
 * @author LuuHieu
 */
class SalePriceFileParsedRowResult
{
    protected $_failures = [];
    protected $_fileData = [];

    /** @var string  Product's title */
    protected $_title;

    protected $_variantSku;

    protected $_salePrice;

    /** @var  Items */
    protected $_item;

    /** @var  \Mongodb\ItemVariant */
    protected $_itemVariant;

    /**
     * @return array
     */
    public function getFailures() {
        return $this->_failures;
    }

    /**
     * Get Items found in excel's row
     *
     * @return Items
     */
    public function getItem() {
        if (!$this->_item && $this->_fileData['item_id']) {
            try {
                $this->_item = Items::retrieveById($this->_fileData['item_id']);
            } catch(\MongoException $mge) {
                //nothing
            }

        }
        return $this->_item;
    }

    /**
     * @return ItemVariant|null
     */
    public function getItemVariant()
    {
        if (!$this->_itemVariant && $this->_fileData['variant_id']) {
            try {
                $this->_itemVariant = ItemVariant::retrieveById($this->_fileData['variant_id']);
            } catch(\MongoException $mge) {
                //nothing
            }

        }
        return $this->_itemVariant;
    }

    /**
     * Add new failures
     *
     * @param $message
     * @param $col_id
     */
    public function addFailure($message, $col_id)
    {
        $this->_failures[$col_id][] = $message;
    }

    /**
     * Check row is valid
     *
     * @return bool
     */
    public function isValid() {
        return empty($this->_failures);
    }

    /**
     * Get data parsed
     *
     * @return array
     */
    public function getFileData() {
        return $this->_fileData;
    }

    /**
     * Validate
     *
     * @return bool
     */
    public function validate()
    {
        //check item exists;
        $item = $this->getItem();
        if (!$item) {
            $this->addFailure('Sản phẩm không tồn tại', 'item_id');
        }

        $itemVariant = $this->getItemVariant();
        if (!$this->getItemVariant()) {
            $this->addFailure('Biến thể sản phẩm không tồn tại với id:' .$this->_fileData['variant_id'], 'variant_id');
        }

        //check relation
        if ($this->isValid()) {
            if ($item->getId()->{'$id'} != $itemVariant->getItemId()) {
                $this->addFailure('Biến thể sản phẩm không thuộc sản phẩm này', 'variant_id');
            }
        }

        //check valid sale price
        if ($this->_fileData['variant_sale_price'] && !is_numeric($this->_fileData['variant_sale_price'])) {
            $this->addFailure('Giá bán không hợp lệ', 'variant_sale_price');
        }

        return $this->isValid();
    }

    /**
     * Set variant sale price from data
     *
     * @param $price
     */
    public function setFileDataVariantSalePrice($price) {
        $price = floatval(str_replace(',', '', $price));
        $this->_fileData['variant_sale_price'] = $price;
    }

    public function __call($method, $params) {
        if (strpos($method, 'setFileData') === 0) { //set file data
            $key = Inflection::camelCaseToHungary(str_replace('setFileData', '', $method));
            $this->_fileData[$key] = $params[0];
        }
    }
}