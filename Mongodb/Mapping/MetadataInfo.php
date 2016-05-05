<?php

namespace Mongodb\Mapping;

class MetadataInfo
{
    public function getMongodbTranslatorKeywordClass()
    {
        return array(
            'isEmbedded' => false,
            'mandango' => null,
            'connection' => '',
            'collection' => 'keyword_search',
            'inheritable' => false,
            'inheritance' => false,
            'fields' => array(
                'keyword_china' => array(
                    'type' => 'string',
                    'dbName' => 'keyword_china',
                ),
                'keyword_vi' => array(
                    'type' => 'string',
                    'dbName' => 'keyword_vi',
                ),
                'keyword_vi_sms' => array(
                    'type' => 'string',
                    'dbName' => 'keyword_vi_sms',
                ),
                'full_text_search' => array(
                    'type' => 'string',
                    'dbName' => 'full_text_search',
                ),
                'weighted' => array(
                    'type' => 'integer',
                    'dbName' => 'weighted',
                ),
                'is_translated' => array(
                    'type' => 'integer',
                    'dbName' => 'is_translated',
                ),
            ),
            '_has_references' => false,
            'referencesOne' => array(

            ),
            'referencesMany' => array(

            ),
            'embeddedsOne' => array(

            ),
            'embeddedsMany' => array(

            ),
            'relationsOne' => array(

            ),
            'relationsManyOne' => array(

            ),
            'relationsManyMany' => array(

            ),
            'relationsManyThrough' => array(

            ),
            'indexes' => array(

            ),
            '_indexes' => array(

            ),
        );
    }

    public function getMongodbTranslatorTitleKeywordClass()
    {
        return array(
            'isEmbedded' => false,
            'mandango' => null,
            'connection' => '',
            'collection' => 'title_translate',
            'inheritable' => false,
            'inheritance' => false,
            'fields' => array(
                'keyword_china' => array(
                    'type' => 'string',
                    'dbName' => 'keyword_china',
                ),
                'keyword_vi' => array(
                    'type' => 'string',
                    'dbName' => 'keyword_vi',
                ),
                'keyword_vi_sms' => array(
                    'type' => 'string',
                    'dbName' => 'keyword_vi_sms',
                ),
                'full_text_search' => array(
                    'type' => 'string',
                    'dbName' => 'full_text_search',
                ),
                'weighted' => array(
                    'type' => 'integer',
                    'dbName' => 'weighted',
                ),
                'is_translated' => array(
                    'type' => 'integer',
                    'dbName' => 'is_translated',
                ),
                'tags' => array(
                    'type' => 'string',
                    'dbName' => 'tags',
                ),
                'vi_position' => array(
                    'type' => 'integer',
                    'dbName' => 'vi_position',
                ),
            ),
            '_has_references' => false,
            'referencesOne' => array(

            ),
            'referencesMany' => array(

            ),
            'embeddedsOne' => array(

            ),
            'embeddedsMany' => array(

            ),
            'relationsOne' => array(

            ),
            'relationsManyOne' => array(

            ),
            'relationsManyMany' => array(

            ),
            'relationsManyThrough' => array(

            ),
            'indexes' => array(

            ),
            '_indexes' => array(

            ),
        );
    }

    public function getMongodbUserProfilesClass()
    {
        return array(
            'isEmbedded' => false,
            'mandango' => null,
            'connection' => '',
            'collection' => 'user_profiles',
            'inheritable' => false,
            'inheritance' => false,
            'fields' => array(
                'userId' => array(
                    'type' => 'integer',
                    'dbName' => 'userId',
                ),
                'username' => array(
                    'type' => 'string',
                    'dbName' => 'username',
                ),
                'lastPass' => array(
                    'type' => 'raw',
                    'dbName' => 'lastPass',
                ),
            ),
            '_has_references' => false,
            'referencesOne' => array(

            ),
            'referencesMany' => array(

            ),
            'embeddedsOne' => array(

            ),
            'embeddedsMany' => array(

            ),
            'relationsOne' => array(

            ),
            'relationsManyOne' => array(

            ),
            'relationsManyMany' => array(

            ),
            'relationsManyThrough' => array(

            ),
            'indexes' => array(

            ),
            '_indexes' => array(

            ),
        );
    }

