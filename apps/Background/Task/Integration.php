<?php
/**
 * Created by PhpStorm.
 * User: luuhieu
 * Date: 12/24/15
 * Time: 11:57
 */

namespace Background\Task;


use Background\Library\IntegrationHelper;
use Core\Event\ItemsEvent;
use BizWeb\BizWebClient;
use BizWeb\BizWebService;
use Core\CustomerAuth;
use Core\GlobalEventDispatcher;
use Core\IntergrationApp\Factory;
use Core\Logger;
use Flywheel\Queue\Queue;
use Haravan\HaravanClient;
use Haravan\HaravanService;
use Mongodb\ConnectMongoDB;
use Mongodb\ItemsRepository;
use SeuDo\Common\RedisCache;

class Integration extends BackgroundBase
{
    const APP_KEY_BIZWEB = 'BIZWEB';
    const APP_KEY_HARAVAN = 'HARAVAN';
    public function executeSyncItemsToAll() {
        $queue = Queue::factory('integration_synchronized');
        $this->doQueue($queue, 10, function($item_id) {
            $logger = Logger::factory('synchronized');
            $repo = new ItemsRepository(ConnectMongoDB::getConnection());
            /** @var \MongoDb\Items $item */
            $item = $repo->findOneById($item_id);
            if (!$item) {
                $logger->error('item not found with id:' .$item_id);
                return;
            }else{
                IntegrationHelper::SycToAllService($item);
                // cần có cơ chế log lại hợp lý
            }
        });
    }

    /**
     * sys item to Bizweb service
     * @throws \Flywheel\Queue\Exception
     */
    public function executeSysItemsToBizWeb(){
        $queue = Queue::factory('integration_synchronized_bizweb');
        $this->doQueue($queue, 10, function($item_id) {
            $logger = Logger::factory('synchronized');
            $repo = new ItemsRepository(ConnectMongoDB::getConnection());
            /** @var \MongoDb\Items $item */
            $item = $repo->findOneById($item_id);
            if (!$item) {
                $logger->error('item not found with id:' .$item_id);
                return;
            }else{

                $client = BizWebService::createClient($item->getCustomerId());
                $server = new BizWebService($client);
                $server->syncItem($item);
                // đoạn này cần chủ động log lại xem là do haravan hay do bizweb đồng bộ lên trên web dịch vụ
                GlobalEventDispatcher::getInstance()->dispatch('afterBackgroundSysItem', new ItemsEvent(null, [
                    'item' => $item,
                    'app_key' => self::APP_KEY_BIZWEB
                ]));
            }
        }, function(){
            return (BizWebClient::$countCallRequest > 100) || ($this->processed > 100);
        });
    }

    /**
     * sys to haravan service
     * @throws \Flywheel\Queue\Exception
     */
    public function executeSysItemToHaravan(){
        $queue = Queue::factory('integration_synchronized_harvan');
        $this->doQueue($queue, 10, function($item_id) {
            $logger = Logger::factory('synchronized');
            $repo = new ItemsRepository(ConnectMongoDB::getConnection());
            /** @var \MongoDb\Items $item */
            $item = $repo->findOneById($item_id);
            if (!$item) {
                $logger->error('item not found with id:' .$item_id);
                return;
            }else{

                $client = HaravanService::createClient($item->getCustomerId());
                $server = new HaravanService($client);
                $server->syncItem($item);
                // đoạn này cần chủ động log lại xem là do haravan hay do bizweb đồng bộ lên trên web dịch vụ
                GlobalEventDispatcher::getInstance()->dispatch('afterBackgroundSysItem', new ItemsEvent(null, [
                    'item' => $item,
                    'app_key' => self::APP_KEY_HARAVAN
                ]));
            }
        }, function(){
            return (HaravanClient::$countCallRequest > 100) || ($this->processed > 100);
        });
    }

}