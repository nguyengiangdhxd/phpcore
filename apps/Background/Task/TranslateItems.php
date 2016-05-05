<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2/1/2016
 * Time: 2:25 PM
 */

namespace Background\Task;



use Background\Library\TranslateItemHelper;
use Core\Translator;
use Flywheel\Queue\Queue;
use Core\Logger;
use Mongodb\ConnectMongoDB;
use Mongodb\Items;
use Mongodb\ItemsRepository;

class TranslateItems extends BackgroundBase{

   /* public function beforeExecute()
    {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 5000);
    }*/

    /**
     * tối ưu chạy queue của hàm dịch các variant tương ứng
     * @throws \Flywheel\Queue\Exception
     */
    public function executeTranslateItemVariants(){
        $queue = Queue::factory('translate_variants');
        $this->doQueue($queue, 100, function($item_id) {
            $logger = Logger::factory('translate');
            $repo = new ItemsRepository(ConnectMongoDB::getConnection());
            /** @var \MongoDb\Items $item */
            $item = $repo->findOneById($item_id);
            if (!$item) {
                $logger->error('item not found with id:' .$item_id);
                return;
            }else{
                $ItemVariants = TranslateItemHelper::getItemsVariant($item);
                $opts = [];
                foreach($ItemVariants as $variants){
                    /** @var \Mongodb\ItemVariant $variants */
                    $opt_keys = $variants->getOptKeys();
                    foreach($opt_keys as $key_option => $val_option){
                        $opts[$key_option] = [
                            'title'=> Translator::translateProperty($val_option['title']),
                            'value' => $val_option['value']
                        ];
                    }
                    $variants->setOptKeys($opts);
                    $variants->save();
                }
                #region --mảng chưa id của các variant tương ứng--
                $arr_id_variant = [];
                foreach($ItemVariants as $id_variant){
                    /** @var \Mongodb\ItemVariant $id_variant */
                    $arr_id_variant [] = $id_variant->getId()->{'$id'};
                }
                #endregion
                #region --log lại phần dịch của các variant của sản phẩm--
                $logger = Logger::factory('biz_web_translate_variant');
                $logger->addInfo('ID các variant của sản phẩm cần dịch', [ 'ID Variants' => implode(',',$arr_id_variant)]);
                #endregion
            }
        },10, function(){
            $time_end = microtime(true);
            $end_use_memory =  memory_get_usage(true);
            $memory = $end_use_memory/1048576;
            if($time_end > self::TIME_LIMIT || $memory > self::MEMORY_LIMIT){ // nếu lớn hơn 60s thì  break
                return true;
            }else {
                return false;
            }
        });
    }

    /**
     * tối ưu hàm dịch tiêu đề của sản phẩm
     * @throws \Flywheel\Queue\Exception
     */
    public function executeTranslateTitle(){
        $queue = Queue::factory('translate_title');
        $this->doQueue($queue, 100, function($item_id) {
            $logger = Logger::factory('translate');
            $repo = new ItemsRepository(ConnectMongoDB::getConnection());
            /** @var \MongoDb\Items $item */
            $item = $repo->findOneById($item_id);
            if (!$item) {
                $logger->error('item not found with id:' .$item_id);
                return;
            }else{
                // nếu cờ tự động dịch bằng true hoặc ko tồn tại thì cho chạy dịch tự động
                if(!$item->getIsAutoTranslate())
                {
                    $item->setTitle(Translator::translateTitle($item->getTitleOrigin()), false); // dịch title
                }
                // nếu dịch tự động thì lưu lại giá trị cờ của sản phẩm
                if(!$item->getIsAutoTranslateOption()){
                    $item->setOptions(Items::translateOptions($item->getOptions(), false)); // dịch option
                }

                $item->setIsAutoTranslate(false); // nếu tự động dịch thì set là false
                $item->save();
                #enregion
                #region --log lại thông tin id của các sản phẩm--
                $logger = Logger::factory('biz_web_translate_title');
                $logger->addInfo('ID sản phẩm được dịch', [ 'ID sản phẩm' => $item->getId()->{'$id'}]);
                #endregion
            }
        },10, function(){
            $time_end = microtime(true);
            $end_use_memory =  memory_get_usage(true);
            $memory = $end_use_memory/1048576;
            if($time_end > self::TIME_LIMIT || $memory > self::MEMORY_LIMIT){ // nếu lớn hơn 60s thì  break
                return true;
            }else {
                return false;
            }
        });
    }

    /**
     * @throws \Flywheel\Queue\Exception
     */
    public function executeTranslateSpecifications(){
        $queue = Queue::factory('translate_specifications');
        $this->doQueue($queue, 100, function($item_id) {
            $logger = Logger::factory('translate');
            $repo = new ItemsRepository(ConnectMongoDB::getConnection());
            /** @var \MongoDb\Items $item */
            $item = $repo->findOneById($item_id);
            if (!$item) {
                $logger->error('item not found with id:' .$item_id);
                return;
            }else{
                $trans_Spec = Items::translateSpecs($item->getSpecifications());
                $item->setSpecifications($trans_Spec); // dịch spection
                $item->save();
                #enregion
                #region --log lại thông tin id của các sản phẩm--
                $logger = Logger::factory('biz_web_translate_specification');
                $logger->addInfo('ID sản phẩm được dịch các specification', [ 'ID sản phẩm' => $item->getId()->{'$id'} ]);
                #endregion
            }
        },10, function(){
            $time_end = microtime(true);
            $end_use_memory =  memory_get_usage(true);
            $memory = $end_use_memory/1048576;
            if($time_end > self::TIME_LIMIT || $memory > self::MEMORY_LIMIT){ // nếu lớn hơn 60s thì  break
                return true;
            }else {
                return false;
            }
        });
    }
}