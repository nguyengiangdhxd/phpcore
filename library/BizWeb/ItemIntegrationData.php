<?php
/**
 * Created by PhpStorm.
 * User: Piggat
 * Date: 12/29/15
 * Time: 4:33 PM
 */

namespace BizWeb;

/**
 * Class ItemIntegrationData
 * @package BizWeb
 * @method void setProductId($value) set id value
 * @method string getProductId() get id value
 * @method void setStatus(string $value) set status value
 * @method string getStatus() get status value
 * @method void setLastSync(\MongoDate $value)
 * @method integer getLastSync()
 * @method void setLastSuccessSync(\MongoDate $value) set id value
 * @method integer getLastSuccessSync() get id value
 * @method void setImageKey() set mảng giá trị key value của image
 * @method array getImageKey() get mảng giá trị key value của image trả về
 */
class ItemIntegrationData extends BaseObject {
    public function __construct($data = null) {
        if (!empty($data)) {
            $this->fromArray($data);
        }
    }
} 