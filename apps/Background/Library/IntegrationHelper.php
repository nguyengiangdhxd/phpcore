<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 4/13/2016
 * Time: 11:04 AM
 */

namespace Background\Library;

use BizWeb\BizWebService;
use Core\CustomerAuth;
use Core\Event\ItemsEvent;
use Core\GlobalEventDispatcher;
use Haravan\HaravanClient;
use Haravan\HaravanService;
use Mongodb\ConnectMongoDB;
use Mongodb\CustomerProfilesRepository;

class IntegrationHelper
{
    const APP_KEY_BIZWEB = 'BIZWEB';
    const APP_KEY_HARAVAN = 'HARAVAN';
    /**
     * hàm đồng bộ khi click đồng bộ đồng thời cả 2 trạng thái
     * @param \MongoDb\Items $item
     * @throws \Exception
     */
    public static function SycToAllService($item)
    {

        ## syc item to bizweb service
        $clientBiz = BizWebService::createClient($item->getCustomerId());
        $serverBiz = new BizWebService($clientBiz);
        $serverBiz->syncItem($item);
        GlobalEventDispatcher::getInstance()->dispatch('afterBackgroundSysItem', new ItemsEvent(null, [
            'item' => $item,
            'app_key' => self::APP_KEY_BIZWEB
        ]));
        ## syc item to haravan service
        $clientHrv = HaravanService::createClient($item->getCustomerId());
        $serviceHrv = new HaravanService($clientHrv);
        $serviceHrv->syncItem($item);
        GlobalEventDispatcher::getInstance()->dispatch('afterBackgroundSysItem', new ItemsEvent(null, [
            'item' => $item,
            'app_key' => self::APP_KEY_HARAVAN
        ]));
    }
}