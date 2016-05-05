<?php

namespace Mongodb;

/**
 * Repository of Mongodb\ItemsComment document.
 */
class ItemsCommentRepository extends \Mongodb\Base\ItemsCommentRepository
{
    public function createQuery(array $criteria = array()) {

        return parent::createQuery($criteria);
    }
    #endregion

    #region -- Singleton --
    protected static $_instance;


    public static function getInstance()
    {
        if (!isset(static::$_instance))
        {
            $mandango = ConnectMongoDB::getConnection();
            static::$_instance = new static($mandango);
        }

        return static::$_instance;
    }
}