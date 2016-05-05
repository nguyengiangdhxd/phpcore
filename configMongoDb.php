<?php
return [
    'Mongodb\TranslatorKeyword' => [
        'collection' => 'keyword_search',
        'fields' => [
            'keyword_china' => 'string',
            'keyword_vi'=>'string',
            'keyword_vi_sms' => 'string',
            'full_text_search' => 'string',
            'weighted' => 'integer',
            'is_translated' => 'integer',
        ],
    ],

    'Mongodb\TranslatorTitleKeyword' => [
        'collection' => 'title_translate',
        'fields' => [
            'keyword_china' => 'string',
            'keyword_vi'=>'string',
            'keyword_vi_sms' => 'string',
            'full_text_search' => 'string',
            'weighted' => 'integer',
            'is_translated' => 'integer',
            'tags' => 'string',
            'vi_position' => 'integer'
        ],
    ],

    'Mongodb\UserProfiles' => [
        'collection' => 'user_profiles',
        'fields' => [
            'userId' => 'integer',
            'username' => 'string',
            'lastPass' => 'raw',
        ],
    ],

    'Mongodb\CustomerProfiles' => [
        'collection' => 'customer_profiles',
        'fields' => [
            'customerId' => 'integer',
            'customerUsername' => 'string',
            'lastPass' => 'raw',
            'integration' => 'raw'
        ]
    ],

    'Mongodb\ItemsSalePriceFile' => [
        'collection' => 'items_sale_price_file',
        'fields' => [
            'customerId' => 'integer',
            'filePath' => 'string',
            'rawFileName' => 'string',
            'uploadTime' => 'date'
        ]
    ],

    'Mongodb\OriginalItem' => [
        'collection' => 'original_item',
        'fields' => [
            'originalId' => 'string',
            'homeLand' => 'string',
            'title' => 'string',
            'images' => 'raw',
            'specifications' => 'raw',
            'itemLocation' => 'string',
            'options' => 'raw',
            'pricesTable' => 'raw', //for 1688
            'quantitySteps' => 'integer', //for 1688
            'bodyImages' => 'raw',
            'hasDiscount' => 'boolean',
            'sellerName' => 'string',
            'sellerId' => 'string',
            'sellerHomeUrl' => 'string',
            'sellerImage' => 'string',
            'sellerPolicy' => 'string', //chính sách bán hàng của seller 1688
            'sellerRequireMin' => 'integer', //số lượng sản phẩm tối thiểu yêu cầu mỗi đơn hàng
            'originalLink' => 'string',
            'checksum' => 'string',
            'createdTime' => 'date',
            'modifiedTime' => 'date'
        ]
    ],

    'Mongodb\OriginalItemVariant' => [
        'collection' => 'original_item_variant',
        'fields' => [
            'uid' => 'string',
            'originItemId' => 'string',
            'originId' => 'string',
            'inventoryQuantity' => 'integer',
            'salePrice' => 'float', // lưu lại giá trị mà công cụ mới lấy về , giá khuyens mãi của các variant
            'hasOption' => 'string',// trường đánh dấu có option hay ko , nếu ko có thì xóa đi
            'price' => 'float',
            'pricesTable' => 'raw',
            'optKeys' => 'raw',
            'image' => 'string',
            'checksum' => 'string',
            'createdTime' => 'date',
            'modifiedTime' => 'date'
        ],
    ],

    'Mongodb\Items' => [
        'collection' => 'items',
        'fields' => [
            'customerId' => 'integer', // mã khách hàng
            'uid' => 'string',
            'originItemId' => 'string',
            'originId' => 'string',
            'titleOrigin' =>'string',
            'syncProcess' => 'boolean',
            'homeLand' => 'string',
            'title' => 'string',
            'images' => 'raw', // dữ liệu ảnh gốc
            'imagesResponse' => 'raw', // dữ liệu ảnh server trả vềs
            'specifications' => 'raw',
            'itemLocation' => 'string',
            'options' => 'raw',
            'minOriginPrice' => 'float',
            'maxOriginPrice' => 'float',
            'pricesTable' => 'raw', //for 1688
            'quantitySteps' => 'integer', //for 1688
            'bodyImages' => 'raw',
            'hasDiscount' => 'boolean',
            'sellerName' => 'string',
            'sellerId' => 'string',
            'sellerHomeUrl' => 'string',
            'sellerImage' => 'string',
            'sellerPolicy' => 'string', //chính sách bán hàng của seller 1688
            'sellerRequireMin' => 'integer', //số lượng sản phẩm tối thiểu yêu cầu mỗi đơn hàng
            'originalLink' => 'string',
            'checksum' => 'string',
            'integrationItems'=> 'raw', // id sản phẩm trả về từ web dịch vụ
            'lastUpdateFromSource' => 'date',
            'createdTime' => 'date',
            'modifiedTime' => 'date',
            'isActive'=>'string',
            'isDeleted' => 'boolean',
            'minPriceSale' => 'float', // dùng để lưu lại giá bán min của sản phẩm
            'maxPriceSale' => 'float' ,// dùng để lưu lại giá bán max của sản phẩm
            'onlyUpdatePrice' => 'boolean' ,// dùng để đánh dấu xem chỉ update giá hay ko
            'tags' =>'string' ,// chuoi các tags của sản phẩm
            'tagsProduct' => 'raw', // mảng lưu lại tại của sản phẩm thay thế các đối tượng trên
            'isAutoTranslate' => 'boolean', // check xem sản phẩm đó được dịch tự động hay được dịch bằng tay
            'maxOriginalSalePrice' => 'float' , // trường lưu lại giá lớn nhất của phiên bản sản phẩm
            'minOriginalSalePrice'=> 'float', // trường lưu lại giá trị nhỏ nhất của phiên bản sản phẩm
            'isAutoTranslateOption' => 'boolean' , // trường dánh dấu dịch tự dộng hay ko
        ],
    ],

    'Mongodb\ItemVariant' => [
        'collection' => 'item_variants',
        'fields' => [
            'originalVariantsId' => 'string',
            'itemId' => 'string',
            'uid' => 'string',
            'sku' => 'string',
            'inventoryQuantity' => 'integer',
            'salePrice' => 'float',
            #'original_sale_price' => 'float', //bổ sung  trường lưu lại giá trị của sale_price từ nguồn
            'originalSalePrice' => 'float', // bổ sung trường lưu lại giá trjij của sale price từ nguôn
            'price' => 'float',
            'pricesTable' => 'raw',
            'optKeys' => 'raw',
            'image' => 'string',
            'checksum' => 'string',
            'integrationItemVariants'=> 'raw', // id sản phẩm trả về từ web dịch vụ
            'lastUpdateFromSource' => 'date',
            'createdTime' => 'date',
            'modifiedTime' => 'date',
        ]
    ],

    'Mongodb\PFUploadLog' => [
        'collection' => 'pf_upload_log',
        'fields' => [
            'uploader' => 'integer',
            'message' => 'string',
            'type' => 'string',
            'objectId' => 'string',
            'logDate' => 'date'
        ],
    ],
    /**
     * bảng chứa nội dung comment hoặc log của sản phẩm
     */
    'Mongodb\ItemsComment' =>[
        'collection' => 'items_comment',
        'fields' =>[
            'contextType' => 'string', // type của log LOG , ACTIVITY
            'createdTime' => 'date', // thời gian tạo
            'context' => 'raw', // nội dung log , bao gồm các trường (act , actDesc , controller , type)
            'idItems' => 'string', // id của item tạo log
            'createdBy' => 'string', // tạo bởi ai
            'scope' => 'string' , // phạm vi nhìn được
            'isPublicProfile' => 'boolean' // chế độ pulic hay chỉ mình người đó nhìn thấy
        ],
        'referencesOne' => array(
            'itemId' => array('class' => 'Mongodb\Items'),
        ),
    ]
];