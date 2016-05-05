<?php 
/**
 * Customer
 * @version		$Id$
 * @package		Model

 */

use Flywheel\Db\Expression;
use Flywheel\Db\Type\DateTime;

require_once dirname(__FILE__) .'/Base/CustomerBase.php';
class Customer extends \CustomerBase {
    const STATUS_ACTIVE = 'ACTIVE',
        STATUS_INACTIVE = 'INACTIVE',
        STATUS_BAN = 'BAN';

    /**
     * init
     */
    public function init()
    {
        parent::init();
        $this->attachBehavior(
            'TimeStamp', new \Flywheel\Model\Behavior\TimeStamp(), [
                'create_attr' => 'created_time',
                'modify_attr' => 'modified_time'
            ]
        );
    }

    public function validationRules()
    {
        self::$_validate['name'][] = array(
            'name' => 'Require',
            'message' => "Name can not be blank!");

        self::$_validate['mobile'][] = array(
            'name' => 'Match',
            'value' => '/^((\+|00)+[0-4]+[0-9]+)?([ -]?[0-9]{2,15}){1,5}$/',
            'message' => "phone number's format is not valid!"
        );
    }

    public function changePass($oldPassword, $newPassword)
    {
        $hashNewPassword = \Users::hashPassword($newPassword);
        $this->setPassword($hashNewPassword);
        return $this;
    }

    /**
     *
     */
    protected function _beforeSave()
    {
        if (!$this->getSecret()) {
            $secret = ModelUtil::randMd5(32);
            $this->setSecret($secret);
        }

        if ($this->isNew()) {
            $this->setLastLoginIp(\UsersPeer::getClientIp());
            $this->setLastLoginTime(new DateTime());
        }

        parent::_beforeSave();
    }

    /**
     * Get secret, create new and save if not exist
     *
     * @return string
     * @throws Exception
     */
    public function getSecret()
    {
        $secret = parent::getSecret();
        if (!$secret) {
            $secret = ModelUtil::randMd5(32);
            $this->setSecret($secret);
            $this->save(false);
        }

        return $secret;
    }

    /**
     * Get avatar url follow size
     *
     * @param integer $size avatar size
     * @return string
     */
    public function getAvatar($size)
    {
        return \CustomerPeer::getAvatarUrl($this, $size);
    }
}