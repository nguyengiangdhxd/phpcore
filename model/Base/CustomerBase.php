<?php 
use Flywheel\Db\Manager;
use Flywheel\Model\ActiveRecord;
/**.
 * Customer
 * @version		$Id$
 * @package		Model

 * @property integer $id id primary auto_increment type : int(11) unsigned
 * @property string $uid uid type : varchar(10) max_length : 10
 * @property string $name name type : varchar(255) max_length : 255
 * @property string $username username type : varchar(100) max_length : 100
 * @property string $status status type : enum('ACTIVE','INACTIVE','BAN') max_length : 8
 * @property string $phone phone type : varchar(100) max_length : 100
 * @property string $email email type : varchar(255) max_length : 255
 * @property number $balance balance type : double(10,2)
 * @property number $debts debts type : double(10,2)
 * @property integer $district_id district_id type : int(11)
 * @property integer $province_id province_id type : int(11)
 * @property string $address address type : text max_length : 
 * @property string $mobile mobile type : varchar(100) max_length : 100
 * @property string $other_mobile other_mobile type : varchar(100) max_length : 100
 * @property date $birthday birthday type : date
 * @property string $password password type : char(72) max_length : 72
 * @property string $secret secret type : char(32) max_length : 32
 * @property string $last_login_ip last_login_ip type : varchar(255) max_length : 255
 * @property datetime $created_time created_time type : datetime
 * @property datetime $modified_time modified_time type : datetime
 * @property datetime $last_login_time last_login_time type : datetime

 * @method void setId(integer $id) set id value
 * @method integer getId() get id value
 * @method static \Customer[] findById(integer $id) find objects in database by id
 * @method static \Customer findOneById(integer $id) find object in database by id
 * @method static \Customer retrieveById(integer $id) retrieve object from poll by id, get it from db if not exist in poll

 * @method void setUid(string $uid) set uid value
 * @method string getUid() get uid value
 * @method static \Customer[] findByUid(string $uid) find objects in database by uid
 * @method static \Customer findOneByUid(string $uid) find object in database by uid
 * @method static \Customer retrieveByUid(string $uid) retrieve object from poll by uid, get it from db if not exist in poll

 * @method void setName(string $name) set name value
 * @method string getName() get name value
 * @method static \Customer[] findByName(string $name) find objects in database by name
 * @method static \Customer findOneByName(string $name) find object in database by name
 * @method static \Customer retrieveByName(string $name) retrieve object from poll by name, get it from db if not exist in poll

 * @method void setUsername(string $username) set username value
 * @method string getUsername() get username value
 * @method static \Customer[] findByUsername(string $username) find objects in database by username
 * @method static \Customer findOneByUsername(string $username) find object in database by username
 * @method static \Customer retrieveByUsername(string $username) retrieve object from poll by username, get it from db if not exist in poll

 * @method void setStatus(string $status) set status value
 * @method string getStatus() get status value
 * @method static \Customer[] findByStatus(string $status) find objects in database by status
 * @method static \Customer findOneByStatus(string $status) find object in database by status
 * @method static \Customer retrieveByStatus(string $status) retrieve object from poll by status, get it from db if not exist in poll

 * @method void setPhone(string $phone) set phone value
 * @method string getPhone() get phone value
 * @method static \Customer[] findByPhone(string $phone) find objects in database by phone
 * @method static \Customer findOneByPhone(string $phone) find object in database by phone
 * @method static \Customer retrieveByPhone(string $phone) retrieve object from poll by phone, get it from db if not exist in poll

 * @method void setEmail(string $email) set email value
 * @method string getEmail() get email value
 * @method static \Customer[] findByEmail(string $email) find objects in database by email
 * @method static \Customer findOneByEmail(string $email) find object in database by email
 * @method static \Customer retrieveByEmail(string $email) retrieve object from poll by email, get it from db if not exist in poll

 * @method void setBalance(number $balance) set balance value
 * @method number getBalance() get balance value
 * @method static \Customer[] findByBalance(number $balance) find objects in database by balance
 * @method static \Customer findOneByBalance(number $balance) find object in database by balance
 * @method static \Customer retrieveByBalance(number $balance) retrieve object from poll by balance, get it from db if not exist in poll

 * @method void setDebts(number $debts) set debts value
 * @method number getDebts() get debts value
 * @method static \Customer[] findByDebts(number $debts) find objects in database by debts
 * @method static \Customer findOneByDebts(number $debts) find object in database by debts
 * @method static \Customer retrieveByDebts(number $debts) retrieve object from poll by debts, get it from db if not exist in poll

 * @method void setDistrictId(integer $district_id) set district_id value
 * @method integer getDistrictId() get district_id value
 * @method static \Customer[] findByDistrictId(integer $district_id) find objects in database by district_id
 * @method static \Customer findOneByDistrictId(integer $district_id) find object in database by district_id
 * @method static \Customer retrieveByDistrictId(integer $district_id) retrieve object from poll by district_id, get it from db if not exist in poll

 * @method void setProvinceId(integer $province_id) set province_id value
 * @method integer getProvinceId() get province_id value
 * @method static \Customer[] findByProvinceId(integer $province_id) find objects in database by province_id
 * @method static \Customer findOneByProvinceId(integer $province_id) find object in database by province_id
 * @method static \Customer retrieveByProvinceId(integer $province_id) retrieve object from poll by province_id, get it from db if not exist in poll

 * @method void setAddress(string $address) set address value
 * @method string getAddress() get address value
 * @method static \Customer[] findByAddress(string $address) find objects in database by address
 * @method static \Customer findOneByAddress(string $address) find object in database by address
 * @method static \Customer retrieveByAddress(string $address) retrieve object from poll by address, get it from db if not exist in poll

 * @method void setMobile(string $mobile) set mobile value
 * @method string getMobile() get mobile value
 * @method static \Customer[] findByMobile(string $mobile) find objects in database by mobile
 * @method static \Customer findOneByMobile(string $mobile) find object in database by mobile
 * @method static \Customer retrieveByMobile(string $mobile) retrieve object from poll by mobile, get it from db if not exist in poll

 * @method void setOtherMobile(string $other_mobile) set other_mobile value
 * @method string getOtherMobile() get other_mobile value
 * @method static \Customer[] findByOtherMobile(string $other_mobile) find objects in database by other_mobile
 * @method static \Customer findOneByOtherMobile(string $other_mobile) find object in database by other_mobile
 * @method static \Customer retrieveByOtherMobile(string $other_mobile) retrieve object from poll by other_mobile, get it from db if not exist in poll

 * @method void setBirthday(\Flywheel\Db\Type\DateTime $birthday) setBirthday(string $birthday) set birthday value
 * @method \Flywheel\Db\Type\DateTime getBirthday() get birthday value
 * @method static \Customer[] findByBirthday(\Flywheel\Db\Type\DateTime $birthday) findByBirthday(string $birthday) find objects in database by birthday
 * @method static \Customer findOneByBirthday(\Flywheel\Db\Type\DateTime $birthday) findOneByBirthday(string $birthday) find object in database by birthday
 * @method static \Customer retrieveByBirthday(\Flywheel\Db\Type\DateTime $birthday) retrieveByBirthday(string $birthday) retrieve object from poll by birthday, get it from db if not exist in poll

 * @method void setPassword(string $password) set password value
 * @method string getPassword() get password value
 * @method static \Customer[] findByPassword(string $password) find objects in database by password
 * @method static \Customer findOneByPassword(string $password) find object in database by password
 * @method static \Customer retrieveByPassword(string $password) retrieve object from poll by password, get it from db if not exist in poll

 * @method void setSecret(string $secret) set secret value
 * @method string getSecret() get secret value
 * @method static \Customer[] findBySecret(string $secret) find objects in database by secret
 * @method static \Customer findOneBySecret(string $secret) find object in database by secret
 * @method static \Customer retrieveBySecret(string $secret) retrieve object from poll by secret, get it from db if not exist in poll

 * @method void setLastLoginIp(string $last_login_ip) set last_login_ip value
 * @method string getLastLoginIp() get last_login_ip value
 * @method static \Customer[] findByLastLoginIp(string $last_login_ip) find objects in database by last_login_ip
 * @method static \Customer findOneByLastLoginIp(string $last_login_ip) find object in database by last_login_ip
 * @method static \Customer retrieveByLastLoginIp(string $last_login_ip) retrieve object from poll by last_login_ip, get it from db if not exist in poll

 * @method void setCreatedTime(\Flywheel\Db\Type\DateTime $created_time) setCreatedTime(string $created_time) set created_time value
 * @method \Flywheel\Db\Type\DateTime getCreatedTime() get created_time value
 * @method static \Customer[] findByCreatedTime(\Flywheel\Db\Type\DateTime $created_time) findByCreatedTime(string $created_time) find objects in database by created_time
 * @method static \Customer findOneByCreatedTime(\Flywheel\Db\Type\DateTime $created_time) findOneByCreatedTime(string $created_time) find object in database by created_time
 * @method static \Customer retrieveByCreatedTime(\Flywheel\Db\Type\DateTime $created_time) retrieveByCreatedTime(string $created_time) retrieve object from poll by created_time, get it from db if not exist in poll

 * @method void setModifiedTime(\Flywheel\Db\Type\DateTime $modified_time) setModifiedTime(string $modified_time) set modified_time value
 * @method \Flywheel\Db\Type\DateTime getModifiedTime() get modified_time value
 * @method static \Customer[] findByModifiedTime(\Flywheel\Db\Type\DateTime $modified_time) findByModifiedTime(string $modified_time) find objects in database by modified_time
 * @method static \Customer findOneByModifiedTime(\Flywheel\Db\Type\DateTime $modified_time) findOneByModifiedTime(string $modified_time) find object in database by modified_time
 * @method static \Customer retrieveByModifiedTime(\Flywheel\Db\Type\DateTime $modified_time) retrieveByModifiedTime(string $modified_time) retrieve object from poll by modified_time, get it from db if not exist in poll

 * @method void setLastLoginTime(\Flywheel\Db\Type\DateTime $last_login_time) setLastLoginTime(string $last_login_time) set last_login_time value
 * @method \Flywheel\Db\Type\DateTime getLastLoginTime() get last_login_time value
 * @method static \Customer[] findByLastLoginTime(\Flywheel\Db\Type\DateTime $last_login_time) findByLastLoginTime(string $last_login_time) find objects in database by last_login_time
 * @method static \Customer findOneByLastLoginTime(\Flywheel\Db\Type\DateTime $last_login_time) findOneByLastLoginTime(string $last_login_time) find object in database by last_login_time
 * @method static \Customer retrieveByLastLoginTime(\Flywheel\Db\Type\DateTime $last_login_time) retrieveByLastLoginTime(string $last_login_time) retrieve object from poll by last_login_time, get it from db if not exist in poll


 */