    public function getMongodbCustomerProfilesClass()
    {
        return array(
            'isEmbedded' => false,
            'mandango' => null,
            'connection' => '',
            'collection' => 'customer_profiles',
            'inheritable' => false,
            'inheritance' => false,
            'fields' => array(
                'customerId' => array(
                    'type' => 'integer',
                    'dbName' => 'customerId',
                ),
                'customerUsername' => array(
                    'type' => 'string',
                    'dbName' => 'customerUsername',
                ),
                'lastPass' => array(
                    'type' => 'raw',
                    'dbName' => 'lastPass',
                ),
                'integration' => array(
                    'type' => 'raw',
                    'dbName' => 'integration',
                ),
            ),
            '_has_references' => false,
            'referencesOne' => array(

            ),
            'referencesMany' => array(

            ),
            'embeddedsOne' => array(

            ),
            'embeddedsMany' => array(

            ),
            'relationsOne' => array(

            ),
            'relationsManyOne' => array(

            ),
            'relationsManyMany' => array(

            ),
            'relationsManyThrough' => array(

            ),
            'indexes' => array(

            ),
            '_indexes' => array(

            ),
        );
    }

    public function getMongodbItemsSalePriceFileClass()
    {
        return array(
            'isEmbedded' => false,
            'mandango' => null,
            'connection' => '',
            'collection' => 'items_sale_price_file',
            'inheritable' => false,
            'inheritance' => false,
            'fields' => array(
                'customerId' => array(
                    'type' => 'integer',
                    'dbName' => 'customerId',
                ),
                'filePath' => array(
                    'type' => 'string',
                    'dbName' => 'filePath',
                ),
                'rawFileName' => array(
                    'type' => 'string',
                    'dbName' => 'rawFileName',
                ),
                'uploadTime' => array(
                    'type' => 'date',
                    'dbName' => 'uploadTime',
                ),
            ),
            '_has_references' => false,
            'referencesOne' => array(

            ),
            'referencesMany' => array(

            ),
            'embeddedsOne' => array(

            ),
            'embeddedsMany' => array(

            ),
            'relationsOne' => array(

            ),
            'relationsManyOne' => array(

            ),
            'relationsManyMany' => array(

            ),
            'relationsManyThrough' => array(

            ),
            'indexes' => array(

            ),
            '_indexes' => array(

            ),
        );
    }

    public function getMongodbOriginalItemClass()
    {
        return array(
            'isEmbedded' => false,
            'mandango' => null,
            'connection' => '',
            'collection' => 'original_item',
            'inheritable' => false,
            'inheritance' => false,
            'fields' => array(
                'originalId' => array(
                    'type' => 'string',
                    'dbName' => 'originalId',
                ),
                'homeLand' => array(
                    'type' => 'string',
                    'dbName' => 'homeLand',
                ),
                'title' => array(
                    'type' => 'string',
                    'dbName' => 'title',
                ),
                'images' => array(
                    'type' => 'raw',
                    'dbName' => 'images',
                ),
                'specifications' => array(
                    'type' => 'raw',
                    'dbName' => 'specifications',
                ),
                'itemLocation' => array(
                    'type' => 'string',
                    'dbName' => 'itemLocation',
                ),
                'options' => array(
                    'type' => 'raw',
                    'dbName' => 'options',
                ),
                'pricesTable' => array(
                    'type' => 'raw',
                    'dbName' => 'pricesTable',
                ),
                'quantitySteps' => array(
                    'type' => 'integer',
                    'dbName' => 'quantitySteps',
                ),
                'bodyImages' => array(
                    'type' => 'raw',
                    'dbName' => 'bodyImages',
                ),
                'hasDiscount' => array(
                    'type' => 'boolean',
                    'dbName' => 'hasDiscount',
                ),
                'sellerName' => array(
                    'type' => 'string',
                    'dbName' => 'sellerName',
                ),
                'sellerId' => array(
                    'type' => 'string',
                    'dbName' => 'sellerId',
                ),
                'sellerHomeUrl' => array(
                    'type' => 'string',
                    'dbName' => 'sellerHomeUrl',
                ),
                'sellerImage' => array(
                    'type' => 'string',
                    'dbName' => 'sellerImage',
                ),
                'sellerPolicy' => array(
                    'type' => 'string',
                    'dbName' => 'sellerPolicy',
                ),
                'sellerRequireMin' => array(
                    'type' => 'integer',
                    'dbName' => 'sellerRequireMin',
                ),
                'originalLink' => array(
                    'type' => 'string',
                    'dbName' => 'originalLink',
                ),
                'checksum' => array(
                    'type' => 'string',
                    'dbName' => 'checksum',
                ),
                'createdTime' => array(
                    'type' => 'date',
                    'dbName' => 'createdTime',
                ),
                'modifiedTime' => array(
                    'type' => 'date',
                    'dbName' => 'modifiedTime',
                ),
            ),
            '_has_references' => false,
            'referencesOne' => array(

            ),
            'referencesMany' => array(

            ),
            'embeddedsOne' => array(

            ),
            'embeddedsMany' => array(

            ),
            'relationsOne' => array(

            ),
            'relationsManyOne' => array(

            ),
            'relationsManyMany' => array(

            ),
            'relationsManyThrough' => array(

            ),
            'indexes' => array(

            ),
            '_indexes' => array(

            ),
        );
    }

