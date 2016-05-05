<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2/23/2016
 * Time: 11:09 AM
 */
namespace Comment\ActivityLogger;

use Mongodb\CommentResource\BaseActivity;
use Mongodb\CommentResource\BaseContext;
use Mongodb\CommentResource\BaseLog;
use Mongodb\ConnectMongoDB;

class ItemsComment {

    /**
     * @param $creator
     * @param $act
     * @param $actDesc
     * @param $object
     * @param null $objectId
     * @param array $context
     */
    public static function createActivity($creator, $act, $actDesc, $object, $objectId = null, $context = []) {
        $log = new \Mongodb\ItemsComment(ConnectMongoDB::getConnection());

        $contextData = $context;

        $contextData['message'] = "$actDesc";
        $log->setItemId($object);
        $log->setIdItems($objectId);

        $context = new BaseActivity($contextData);
        $context->setOwner($object);
        $log->setContext($context->toArray());
        $log->setCreatedBy($creator);

        $log->setCreatedTime(new \DateTime());
        $log->setIsPublicProfile(true);
        $log->setScope(BaseContext::SCOPE_INTERNAL);
        $log->setContextType($context->getType());

        $log->save();
    }


    public static function createLog($act, $actDesc, $object, $objectId = null, $context = []) {
        $log = new \Mongodb\ItemsComment(ConnectMongoDB::getConnection());

        $contextData = $context;

        $contextData['message'] = "$actDesc";
        $log->setItemId($object);
        $log->setIdItems($objectId);

        $context = new BaseLog($contextData);
        $context->setOwner($object);
        $log->setContext($context->toArray());

        $log->setCreatedTime(new \DateTime());
        $log->setIsPublicProfile(true);
        $log->setScope(BaseContext::SCOPE_INTERNAL);
        $log->setContextType($context->getType());

        $log->save();
    }

}