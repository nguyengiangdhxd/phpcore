<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 1/5/2016
 * Time: 9:42 AM
 */

namespace BizWeb;

/**
 * Class ItemVariantIntegrationData
 * @package BizWeb
 * @method void setVariantId($value) set id value
 * @method string getVariantId() get id value
 * @method void setStatus(string $value) set status value
 * @method string getStatus() get status value
 * @method void setLastSync(\MongoDate $value)
 * @method integer getLastSync()
 * @method void setLastSuccessSync(\MongoDate $value) set id value
 * @method integer getLastSuccessSync() get id value
 */
class ItemVariantIntegrationData extends BaseObject {
    public function __construct($data = null) {
        if (!empty($data)) {
            $this->fromArray($data);
        }
    }
}