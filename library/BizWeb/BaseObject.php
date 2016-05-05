<?php
namespace BizWeb;
use Flywheel\Util\Inflection;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 12/12/2015
 * Time: 11:30 AM
 */

class BaseObject {

    protected $_data = [];

    /** @var $_client BizWebClient */
    protected $_client;

    /**
     * @param BizWebClient $client
     */
    public function __construct($client) {
        $this->_client = $client;
    }

    public function __set($name, $value) {
        $this->$name = $value;
    }

    public function __get($name) {
        return $this->$name;
    }

    public function __call($method, $params) {
        if (strrpos($method, 'set') === 0
            && isset($params[0]) && null !== $params[0]) {
            $name = Inflection::camelCaseToHungary(substr($method, 3, strlen($method)));

            $this->_data[$name] = $params[0];
            return true;
        }

        if (strpos($method, 'get') === 0) {
            $name = Inflection::camelCaseToHungary(substr($method, 3, strlen($method)));
            if (array_key_exists($name, $this->_data)) {
                return isset($this->_data[$name])? $this->_data[$name]: null ;
            }
            return null;
        }

        return $this->$method($params);
    }

    /**
     * Create params for API to call
     * @param $validFields
     * @return array
     */
    public function generateParams($validFields) {
        $params = [];
        foreach ($this->_data as $key=>$value) {
            if (in_array($key, $validFields)) {
                if (!empty($value) || $value === false)
                {
                    $params[$key] = $value;
                }
            }
        }

        return $params;
    }

    /**
     * @return mixed
     */
    public function toArray() {
        return $this->_data;
    }

    /**
     * @param array $data
     */
    public function fromArray($data = []) {
        if (!is_array($data)) {
            $data = [];
        }
        $this->_data = $data;
    }
}