<?php
/**
 * Created by PhpStorm.
 * User: Piggat
 * Date: 10/15/15
 * Time: 11:31 AM
 */

namespace Haravan;
use Flywheel\Exception;
use Mongodb\ConnectMongoDB;
use Mongodb\ItemsRepository;

/**
 * Class ProductImage
 * @package Haravan
 * @method void setId(integer $id) set id value
 * @method integer getId() get id value
 * @method void setProductId(integer $value)
 * @method integer getProductId()
 * @method void setVariantIds(array $value)
 * @method array getVariantIds()
 * @method void setSrc(string $value)
 * @method string getSrc()
 */
class ProductImage extends BaseObject {

    /**
     * hàm gửi lên giá trị của product image
     * @return int
     * @throws Exception
     */
    public function save() {
        try {
            $remoteId = $this->getId();
            $productId = $this->getProductId();

            if (!$productId) {
                throw new Exception("Haravan image need product id to save or update");
            }

            $validFields = ['id', 'src', 'variant_ids'];

            $params = $this->generateParams($validFields);

            if (array_key_exists('id', $params) && !$params['id']) {
                unset($params['id']);
            }

            if (empty($remoteId)) {
                $result = $this->_client->call('POST', "/admin/products/$productId/Images.json", ['image' => $params ]);
            }
            else {
                try {
                    $result = $this->_client->call('PUT',  "/admin/products/$productId/Images/$remoteId.json", ['image' => $params ]);
                }
                catch (HaravanApiException $ex) {
                    $result = $this->_client->call('POST',  "/admin/products/$productId/Images.json", ['image' => $params ]);
                }
            }
            $this->_data = $result;

            return $this->getId();
        }
        catch (\Exception $ex) {
            return -1;
        }
    }

    /**
     * chỉ gửi được khi có productid khi đã được đồng bộ thành công
     * @param \Mongodb\Items $item
     * @throws Exception
     */
    public function sendProductImage($item){
        $repoItem = new ItemsRepository(ConnectMongoDB::getConnection());
        $itemProduct = $repoItem->findOneById($item->getId()->{'$id'});
        /** @var \Mongodb\Items $itemProduct */
        $itemIntegrations = $itemProduct->getIntegrationItems();
        foreach($itemIntegrations as $key => $value){
            if($key == HaravanService::HARAVAN_KEY){
                $product_id = $value['product_id'];
            }
        }
        if(!isset($product_id)){
            throw new Exception("Haravan image need product id to save or update");
        }
        $validFields = ['id', 'src', 'variant_ids'];

        $params = $this->generateParams($validFields);
        try{
            $result = $this->_client->call('POST', "/admin/products/$product_id/Images.json", ['image' => $params ]);
            $this->_data = $result;

        }catch (Exception $e){

        }



    }
} 