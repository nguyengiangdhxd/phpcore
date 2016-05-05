<?php
/**
 * Created by PhpStorm.
 * User: hoan
 * Date: 10/21/2015
 * Time: 4:17 PM
 */

namespace Haravan;
use Flywheel\Exception;

/**
 * Class ProductMetafield
 * @package Haravan
 * @method void setId(integer $id) set id value
 * @method integer getId() get id value
 * @method void setKey(integer $key) set key value
 * @method integer getKey() get key value
 * @method void setProductId(integer $value)
 * @method integer getProductId()
 * @method void setDescription(string $value)
 * @method string getDescription()
 * @method void setValue(string $value)
 * @method string getValue()
 * @method void setValueType(string $value)
 * @method string getValueType()
 * @method void setNamespace(string $value)
 * @method string getNamespace()
 */

class ProductMetafield extends BaseObject{

    public function save() {
        try {
            $remoteId = $this->getId();
            $productId = $this->getProductId();

            if (!$productId) {
                throw new Exception("Haravan metafield need product id to save or update");
            }

//            $this->setAbcDef(123);
//            $this->_data['abc_def'] = 123;

            $validFields = ['key', 'value', 'value_type','description', 'namespace'];

            $params = $this->generateParams($validFields);

            if (array_key_exists('id', $params) && !$params['id']) {
                unset($params['id']);
            }

            if (empty($remoteId)) {
                $result = $this->_client->call('POST', "/admin/products/$productId/metafields.json", ['metafield' => $params ]);
            }
            else {
                try {
                    $result = $this->_client->call('PUT',  "/admin/products/$productId/metafields/$remoteId.json", ['metafield' => $params ]);
                }
                catch (HaravanApiException $ex) {
                    $result = $this->_client->call('POST',  "/admin/products/$productId/metafields.json", ['metafield' => $params ]);
                }
            }
            $this->_data = $result;

            return $this->getId();
        }
        catch (\Exception $e) {
            return -1;
        }
    }
}