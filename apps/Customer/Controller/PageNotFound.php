<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2/16/2016
 * Time: 2:27 PM
 */

namespace Customer\Controller;


class PageNotFound extends CustomerBase {

    public function executeDefault()
    {
        $this->setLayout('default');  // đã xét nmsgu
        $this->setView( 'NotFound/notfound' );
        $this->document()->title = 'Not found';
        return $this->renderComponent();
    }
}