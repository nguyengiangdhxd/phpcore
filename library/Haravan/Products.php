<?php
/**
 * Created by PhpStorm.
 * User: Piggat
 * Date: 7/27/15
 * Time: 4:37 PM
 */

namespace Haravan;
use BizWeb\ItemIntegrationData;
use Core\Logger;
use Flywheel\Util\Inflection;

/**
 * @method void setId(integer $id) set id value
 * @method integer getId() get id value
 * @method void setBodyHtml(\string $bodyHtml)
 * @method \string getBodyHtml()
 * @method void setCreatedAt(\string $value)
 * @method \string getCreatedAt()
 * @method void setHandle(\string $value)
 * @method \string getHandle()
 * @method void setImages(array $value)
 * @method array getImages()
 * @method void setOptions(\string $value)
 * @method \string getOptions()
 * @method void setProductType(\string $value)
 * @method \string getProductType()
 * @method void setPublished(\bool $value)
 * @method \bool getPublished()
 * @method void setPublishedAt(\string $value)
 * @method \string getPublishedAt()
 * @method void setPublishedScope(\string $value)
 * @method \string getPublishedScope()
 * @method void setTags(\string $value)
 * @method \string getTags()
 * @method void setTemplateSuffix(\string $value)
 * @method \string getTemplateSuffix()
 * @method void setTitle(\string $value)
 * @method \string getTitle()
 * @method void setUpdatedAt(\string $value)
 * @method \string getUpdatedAt()
 * @method void setVariants(array $value)
 * @method array getVariants()
 * @method void setVendor(\string $value)
 * @method \string getVendor()
 * @method void setMetafields(array $value)
 * @method \string getMetafields()
 */
class Products extends BaseObject {
    public function addImageUrl($url, $variant_ids = 0) {
        $images = $this->getImages();
        if (!is_array($images)) {
            $images = [];
        }

        foreach ($images as $image) {
            if ($image['src'] == $url) {
                // đã có hình ảnh, thêm vào variants
                if ($variant_ids > 0) {
                    $image['variant_ids'] [] = $variant_ids;
                }
                return;
            }
        }

        if ($variant_ids > 0) {
            $variant_ids_array = [ $variant_ids ];
        }
        else {
            $variant_ids_array = [];
        }

        $images[] = ['src' => $url, 'variant_ids' => $variant_ids_array];
        $this->setImages($images);
    }


    /**
     * Lưu sản phẩm lên Haravan
     * Các chú ý: images không thay đổi id qua các lần đồng bộ nếu cùng src
     * @return \Mongodb\
     * @author Kiennx
     */
    public function save() {
        try {
            $remoteId = $this->getId();
            $validFields = ['id', 'images', 'title', 'body_html', 'published',
                'vendor', 'options', 'variants', 'product_type', 'metafields'];

          /*  $repo = \mongodb\HaravanProductRepository::getInstance();
            $product = $repo->getByHaravanId($remoteId);*/

           /* if (!$product) {
                $this->setPublished(false); // chỉ unpublish khi thêm mới
            }*/

            $params = $this->generateParams($validFields);

            if (empty($remoteId)) {
                $result = $this->_client->call('POST', '/admin/products.json', ['product' => $params ]);
            }
            else {
                try {
                    $result = $this->_client->call('PUT',  "/admin/products/$remoteId.json", ['product' => $params ]);
                }
                catch (HaravanApiException $ex) {
                    $result = $this->_client->call('POST',  "/admin/products.json", ['product' => $params ]);
                }
            }

            if (!array_key_exists('id',$result) || $result['id'] <= 0)
            {
                return false;
            }

            $this->_data = $result;
            if($result && isset($result)){

            }
            #return $this->saveHaravanIDE($product); // sửa lại : lưu giá trị vào trong IDE
            return true;
        }
        catch (\Exception $ex) {
            return -1;
        }
    }

    /**
     * trường hợp này là trường hợp lưu lại lỗi nếu lưu lại ko thành công
     * @param \mongodb\Items $productHRV
     * @return bool
     */
    public function saveHaravanIDE($productHRV){
        $integrationData = $productHRV->getIntegration(HaravanService::HARAVAN_KEY);
        $integrationData = new ItemIntegrationData($integrationData);
        $integrationData->setStatus(\Mongodb\Items::SYNC_STATUS_SUCCESS); // nếu gửi lỗi thì lưu trạng thái là fail
        $integrationData->setLastSync(new \MongoDate((new \DateTime())->getTimestamp()));
        //TODO: lưu lý do lỗi vấn đề này đã được xử lý bằng cách gửi mail đến quản trị
        $productHRV->setIntegration(HaravanService::HARAVAN_KEY, $integrationData->toArray());
        //có lỗi trả về, vẫn set sync process về false nhưng có thông báo lỗi
        $productHRV->setSyncProcess(false);
        if($productHRV->save()){
            return true;
        }else{
            return false;
        }
    }

} 