    public function getMongodbOriginalItemVariantClass()
    {
        return array(
            'isEmbedded' => false,
            'mandango' => null,
            'connection' => '',
            'collection' => 'original_item_variant',
            'inheritable' => false,
            'inheritance' => false,
            'fields' => array(
                'uid' => array(
                    'type' => 'string',
                    'dbName' => 'uid',
                ),
                'originItemId' => array(
                    'type' => 'string',
                    'dbName' => 'originItemId',
                ),
                'originId' => array(
                    'type' => 'string',
                    'dbName' => 'originId',
                ),
                'inventoryQuantity' => array(
                    'type' => 'integer',
                    'dbName' => 'inventoryQuantity',
                ),
                'salePrice' => array(
                    'type' => 'float',
                    'dbName' => 'salePrice',
                ),
                'hasOption' => array(
                    'type' => 'string',
                    'dbName' => 'hasOption',
                ),
                'price' => array(
                    'type' => 'float',
                    'dbName' => 'price',
                ),
                'pricesTable' => array(
                    'type' => 'raw',
                    'dbName' => 'pricesTable',
                ),
                'optKeys' => array(
                    'type' => 'raw',
                    'dbName' => 'optKeys',
                ),
                'image' => array(
                    'type' => 'string',
                    'dbName' => 'image',
                ),
                'checksum' => array(
                    'type' => 'string',
                    'dbName' => 'checksum',
                ),
                'createdTime' => array(
                    'type' => 'date',
                    'dbName' => 'createdTime',
                ),
                'modifiedTime' => array(
                    'type' => 'date',
                    'dbName' => 'modifiedTime',
                ),
            ),
            '_has_references' => false,
            'referencesOne' => array(

            ),
            'referencesMany' => array(

            ),
            'embeddedsOne' => array(

            ),
            'embeddedsMany' => array(

            ),
            'relationsOne' => array(

            ),
            'relationsManyOne' => array(

            ),
            'relationsManyMany' => array(

            ),
            'relationsManyThrough' => array(

            ),
            'indexes' => array(

            ),
            '_indexes' => array(

            ),
        );
    }

