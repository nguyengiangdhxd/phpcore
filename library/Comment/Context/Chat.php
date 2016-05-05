<?php
namespace Comment\Context;

class Chat extends BaseContext implements IContext {
    protected $_type = BaseContext::TYPE_CHAT;

    public function __construct() {
        $this->clientIp = \Users::getClientIp();
    }
} 