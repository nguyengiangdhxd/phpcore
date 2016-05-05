<?php

class CustomerPeer
{
    /**
     * Check available mobiles number
     *
     * @param array $mobiles
     * @param int|\ShippingCustomer $customer
     * @return \Customer
     */
    public static function checkAvailableMobiles(array $mobiles, $customer = null)
    {
        $mobiles = implode('", "', $mobiles);
        if ($customer instanceof \Customer) {
            $customer = $customer->getId();
        }

        if (empty($mobiles)) {
            throw new \RuntimeException('$mobiles parameter could not be empty');
        }
        $taken = \Customer::select()->where('`mobile` IN ("' . $mobiles . '") OR `other_mobile` IN ("' . $mobiles . '")');
        if ($customer) {
            $taken->andWhere('`id` != ' . $customer);
        }
        $taken = $taken->execute();

        return empty($taken) ? null : $taken[0];
    }

    /**
     * @param $uid
     * @param null|Customer $customer
     * @param $error
     * @return bool
     */
    public static function checkValidUid($uid, $customer = null, &$error)
    {
        //check format
        if (!preg_match("/^[A-Za-z0-9]{3,8}$/", $uid)) {
            $error = t('Not valid customer code. Customer code from 3-8 character, only contain character (A-Z) and number (0-9)');
            return false;
        }

        //check duplicate
        $taken = \Customer::select()
            ->where('`uid` = :uid')
            ->setParameter(':uid', $uid, \PDO::PARAM_STR);
        if ($customer && $customer instanceof \Customer && $customer->getId()) {
            $taken->andWhere('id != ' . $customer->getId());
        }

        $taken = $taken->execute();
        if (!empty($taken)) {
            $error = t('Customer code was used by %other%', ['%other%' => $taken[0]->getUsername()]);
            return false;
        }

        return true;
    }

    /**
     * @param $username
     * @param null $customer
     * @param $error
     * @return bool
     */
    public static function checkValidUsername($username, $customer = null, &$error)
    {
        if (!\Flywheel\Validator\Util::isValidUsername($username)) {
            $error = t('Tên đăng nhập không hợp lệ');
            return false;
        }

        //check taken
        $taken = \Customer::select()
            ->where('`username` = :username')
            ->setParameter(':username', $username);
        if ($customer && $customer instanceof \Customer) {
            $taken->andWhere('id != ' . $customer->getId());
        }

        $taken = $taken->execute();
        if (!empty($taken)) {
            $error = t('Tên đăng nhập đã được sử dụng');
            return false;
        }

        return true;
    }

    /**
     * @param $email
     * @param null|Customer $customer
     * @param $error
     * @return bool
     */
    public static function checkValidEmail($email, $customer = null, &$error)
    {
        if (!\Flywheel\Validator\Util::isValidEmail($email)) {
            $error = t('Email không hợp lệ');
            return false;
        }

        //check taken
        $taken = \Customer::select()
            ->where('`email` = :email')
            ->setParameter(':email', $email);
        if ($customer && $customer instanceof \Customer) {
            $taken->andWhere('id != ' . $customer->getId());
        }

        $taken = $taken->execute();
        if (!empty($taken)) {
            $error = t('Email này đã được sử dụng');
            return false;
        }

        return true;
    }

    /**
     * Change customer password and save
     *
     * @author luuhieu
     * @param Customer $cus
     * @param string $oldPassword
     * @param string $newPassword
     * @return bool
     * @throws Exception
     */
    public static function changePassword(\Customer $cus, $oldPassword, $newPassword)
    {
        $hashOldPassword = \Users::hashPassword($oldPassword, $cus->getPassword());
        if ($cus->getPassword() === $hashOldPassword) {
            $hashNewPassword = \Users::hashPassword($newPassword);
            $cus->setPassword($hashNewPassword);
            return $cus->save();
        }

        return false;
    }

    /**
     * Get avatar url using gravatar
     *
     * @param Customer $customer
     * @param $size
     * @return string
     */
    public static function getAvatarUrl(\Customer $customer, $size)
    {
        if(is_numeric($customer)) {
            $customer = \Customer::retrieveById($customer);
        }

        if (!($customer instanceof \Customer)) {
            $email = '0000000000000000000000000'; //null email
            return GravatarHelper::getGravatar($email, $size);
        }

        if (!$customer->getEmail()) {
            return GravatarHelper::getGravatar($customer->getUsername(), $size);
        }

        return GravatarHelper::getGravatar($customer->getEmail(), $size);
    }
}