    public function getMongodbItemsClass()
    {
        return array(
            'isEmbedded' => false,
            'mandango' => null,
            'connection' => '',
            'collection' => 'items',
            'inheritable' => false,
            'inheritance' => false,
            'fields' => array(
                'customerId' => array(
                    'type' => 'integer',
                    'dbName' => 'customerId',
                ),
                'uid' => array(
                    'type' => 'string',
                    'dbName' => 'uid',
                ),
                'originItemId' => array(
                    'type' => 'string',
                    'dbName' => 'originItemId',
                ),
                'originId' => array(
                    'type' => 'string',
                    'dbName' => 'originId',
                ),
                'titleOrigin' => array(
                    'type' => 'string',
                    'dbName' => 'titleOrigin',
                ),
                'syncProcess' => array(
                    'type' => 'boolean',
                    'dbName' => 'syncProcess',
                ),
                'homeLand' => array(
                    'type' => 'string',
                    'dbName' => 'homeLand',
                ),
                'title' => array(
                    'type' => 'string',
                    'dbName' => 'title',
                ),
                'images' => array(
                    'type' => 'raw',
                    'dbName' => 'images',
                ),
                'imagesResponse' => array(
                    'type' => 'raw',
                    'dbName' => 'imagesResponse',
                ),
                'specifications' => array(
                    'type' => 'raw',
                    'dbName' => 'specifications',
                ),
                'itemLocation' => array(
                    'type' => 'string',
                    'dbName' => 'itemLocation',
                ),
                'options' => array(
                    'type' => 'raw',
                    'dbName' => 'options',
                ),
                'minOriginPrice' => array(
                    'type' => 'float',
                    'dbName' => 'minOriginPrice',
                ),
                'maxOriginPrice' => array(
                    'type' => 'float',
                    'dbName' => 'maxOriginPrice',
                ),
                'pricesTable' => array(
                    'type' => 'raw',
                    'dbName' => 'pricesTable',
                ),
                'quantitySteps' => array(
                    'type' => 'integer',
                    'dbName' => 'quantitySteps',
                ),
                'bodyImages' => array(
                    'type' => 'raw',
                    'dbName' => 'bodyImages',
                ),
                'hasDiscount' => array(
                    'type' => 'boolean',
                    'dbName' => 'hasDiscount',
                ),
                'sellerName' => array(
                    'type' => 'string',
                    'dbName' => 'sellerName',
                ),
                'sellerId' => array(
                    'type' => 'string',
                    'dbName' => 'sellerId',
                ),
                'sellerHomeUrl' => array(
                    'type' => 'string',
                    'dbName' => 'sellerHomeUrl',
                ),
                'sellerImage' => array(
                    'type' => 'string',
                    'dbName' => 'sellerImage',
                ),
                'sellerPolicy' => array(
                    'type' => 'string',
                    'dbName' => 'sellerPolicy',
                ),
                'sellerRequireMin' => array(
                    'type' => 'integer',
                    'dbName' => 'sellerRequireMin',
                ),
                'originalLink' => array(
                    'type' => 'string',
                    'dbName' => 'originalLink',
                ),
                'checksum' => array(
                    'type' => 'string',
                    'dbName' => 'checksum',
                ),
                'integrationItems' => array(
                    'type' => 'raw',
                    'dbName' => 'integrationItems',
                ),
                'lastUpdateFromSource' => array(
                    'type' => 'date',
                    'dbName' => 'lastUpdateFromSource',
                ),
                'createdTime' => array(
                    'type' => 'date',
                    'dbName' => 'createdTime',
                ),
                'modifiedTime' => array(
                    'type' => 'date',
                    'dbName' => 'modifiedTime',
                ),
                'isActive' => array(
                    'type' => 'string',
                    'dbName' => 'isActive',
                ),
                'isDeleted' => array(
                    'type' => 'boolean',
                    'dbName' => 'isDeleted',
                ),
                'minPriceSale' => array(
                    'type' => 'float',
                    'dbName' => 'minPriceSale',
                ),
                'maxPriceSale' => array(
                    'type' => 'float',
                    'dbName' => 'maxPriceSale',
                ),
                'onlyUpdatePrice' => array(
                    'type' => 'boolean',
                    'dbName' => 'onlyUpdatePrice',
                ),
                'tags' => array(
                    'type' => 'string',
                    'dbName' => 'tags',
                ),
                'tagsProduct' => array(
                    'type' => 'raw',
                    'dbName' => 'tagsProduct',
                ),
                'isAutoTranslate' => array(
                    'type' => 'boolean',
                    'dbName' => 'isAutoTranslate',
                ),
                'maxOriginalSalePrice' => array(
                    'type' => 'float',
                    'dbName' => 'maxOriginalSalePrice',
                ),
                'minOriginalSalePrice' => array(
                    'type' => 'float',
                    'dbName' => 'minOriginalSalePrice',
                ),
                'isAutoTranslateOption' => array(
                    'type' => 'boolean',
                    'dbName' => 'isAutoTranslateOption',
                ),
            ),
            '_has_references' => false,
            'referencesOne' => array(

            ),
            'referencesMany' => array(

            ),
            'embeddedsOne' => array(

            ),
            'embeddedsMany' => array(

            ),
            'relationsOne' => array(

            ),
            'relationsManyOne' => array(

            ),
            'relationsManyMany' => array(

            ),
            'relationsManyThrough' => array(

            ),
            'indexes' => array(

            ),
            '_indexes' => array(

            ),
        );
    }

