<?php

namespace Mongodb;

/**
 * Repository of Mongodb\Items document.
 */
class ItemsRepository extends \Mongodb\Base\ItemsRepository
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