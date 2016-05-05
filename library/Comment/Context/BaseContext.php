<?php
namespace Comment\Context;

abstract class BaseContext {
    const TYPE_CHAT = 'CHAT',
        TYPE_ACTIVITY = 'ACTIVITY',
        TYPE_LOGGING = 'LOGGING',
        TYPE_CUSTOMER_SUMMARIES = 'CUSTOMER_SUMMARIES';

    protected $_attributes = [];

    protected $_type;

    public function setType($type) {
        $this->_type = $type;
    }

    public function getType() {
        return $this->_type;
    }

    public function toArray() {
        $a = $this->_attributes;
        $a['type'] = $this->getType();
        return $a;
    }

    public function toJson() {
        return json_encode($this->_attributes);
    }

    public function __set($name, $value) {
        $this->_attributes[$name] = $value;
    }

    public function __get($name) {
        return isset($this->_attributes[$name])
            ? $this->_attributes[$name] : null;
    }
}