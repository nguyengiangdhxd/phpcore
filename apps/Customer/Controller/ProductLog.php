<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 4/14/2016
 * Time: 10:41 AM
 */

namespace Customer\Controller;


use Comment\ActivityLogger\ItemsComment;
use Core\CustomerAuth;
use Mongodb\ConnectMongoDB;
use Mongodb\ItemsCommentRepository;
use Mongodb\ItemsRepository;

class ProductLog extends CustomerBase{

    public function executeDefault()
    {
        $this->setLayout('default');  // đã xét nmsgu
        $this->setView( 'Product/log' );
        $this->document()->title = 'Danh sách log sản phẩm';
        $contextType = $this->request()->get('contextType');
        $page = $this->request()->get('page','INT',0);
        $startTime = $this->request()->get('startTime','STRING');
        $endTime = $this->request()->get('endTime','STRING');
        if(!$page){
            $page = 1;
        }

        $array_data_condition= [];

        $this->document()->addJsVar('startTime',$startTime);
        $this->document()->addJsVar('endTime',$endTime);

        $array_data_condition['contextType'] = $contextType;
        $array_data_condition['page'] = $page;
        $this->view()->assign(
            $array_data_condition
        );
        return $this->renderComponent();
    }

    /**
     * hàm trả dữ liệu về phía client
     */
    public function executeGetListItemComment(){
        $ajax = new \AjaxResponse();
        $customer_id = CustomerAuth::getInstance()->getInstance()->getCustomer()->getId();
        $contextType = $this->request()->get('contextType');
        $startTime = $this->request()->get('startTime');
        $endTime = $this->request()->get('endTime');
        $page = $this->request()->get('page','INT',0);
        if(!$page){
            $page = 1;
        }
        $conditional = [];
        if($contextType){
            $conditional['contextType'] = $contextType;
        }
        $conditional['createdBy'] = (string)$customer_id;
        if($startTime){
            $startTimeMongo = new \MongoDate(
                \DateTime::createFromFormat("m/d/Y H:i:s", $startTime.":00")->getTimestamp());
        }
        if($endTime){
            $endTimeMongo = new \MongoDate(
                \DateTime::createFromFormat("m/d/Y H:i:s", $endTime.":00")->getTimestamp());
        }
        if(isset($startTimeMongo) || isset($endTime)){
            $conditional['createdTime'] = array(
                '$gt' => $startTimeMongo,
                '$lt' => $endTimeMongo
            );
        }


        $load_more = false;
        $totalResult = 0;
        $limit = 20;
        $itemComment = $this->_getListLogProduct($totalResult, $load_more, $conditional, $page, $limit);
        $ajax->type = \AjaxResponse::SUCCESS;
        $ajax->data = array( 'itemComment' => $itemComment );
        $ajax->total_product = $totalResult;
        $ajax->total_page = ceil( $totalResult / $limit );
        $ajax->page = $page;
        $ajax->load_more = $load_more;
        return $this->renderText( $ajax->toString());
    }

    /**
     * hàm get giá trị của tất cả các item comment
     * @param $total_result
     * @param $load_more
     * @param array $conditional
     * @param null $page
     * @param $limit
     * @return \Mandango\Query
     */
    private function _getListLogProduct(&$total_result,&$load_more, $conditional = array(), $page = null, $limit){
        $from = ($page - 1) * $limit;

        $itemCommentRepo = new ItemsCommentRepository(ConnectMongoDB::getConnection());
        $itemComments = $itemCommentRepo->createQuery()
            ->criteria($conditional)
            ->sort(['createdTime' => -1])
            ->skip($from)
            ->limit($limit);

        $total_result = $itemCommentRepo->createQuery()
            ->criteria($conditional)->count();
        if ($total_result <= ($from + $limit)) {
            $load_more = false;
        } else {
            $load_more = true;
        }
        $list_items = [];
        $index = 1 ;
        foreach($itemComments as $item){
            /** @var \Mongodb\Items $item */
            $tmp = $item->toArray();
            $tmp['index'] = $index++;
            $tmp['created_time'] = $item->getCreatedTime()->format('H:i:s d-m-Y');
            $list_items[] = $tmp;
        }
        return $list_items;
    }
}