abstract class CustomerBase extends ActiveRecord {
    protected static $_tableName = 'customer';
    protected static $_phpName = 'Customer';
    protected static $_pk = 'id';
    protected static $_alias = 'c';
    protected static $_dbConnectName = 'customer';
    protected static $_instances = array();
    protected static $_schema = array(
        'id' => array('name' => 'id',
                'not_null' => true,
                'type' => 'integer',
                'primary' => true,
                'auto_increment' => true,
                'db_type' => 'int(11) unsigned',
                'length' => 4),
        'uid' => array('name' => 'uid',
                'not_null' => false,
                'type' => 'string',
                'db_type' => 'varchar(10)',
                'length' => 10),
        'name' => array('name' => 'name',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'varchar(255)',
                'length' => 255),
        'username' => array('name' => 'username',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'varchar(100)',
                'length' => 100),
        'status' => array('name' => 'status',
                'default' => 'INACTIVE',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'enum(\'ACTIVE\',\'INACTIVE\',\'BAN\')',
                'length' => 8),
        'phone' => array('name' => 'phone',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'varchar(100)',
                'length' => 100),
        'email' => array('name' => 'email',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'varchar(255)',
                'length' => 255),
        'balance' => array('name' => 'balance',
                'default' => 0.00,
                'not_null' => true,
                'type' => 'number',
                'auto_increment' => false,
                'db_type' => 'double(10,2)',
                'length' => 10),
        'debts' => array('name' => 'debts',
                'default' => 0.00,
                'not_null' => true,
                'type' => 'number',
                'auto_increment' => false,
                'db_type' => 'double(10,2)',
                'length' => 10),
        'district_id' => array('name' => 'district_id',
                'not_null' => true,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'int(11)',
                'length' => 4),
        'province_id' => array('name' => 'province_id',
                'default' => 0,
                'not_null' => true,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'int(11)',
                'length' => 4),
        'address' => array('name' => 'address',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'text'),
        'mobile' => array('name' => 'mobile',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'varchar(100)',
                'length' => 100),
        'other_mobile' => array('name' => 'other_mobile',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'varchar(100)',
                'length' => 100),
        'birthday' => array('name' => 'birthday',
                'default' => '0000-00-00',
                'not_null' => true,
                'type' => 'date',
                'db_type' => 'date'),
        'password' => array('name' => 'password',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'char(72)',
                'length' => 72),
        'secret' => array('name' => 'secret',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'char(32)',
                'length' => 32),
        'last_login_ip' => array('name' => 'last_login_ip',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'varchar(255)',
                'length' => 255),
        'created_time' => array('name' => 'created_time',
                'default' => '0000-00-00 00:00:00',
                'not_null' => true,
                'type' => 'datetime',
                'db_type' => 'datetime'),
        'modified_time' => array('name' => 'modified_time',
                'default' => '0000-00-00 00:00:00',
                'not_null' => true,
                'type' => 'datetime',
                'db_type' => 'datetime'),
        'last_login_time' => array('name' => 'last_login_time',
                'default' => '0000-00-00 00:00:00',
                'not_null' => true,
                'type' => 'datetime',
                'db_type' => 'datetime'),
     );
    protected static $_validate = array(
        'username' => array(
            array('name' => 'Unique',
                'message'=> 'username\'s was used'
            ),
        ),
        'status' => array(
            array('name' => 'ValidValues',
                'value' => 'ACTIVE|INACTIVE|BAN',
                'message'=> 'status\'s values is not allowed'
            ),
        ),
    );
    protected static $_validatorRules = array(
        'username' => array(
            array('name' => 'Unique',
                'message'=> 'username\'s was used'
            ),
        ),
        'status' => array(
            array('name' => 'ValidValues',
                'value' => 'ACTIVE|INACTIVE|BAN',
                'message'=> 'status\'s values is not allowed'
            ),
        ),
    );
    protected static $_init = false;
    protected static $_cols = array('id','uid','name','username','status','phone','email','balance','debts','district_id','province_id','address','mobile','other_mobile','birthday','password','secret','last_login_ip','created_time','modified_time','last_login_time');

    public function setTableDefinition() {
    }

    /**
     * save object model
     * @return boolean
     * @throws \Exception
     */
    public function save($validate = true) {
        $conn = Manager::getConnection(self::getDbConnectName());
        $conn->beginTransaction();
        try {
            $this->_beforeSave();
            $status = $this->saveToDb($validate);
            $this->_afterSave();
            $conn->commit();
            self::addInstanceToPool($this, $this->getPkValue());
            return $status;
        }
        catch (\Exception $e) {
            $conn->rollBack();
            throw $e;
        }
    }

    /**
     * delete object model
     * @return boolean
     * @throws \Exception
     */
    public function delete() {
        $conn = Manager::getConnection(self::getDbConnectName());
        $conn->beginTransaction();
        try {
            $this->_beforeDelete();
            $this->deleteFromDb();
            $this->_afterDelete();
            $conn->commit();
            self::removeInstanceFromPool($this->getPkValue());
            return true;
        }
        catch (\Exception $e) {
            $conn->rollBack();
            throw $e;
        }
    }
}