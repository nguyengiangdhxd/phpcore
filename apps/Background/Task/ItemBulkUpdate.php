<?php
/**
 * Created by PhpStorm.
 * User: luuhieu
 * Date: 2/19/16
 * Time: 16:47
 */

namespace Background\Task;

use Background\Event\ItemsEvent;
use Core\GlobalEventDispatcher;
use Core\Queue;
use Mongodb\Items;
use Mongodb\ItemsSalePriceFile;
use Mongodb\ItemVariant;
use Mongodb\PFUploadLog;

class ItemBulkUpdate extends BackgroundBase
{
    /**
     * Task upload bulk items
     *
     * @throws \Flywheel\Queue\Exception
     */
    public function executeItems() {
        $queue = Queue::factory('bulk_item_update');
        $this->doQueue($queue, 10, function($item_data) {
            $item_data = json_decode($item_data, true);
            if (!is_array($item_data)) {
                return; // should log more detail here
            }

            if (isset($item_data['file_id'])) {
                $uploadedFile = ItemsSalePriceFile::retrieveById($item_data['file_id']);
            }

            //validate items
            $items = Items::retrieveById($item_data['item_id']);
            if (!$items) {
                PFUploadLog::error("Không tìm thấy sản phẩm với id {$item_data['item_id']}", $item_data['item_id'], $item_data['uploader']);
                return;
            }

            if($items->getCustomerId() != @$item_data['uploader']) {
                PFUploadLog::error("Sản phẩm không thuộc sở hữu của bạn", $item_data['item_id'], $item_data['uploader']);
                return;
            }

            if (isset($item_data['item_title'])) {
                $items->setTitle($item_data['item_title']);
            }
            if (isset($item_data['item_tags'])) {
                $items->setTagsFromString($item_data['item_tags']);
            }

            $modified_fields = $items->getFieldsModified();

            if (count($items->getFieldsModified()) > 0) {
                $items->save();
                $log_mess = "Lưu sản phẩm {$item_data['item_id']} với";
                if (isset($item_data['item_title'])) {
                    $log_mess .= "tiêu đề: {$item_data['item_title']}";
                }
                if(isset($item_data['item_tags'])) {
                    $log_mess .= " tags: {$item_data['item_tags']}";
                }
                if (isset($uploadedFile) && $uploadedFile instanceof ItemsSalePriceFile) {
                    $log_mess .= " từ file " .$uploadedFile->getRawFileName();
                }
                //log
                PFUploadLog::success($log_mess, $item_data['item_id'], $item_data['uploader']);
                GlobalEventDispatcher::getInstance()->dispatch('afterBackgroundUpdateItem', new ItemsEvent(null, [
                    'item_id' => $items->getId()->{'$id'},
                    'data' => $item_data,
                    'modified_fields' => $modified_fields
                ]));
            }
        }, function() {
            return $this->processed > 100;
        });
    }

    public function executeVariants()
    {
        $queue = Queue::factory('item_price_policy');
        $this->doQueue($queue, 10, function($variant_data) {
            $variant_data = json_decode($variant_data, true);
            if(!is_array($variant_data)) {
                return;
            }
            $itemVariant = ItemVariant::retrieveById($variant_data['variant_id']);
            if (!$itemVariant) {
                PFUploadLog::error('Không tìm thấy phiên bản sản phẩm với id:' .$variant_data['variant_id'],
                    $variant_data['variant_id'], $variant_data['uploader']);
                return;
            }
            if($itemVariant->getItemId() != $variant_data['item_id']) {
                PFUploadLog::warning("Phiên bản sản phẩm có id: {$variant_data['variant_id']} không thuộc sản phẩm id {$variant_data['item_id_id']}",
                    $variant_data['variant_id'], $variant_data['uploader']);
            }
            $items = Items::retrieveById($itemVariant->getItemId());
            if (!$items) {
                PFUploadLog::error("Sản phẩm của phiên bản {$variant_data['variant_id']} không tồn tại",
                    $variant_data['variant_id'], $variant_data['uploader']);
                return;
            }

            //check items owner
            if ($items->getCustomerId() != $variant_data['uploader']) {
                PFUploadLog::error("Biến thể sản phẩm không thuộc sở hữu của bạn",
                    $variant_data['variant_id'], $variant_data['uploader']);
                return;
            }

            if (isset($variant_data['variant_sku'])) {
                $itemVariant->setSku($variant_data['variant_sku']);
            }

            if(isset($variant_data['variant_sale_price'])) {
                $itemVariant->setSalePrice($variant_data['variant_sale_price']);
            }

            $modified_columns = $itemVariant->getFieldsModified();

            if (count($modified_columns) > 0) {
                $itemVariant->save();
                $items->loadVariants();
                $items->analysisSalePriceFromVariants();
                $log_mess = "Lưu biến thể sản phẩm {$variant_data['variant_id']} với ";
                if (isset($variant_data['variant_sku'])) {
                    $log_mess .= " SKU {$variant_data['variant_sku']}";
                }
                if (isset($variant_data['variant_sale_price'])) {
                    $log_mess .= " giá bán {$variant_data['variant_sale_price']}";
                }

                PFUploadLog::success($log_mess, $variant_data['variant_id'], $variant_data['uploader']);
                GlobalEventDispatcher::getInstance()->dispatch('afterBackgroundUpdateVariant', new ItemsEvent(null, [
                    'variant_id' => $itemVariant->getId()->{'$id'},
                    'variant_data' => $variant_data,
                    'modified_fields' => $modified_columns
                ]));
            }

        }, function() {
            return $this->processed > 100;
        });
    }
}