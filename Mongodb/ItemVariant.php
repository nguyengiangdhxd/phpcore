<?php

namespace Mongodb;

/**
 * Mongodb\ItemVariant document.
 */
class ItemVariant extends \Mongodb\Base\ItemVariant
{
    const SYNC_STATUS_SUCCESS = 'SUCCESS',
        SYNC_STATUS_FAILED = 'FAILED';
    /**
     * retrieve om by id
     *
     * @param $variant_id
     * @return ItemVariant|null
     */
    public static function retrieveById($variant_id)
    {
        $repo = new ItemVariantRepository(ConnectMongoDB::getConnection());
        return $repo->findOneById($variant_id);
    }

    /**
     * @param $app_key
     * @param $value
     * @author kiennx
     */
    public function setIntegration($app_key, $value){
        $intergration = $this->getIntegrationItemVariants();
        $intergration[$app_key] = $value;
        $this->setIntegrationItemVariants($intergration);
    }

    /**
     * @param $app_key
     * @return array|mixed
     * @author kiennx
     */
    public function getIntegration($app_key){
        $intergration = $this->getIntegrationItemVariants();
        if (isset($intergration[$app_key])) {
            return $intergration[$app_key];
        }
        return [];
    }
}