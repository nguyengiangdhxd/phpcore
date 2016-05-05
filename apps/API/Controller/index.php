<?php
use Customer\Controller\CustomerBase;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 3/4/2016
 * Time: 10:50 AM
 */

class index extends CustomerBase {

    public function executeDefault()
    {
        $application = [
            'APP001' => '28e336ac6c9423d946ba02d19c6a2632'
        ];
        try {
            /**
             * get key mã hóa trên trình duyệt
             */
            $enc_request = $_REQUEST['enc_request'];

            //get the provided app id
            $app_id = $_REQUEST['app_id'];

            //check first if the app id exists in the list of applications
            if( !isset($applications[$app_id])) {
                throw new Exception('Application does not exist!');
            }

            //decrypt the request
            $params = json_decode(trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $applications[$app_id], base64_decode($enc_request), MCRYPT_MODE_ECB)));

            //check if the request is valid by checking if it's an array and looking for the controller and action
            if( $params == false || isset($params->controller) == false || isset($params->action) == false ) {
                throw new Exception('Request is not valid');
            }

            //cast it into an array
            $params = (array) $params;
            //get all of the parameters in the POST/GET request
            #$params = $_REQUEST;

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
}