<?php
const AFTER_UPDATE_CUSTOMER_FEE_CONFIG = 'afterUpdateCustomerFeeConfig';
const AFTER_UPDATE_SYSTEM_FEE_CONFIG = 'afterUpdateSystemFeeConfig';
const AFTER_ADD_NEW_EXCHANGE = 'afterAddNewExchange';
const AFTER_UPDATE_EXCHANGE = 'afterUpdateExchange';

//
const LOGIN_SUCCESS_TO_CUSTOMER_CP = 'loginSuccessToCustomerCp';
const LOGIN_FAIL_TO_CUSTOMER_CP = 'loginFailToCustomerCp';
//registry
const CUSTOMER_CP_REGISTRY_SUCCESS = 'registryCustomerCpSuccess';
const CUSTOMER_CP_PROFILE_INFO_UPDATE_SUCCESS = 'updateProfileInfoSuccess';
//warehouse
const AFTER_WAREHOUSE_ADD_SUCCESS = 'afterWarehouseAddSuccess';
const AFTER_WAREHOUSE_UPDATE_SUCCESS = 'afterWarehouseUpdateSuccess';


//Background update
\Core\GlobalEventDispatcher::getInstance()
    ->getEventDispatcher()
    ->addListener('afterBackgroundUpdateItem', ['\Core\Items\EventHandler', 'updateItemEventHandling']);

\Core\GlobalEventDispatcher::getInstance()
    ->getEventDispatcher()
    ->addListener('afterBackgroundUpdateVariant', ['\Core\Items\EventHandler', 'updateVariantEventHandling']);

// bắt event sau khi đồng bộ thành công từ người dùng : chú ý đồng bộ cả bizweb và haravan
\Core\GlobalEventDispatcher::getInstance()
    ->getEventDispatcher()
    ->addListener('afterBackgroundSysItem',['\Core\Items\EventHandler', 'SyncItemsEventHandling']);
// bắt event khi đồng bộ sản phẩm từ nguồn ,
# cấu trúc bao gồm tên sự kiện bắt , đường dẫn đến tên class xử lý , và tên của phương thức xử lý event đó
\Core\GlobalEventDispatcher::getInstance()
    ->getEventDispatcher()
    ->addListener('afterGetItemFromSource',['\Core\Items\EventHandler', 'getItemFromSourceEventHandling']);
