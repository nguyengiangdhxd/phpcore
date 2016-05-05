<?php

namespace Comment\Context;

class Activity extends BaseContext implements IContext {
    protected $_type = BaseContext::TYPE_ACTIVITY;

    public function __construct() {
        $this->clientIp = \Users::getClientIp();
    }
} 