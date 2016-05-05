<?php
namespace Background\Task;
use Background\Library\EmailHelper;
use Core\Queue;
use Flywheel\Util\Folder;

class Email extends BackgroundBase {
    protected $limitExecuteTime = 20;
    protected $limit = 100;

    public function executePushError() {
        $queue = Queue::emailError();
        $caching_folder = RUNTIME_PATH . '/email_error_caching/';
        Folder::create($caching_folder);
        try {
            do {
                $current = $queue->pop();
                if(!$current) {
                    print_r("Queue is empty \n");
                    break;
                }

                $data = json_decode($current, true);
                $cache_file_name = date('Y-m-d') .(isset($data['body'])? md5($data['body']) .'_' : '_') .'_' .$data['email'];
                if (isset($data['body'])) {
                    if (file_exists($caching_folder .$cache_file_name)) {//sent
                        continue;
                    }
                }

                $result = EmailHelper::sendEmail($data);

                if(!$result){
                    print_r("ERROR : " .$data['email'] ." is invalid!\n");
                } else {
                    @file_put_contents($caching_folder .$cache_file_name, @$data['body']);
                    print_r("SUCCESS: is sent \n");
                }

                usleep(100); //sleep 1/10 seconds

            } while ($current);

        } catch (\Flywheel\Exception $e) {
            print_r($e->getMessage());
        }
    }
}
