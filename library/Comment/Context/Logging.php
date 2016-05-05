<?php
namespace Comment\Context;

class Logging extends BaseContext implements IContext {
    protected $_type = BaseContext::TYPE_LOGGING;
    public function __construct() {
        $this->clientIp = \Users::getClientIp();
    }
} 