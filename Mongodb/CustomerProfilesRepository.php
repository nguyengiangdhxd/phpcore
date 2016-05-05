<?php

namespace Mongodb;

/**
 * Repository of Mongodb\CustomerProfiles document.
 */
class CustomerProfilesRepository extends \Mongodb\Base\CustomerProfilesRepository
{
    #region -- Singleton --
    private static $_instance;

    /**
     * @return static
     */
    public static function getInstance()
    {
        if (self::$_instance == null)
        {
            $mandango = ConnectMongoDB::getConnection();
            self::$_instance = new static($mandango);
        }

        return self::$_instance;
    }
    #endregion

    /**
     * Trả về CustomerProfiles theo customer id
     * @param $customerId
     * @return CustomerProfiles|null
     */
    public static function findOneOrCreateByCustomerId($customerId) {
        $repo =self::getInstance();
        $profile = $repo->createQuery(['customerId' => $customerId])->one();

        if (!$profile) {
            $profile = new \Mongodb\CustomerProfiles($repo->getMandango());
            $profile->setCustomerId($customerId);
            $customer = \Customer::retrieveById($customerId);
            $profile->setCustomerUsername($customer->getUsername());
        }

        return $profile;
    }
}