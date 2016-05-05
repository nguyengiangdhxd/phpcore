<?php
use Customer\Controller\CustomerBase;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 3/4/2016
 * Time: 10:51 AM
 */

class Todo extends CustomerBase{
    private $_params;

    public function executeDefault()
    {
        try {
            //get all of the parameters in the POST/GET request
            $params = $_REQUEST;

            //get the controller and format it correctly so the first
            //letter is always capitalized
            $controller = ucfirst(strtolower($params['controller']));

            //get the action and format it correctly so all the
            //letters are not capitalized, and append 'Action'
            $action = strtolower($params['action']).'Action';

            //check if the controller exists. if not, throw an exception
            if( file_exists("controllers/{$controller}.php") ) {
                include_once "controllers/{$controller}.php";
            } else {
                throw new Exception('Controller is invalid.');
            }

            //create a new instance of the controller, and pass
            //it the parameters from the request
            $controller = new $controller($params);

            //check if the action exists in the controller. if not, throw an exception.
            if( method_exists($controller, $action) === false ) {
                throw new Exception('Action is invalid.');
            }

            //execute the action
            $result['data'] = $controller->$action();
            $result['success'] = true;

        } catch( Exception $e ) {
            //catch any exceptions and report the problem
            $result = array();
            $result['success'] = false;
            $result['errormsg'] = $e->getMessage();
        }

//echo the result of the API call
        echo json_encode($result);
        exit();
    }

    /**
     * hàm khởi tạo
     * @param $param
     */
    public function __construct($param){
        $this->_params = $param;
    }

    /**
     * POST
     * xây dựng hàm thêm
     */
    public function executeCreateAction(){
        //create a new todo item
        $todo = new TodoItem();
        $todo->title = $this->_params['title'];
        $todo->description = $this->_params['description'];
        $todo->due_date = $this->_params['due_date'];
        $todo->is_done = 'false';

        //pass the user's username and password to authenticate the user
        $todo->save($this->_params['username'], $this->_params['userpass']);

        //return the todo item in array format
        return $todo->toArray();
    }

    /**
     * lấy dữ liệu tương tự với GET
     */
    public function executeReadAction(){

    }

    /**
     * tương tự với PUT
     */
    public function executeUpdateAction(){

    }

    /**
     * delete
     */
    public function executeDeleteAction(){

    }


}