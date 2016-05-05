<?php
namespace Mongodb\CommentResource;

abstract class BaseContext {
    const
        TYPE_CHAT = 'CHAT',
        TYPE_ACTIVITY = 'ACTIVITY',
        TYPE_LOG = 'LOG';

    const
        SCOPE_INTERNAL = 'INTERNAL',
        SCOPE_EXTERNAL = 'EXTERNAL';

    protected $_attributes = array();

    /** @var BaseComment  */
    protected $_owner;

    protected $_type;

    /**
     * @param $data
     * @param $type
     * @return Activity|Chat|Log
     */
    public static function createFromDataAndType($data, $type) {
        switch ($type) {
            case 'CHAT' :
                return new BaseChat($data);
            case 'ACTIVITY':
                return new BaseActivity($data);
            case 'LOG':
                return new BaseLog($data);
        }
    }

    public function setOwner($owner) {
        $this->_owner = $owner;
    }

    public function getType() {
        return strtoupper($this->_attributes['type']);
    }

    public function toJSon() {
        return json_encode($this->_attributes);
    }
    public function toArray() {
        return $this->_attributes;
    }

    public function __set($name, $value) {
        $this->_attributes[$name] = $value;
    }

    public function __get($name) {
        return $this->_attributes[$name];
    }
}