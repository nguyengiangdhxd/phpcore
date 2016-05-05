<?php

namespace Mongodb\Mapping;

class Metadata extends \Mandango\MetadataFactory
{
    protected $classes = array(
        'Mongodb\\TranslatorKeyword' => false,
        'Mongodb\\TranslatorTitleKeyword' => false,
        'Mongodb\\UserProfiles' => false,
        'Mongodb\\CustomerProfiles' => false,
        'Mongodb\\ItemsSalePriceFile' => false,
        'Mongodb\\OriginalItem' => false,
        'Mongodb\\OriginalItemVariant' => false,
        'Mongodb\\Items' => false,
        'Mongodb\\ItemVariant' => false,
        'Mongodb\\PFUploadLog' => false,
        'Mongodb\\ItemsComment' => false,
    );
}