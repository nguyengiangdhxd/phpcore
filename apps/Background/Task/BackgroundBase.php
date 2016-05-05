<?php
namespace Background\Task;
use Core\Logger;
use Flywheel\Exception;
use Flywheel\Controller\ConsoleTask;

abstract class BackgroundBase extends ConsoleTask {
    protected $limitExecuteTime = 30; //second
    protected $timeBegin;
    protected $processed = 0;
    const TIME_LIMIT = 900;
    const MEMORY_LIMIT = 115;

    /**
     * @param \Flywheel\Queue\Queue $queue
     * @param callable $doWork
     * @param callable $isBreakFunc hàm check xem có break ra khỏi vòng lặp queue hay không
     * @param int $usleep
     */
    public function doQueue($queue, $usleep = 10, $doWork, $isBreakFunc = null)
    {
        $logger = Logger::factory("do_queue");

        $processed = 0;
        try {
            do {
                $current = $queue->pop();
                if (!$current) {
                    break;
                }

                if (is_array($doWork)) {
                    $func = $doWork['func'];
                    $param = $doWork['param'];
                    $func($current, $param);
                }
                else {
                    #region --check xem điều kiện thực hiện hàm nếu hàm có thời gian thực thi lớn hơn khoang 60s thì break vòng lặp--
                    $doWork($current); // thực thi đối với queue
                    #endregion
                }
                usleep($usleep);
                $processed++;

                //break
                if (is_callable($isBreakFunc)) {
                    if (call_user_func($isBreakFunc)) {
                        break;
                    }
                }
            } while($current); //not need check time

        }catch (Exception $e) {
            $logger->error('Queue error: '.$e->getMessage());
        }
    }

    /**
     * do queue with break condition
     *
     * @param Queue $queue
     * @param callable $doWork
     * @param callable $condition
     * @param int $usleep
     */
    public function doQueueWithCondition($queue, $doWork, $condition, $usleep = 10) {
        $logger = Logger::factory("do_queue");

        $this->processed = 0;
        try {
            do {
                if (!$condition()) {
                    break;
                }

                $current = $queue->pop();
                if (!$current) {
                    break;
                }

                if (is_array($doWork)) {
                    $func = $doWork['func'];
                    $param = $doWork['param'];
                    $func($current, $param);
                }
                else {
                    $doWork($current); // thực thi đối với queue
                }

                usleep($usleep);
                $this->processed++;
            } while($current); //not need check time

        }catch (Exception $e) {
            $logger->error('Queue error: '.$e->getMessage());
        }
    }

}
