<?php

namespace Mongodb;

/**
 * Mongodb\OriginalItemVariant document.
 */
class OriginalItemVariant extends \Mongodb\Base\OriginalItemVariant
{
    /**
     * hàm xóa biến thể variant khi sản phẩm được cập nhật từ nguồn
     * đã bổ sung thêm variant
     * @param \Mongodb\OriginalItemVariant $origin_variant
     */
    public static function deleteVariantHasNotOption($origin_variant){
        $origin_variant->delete();
    }

}