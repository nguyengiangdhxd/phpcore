<?php
namespace Comment\Context;

class CustomerSummaries extends BaseContext implements IContext {
    protected $_type = BaseContext::TYPE_CUSTOMER_SUMMARIES;

    public function __construct() {
        $this->clientIp = \Users::getClientIp();
    }
} 