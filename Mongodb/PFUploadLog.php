<?php

namespace Mongodb;

/**
 * Mongodb\PFUploadLog document.
 */
class PFUploadLog extends \Mongodb\Base\PFUploadLog
{
    const TYPE_SUCCESS = 'SUCCESS',
        TYPE_WARNING = 'WARNING',
        TYPE_FAIL = 'FAIL';

    /**
     * Add success log
     *
     * @param $message
     * @param string $object_id
     * @param null /int $uploader
     * @return \Mandango\Document\Document
     */
    public static function success($message, $object_id = '', $uploader = null) {
        return self::addLog(self::TYPE_SUCCESS, $message, $object_id, $uploader);
    }

    /**
     * Add success log
     *
     * @param $message
     * @param string $object_id
     * @param null /int $uploader
     * @return \Mandango\Document\Document
     */
    public static function warning($message, $object_id = '', $uploader = null) {
        return self::addLog(self::TYPE_WARNING, $message, $object_id, $uploader);
    }

    /**
     * Add error log
     *
     * @param $message
     * @param string $object_id
     * @param null /int $uploader
     * @return \Mandango\Document\Document
     */
    public static function error($message, $object_id = '', $uploader = null) {
        return self::addLog(self::TYPE_FAIL, $message, $object_id, $uploader);
    }

    /**
     * @param $type
     * @param $message
     * @param string $object_id
     * @param null $uploader
     * @return \Mandango\Document\Document
     */
    public static function addLog($type, $message, $object_id = '', $uploader = null) {
        $om = new self(ConnectMongoDB::getConnection());
        $om->setMessage($message);
        $om->setType($type);
        $om->setObjectId($object_id);
        $om->setUploader((int) $uploader);
        $om->setLogDate(new \DateTime());
        return $om->save();
    }
}