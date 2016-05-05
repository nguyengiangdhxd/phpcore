<?php
/**
 * Created by PhpStorm.
 * User: Piggat
 * Date: 12/24/15
 * Time: 2:50 PM
 */

namespace Core\IntergrationApp;

use Customer\Controller\CustomerBase;

interface IIntergrationApplication {
    function createAuthorizeUrl(CustomerBase $controller);

    function isConfirmed(CustomerBase $controller);

    function getConfirmData(CustomerBase $controller);

    function authorize(CustomerBase $controller);

    function sync($item);
} 