    public function getMongodbItemVariantClass()
    {
        return array(
            'isEmbedded' => false,
            'mandango' => null,
            'connection' => '',
            'collection' => 'item_variants',
            'inheritable' => false,
            'inheritance' => false,
            'fields' => array(
                'originalVariantsId' => array(
                    'type' => 'string',
                    'dbName' => 'originalVariantsId',
                ),
                'itemId' => array(
                    'type' => 'string',
                    'dbName' => 'itemId',
                ),
                'uid' => array(
                    'type' => 'string',
                    'dbName' => 'uid',
                ),
                'sku' => array(
                    'type' => 'string',
                    'dbName' => 'sku',
                ),
                'inventoryQuantity' => array(
                    'type' => 'integer',
                    'dbName' => 'inventoryQuantity',
                ),
                'salePrice' => array(
                    'type' => 'float',
                    'dbName' => 'salePrice',
                ),
                'originalSalePrice' => array(
                    'type' => 'float',
                    'dbName' => 'originalSalePrice',
                ),
                'price' => array(
                    'type' => 'float',
                    'dbName' => 'price',
                ),
                'pricesTable' => array(
                    'type' => 'raw',
                    'dbName' => 'pricesTable',
                ),
                'optKeys' => array(
                    'type' => 'raw',
                    'dbName' => 'optKeys',
                ),
                'image' => array(
                    'type' => 'string',
                    'dbName' => 'image',
                ),
                'checksum' => array(
                    'type' => 'string',
                    'dbName' => 'checksum',
                ),
                'integrationItemVariants' => array(
                    'type' => 'raw',
                    'dbName' => 'integrationItemVariants',
                ),
                'lastUpdateFromSource' => array(
                    'type' => 'date',
                    'dbName' => 'lastUpdateFromSource',
                ),
                'createdTime' => array(
                    'type' => 'date',
                    'dbName' => 'createdTime',
                ),
                'modifiedTime' => array(
                    'type' => 'date',
                    'dbName' => 'modifiedTime',
                ),
            ),
            '_has_references' => false,
            'referencesOne' => array(

            ),
            'referencesMany' => array(

            ),
            'embeddedsOne' => array(

            ),
            'embeddedsMany' => array(

            ),
            'relationsOne' => array(

            ),
            'relationsManyOne' => array(

            ),
            'relationsManyMany' => array(

            ),
            'relationsManyThrough' => array(

            ),
            'indexes' => array(

            ),
            '_indexes' => array(

            ),
        );
    }

    public function getMongodbPFUploadLogClass()
    {
        return array(
            'isEmbedded' => false,
            'mandango' => null,
            'connection' => '',
            'collection' => 'pf_upload_log',
            'inheritable' => false,
            'inheritance' => false,
            'fields' => array(
                'uploader' => array(
                    'type' => 'integer',
                    'dbName' => 'uploader',
                ),
                'message' => array(
                    'type' => 'string',
                    'dbName' => 'message',
                ),
                'type' => array(
                    'type' => 'string',
                    'dbName' => 'type',
                ),
                'objectId' => array(
                    'type' => 'string',
                    'dbName' => 'objectId',
                ),
                'logDate' => array(
                    'type' => 'date',
                    'dbName' => 'logDate',
                ),
            ),
            '_has_references' => false,
            'referencesOne' => array(

            ),
            'referencesMany' => array(

            ),
            'embeddedsOne' => array(

            ),
            'embeddedsMany' => array(

            ),
            'relationsOne' => array(

            ),
            'relationsManyOne' => array(

            ),
            'relationsManyMany' => array(

            ),
            'relationsManyThrough' => array(

            ),
            'indexes' => array(

            ),
            '_indexes' => array(

            ),
        );
    }

    public function getMongodbItemsCommentClass()
    {
        return array(
            'isEmbedded' => false,
            'mandango' => null,
            'connection' => '',
            'collection' => 'items_comment',
            'inheritable' => false,
            'inheritance' => false,
            'fields' => array(
                'contextType' => array(
                    'type' => 'string',
                    'dbName' => 'contextType',
                ),
                'createdTime' => array(
                    'type' => 'date',
                    'dbName' => 'createdTime',
                ),
                'context' => array(
                    'type' => 'raw',
                    'dbName' => 'context',
                ),
                'idItems' => array(
                    'type' => 'string',
                    'dbName' => 'idItems',
                ),
                'createdBy' => array(
                    'type' => 'string',
                    'dbName' => 'createdBy',
                ),
                'scope' => array(
                    'type' => 'string',
                    'dbName' => 'scope',
                ),
                'isPublicProfile' => array(
                    'type' => 'boolean',
                    'dbName' => 'isPublicProfile',
                ),
                'itemId_reference_field' => array(
                    'type' => 'raw',
                    'dbName' => 'itemId',
                    'referenceField' => true,
                ),
            ),
            '_has_references' => true,
            'referencesOne' => array(
                'itemId' => array(
                    'class' => 'Mongodb\\Items',
                    'field' => 'itemId_reference_field',
                ),
            ),
            'referencesMany' => array(

            ),
            'embeddedsOne' => array(

            ),
            'embeddedsMany' => array(

            ),
            'relationsOne' => array(

            ),
            'relationsManyOne' => array(

            ),
            'relationsManyMany' => array(

            ),
            'relationsManyThrough' => array(

            ),
            'indexes' => array(

            ),
            '_indexes' => array(

            ),
        );
    }
}