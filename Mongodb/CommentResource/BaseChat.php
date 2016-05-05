<?php
namespace Mongodb\CommentResource;

class BaseChat extends BaseContext {
    protected $type = BaseContext::TYPE_CHAT;

    public function __construct($message) {
        $this->_attributes['type'] = $this->type;
       # $this->_attributes['clientip'] = \Logistic\ErrorHandler::getClientIp();
        if (is_array($message) && isset($message['message'])) {
            $this->_attributes['message'] = $message['message'];
        } else {
            $this->_attributes['message'] = $message;
        }
    }

    public function getMessage() {
        return $this->_attributes['message'];
    }
} 