<?php
/**
 * Created by PhpStorm.
 * User: luuhieu
 * Date: 12/9/15
 * Time: 23:44
 */

namespace Customer\Controller;


use Core\Logger;

class OriginalItem extends CustomerBase
{
    public function executeDefault()
    {
        // TODO: Implement executeDefault() method.
        //nothing
    }

    /**
     * action đón thông tin sản phẩm từ công cụ lấy sản phẩm
     */
    public function executeAdd()
    {
        $logger = Logger::factory('tools', Logger::DEBUG);
        //đón thông tin sản phẩm gửi lên
        $source_data = $this->request()->post('itemInfo', 'ARRAY', []);

        //log debug lại thông tin gửi lên
        $logger->debug('receive items data from tools', $source_data);

        //validate thông tin sản phẩm
        $originalItem = \Core\Items\OriginalItem::addItems($source_data); // lưu vào nguồn
        $logger->debug('original item', $originalItem->toArray());

        $items = \Core\Items\Items::cloneFromOriginalItem($originalItem, $this->customerLogin()); // lưu giá trị từ itemOrigin vào trong item
        $logger->debug('item', $items->toArray());

        //ghi log ra file nếu có lỗi
        if(isset($source_data["error"]) && sizeof($source_data["error"])){
            Logger::factory("has-error-when-get-product-info")->addDebug(json_encode($source_data["error"]));
        }

        //LuuHieu: need better information
        $ajax = new \AjaxResponse();
        $ajax->type = \AjaxResponse::SUCCESS;
        $ajax->message = 'Ok, last inserted id: ' .$items->getId()->{'$id'};

        return $this->renderText($ajax->toString());
    }
}