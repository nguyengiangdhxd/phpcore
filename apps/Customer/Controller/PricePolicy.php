<?php
/**
 * Created by PhpStorm.
 * User: luuhieu
 * Date: 12/24/15
 * Time: 12:12
 */

namespace Customer\Controller;


use Core\Items\SalePriceFileAnalyser;
use Core\Queue;
use Flywheel\Filesystem\Uploader;
use Flywheel\Util\Folder;
use Mongodb\ConnectMongoDB;
use Mongodb\ItemsSalePriceFile;

class PricePolicy extends CustomerBase
{
    public function executeDefault()
    {
        $this->view()->assign('price_policy', $this->createUrl('/price_policy/upload_items_price'));
        return $this->executeUploadItemsPrice();
    }

    public function executeUploadItemsPrice() {
        $this->setView('PricePolicy/upload');

        return $this->renderComponent();
    }

    /**
     * Parsing excel upload files
     *
     * @author LuuHieu
     * @return string
     */
    public function executeParsingFile() {
        $ajax = new \AjaxResponse();
        $customer = $this->customerLogin();

        $file_id = $this->post('file_id');
        if (!$file_id) {
            $ajax->type = \AjaxResponse::ERROR;
            $ajax->message = 'File không tìm thấy';
            return $this->renderText($ajax->toString());
        }

        $fileOm = ItemsSalePriceFile::retrieveById($file_id);
        if (!$fileOm) {
            $ajax->type = \AjaxResponse::ERROR;
            $ajax->message = 'File không tìm thấy';
            return $this->renderText($ajax->toString());
        }

        //check owner
        if ($fileOm->getCustomerId() != $customer->getId()) {
            $ajax->type = \AjaxResponse::ERROR;
            $ajax->message = 'File không thuộc sở hữu của bạn';
            return $this->renderText($ajax->toString());
        }

        $parser = new SalePriceFileAnalyser($fileOm->getFilePath());
        $result = $parser->parse();
        $rows = $result->getRows();

        $bulkItemUpdateQueue = Queue::factory('bulk_item_update');
        $bulkVariantUpdateQueue = Queue::factory('item_price_policy');

        $queued_item_id = [];

        foreach($rows as $row) {
            $file_data = $row->getFileData();
            if ($file_data['item_id']) {
                $bulk_item_queue_data = [
                    'uploader' => $this->customerLogin()->getId(),
                    'file_id' => $file_id,
                    'item_id' => $file_data['item_id'],
                    'item_title' => $file_data['item_title'],
                    'item_tags' => $file_data['item_tags']
                ];
                //File có thể có nhiều lần suất hiện sản phẩm
                if (!isset($queued_item_id[$file_data['item_id']])) {
                    $bulkItemUpdateQueue->push(json_encode($bulk_item_queue_data));
                    $queued_item_id[$file_data['item_id']] = $bulk_item_queue_data;
                }

                $bulk_variant_queue_data = [
                    'uploader' => $this->customerLogin()->getId(),
                    'file_id' => $file_id,
                    'item_id' => $file_data['item_id'],
                    'variant_id' => $file_data['variant_id'],
                    'variant_sku' => $file_data['variant_sku'],
                    'variant_sale_price' => $file_data['variant_sale_price']
                ];

                $bulkVariantUpdateQueue->push(json_encode($bulk_variant_queue_data));
            }
        }

        $ajax->type = \AjaxResponse::SUCCESS;
        $ajax->total_item = count($queued_item_id);
        $ajax->total_rows = $result->totalRows;

        return $this->renderText($ajax->toString());
    }

    /**
     * Action handle upload file
     *
     * @author LuuHieu
     * @return string
     */
    public function executeUpload() {
        //upload files
        $res = new \AjaxResponse();
        $error = [];
        $upload_max_file_size = str_replace('M', '', ini_get('upload_max_filesize'));
        $upload_path = RUNTIME_PATH .'/sale_prices_file/' .$this->customerLogin()->getUsername() .'/';
        //Upload file to server
        Folder::create($upload_path);
        $fileUploader = new Uploader($upload_path, 'files');
        $fileUploader->setMaximumFileSize($upload_max_file_size);
        $fileUploader->setFilterType('.xls, .xlsx');
        $fileUploader->setIsEncryptFileName(true);

        if ($fileUploader->upload()) {
            $upload_result = $fileUploader->getData();
            foreach ($upload_result as $ur) {
                $fileStorage = new ItemsSalePriceFile(ConnectMongoDB::getConnection());
                $fileStorage->setCustomerId($this->customerLogin()->getId());
                $fileStorage->setFilePath($this->customerLogin()->getUsername() .'/' .$ur['file_name']);
                $fileStorage->setUploadTime(new \DateTime());
                $fileStorage->setRawFileName($ur['file_origin_name']);
                $fileStorage->save();
                $inserted_id = $fileStorage->getId()->{'$id'};
                if ($inserted_id) {
                    $res->type = \AjaxResponse::SUCCESS;
                    $res->source_file[] = $ur['file_origin_name'];
                    $res->id[] = $inserted_id;
                }
            }

            return $this->renderText($res->toString());
        } else {
            $error['upload'] = $fileUploader->getError();
        }

        $res->type = \AjaxResponse::ERROR;
        $res->error = $error;

        return $this->renderText($res->toString());
    }
}