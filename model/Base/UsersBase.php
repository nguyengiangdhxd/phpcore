<?php 
use Flywheel\Db\Manager;
use Flywheel\Model\ActiveRecord;
/**.
 * Users
 * @version		$Id$
 * @package		Model

 * @property integer $id id primary auto_increment type : int(11) unsigned
 * @property string $username username type : varchar(100) max_length : 100
 * @property string $code code type : char(8) max_length : 8
 * @property string $account_no account_no type : char(16) max_length : 16
 * @property integer $account_balance account_balance type : int(11)
 * @property string $payment_pass payment_pass type : char(72) max_length : 72
 * @property string $section section type : enum('CUSTOMER','CRANE') max_length : 8
 * @property string $status status type : enum('ACTIVE','INACTIVE','BAN','LOCK','DELETE') max_length : 8
 * @property string $email email type : varchar(100) max_length : 100
 * @property string $password password type : char(72) max_length : 72
 * @property string $secret_key secret_key type : char(32) max_length : 32
 * @property string $avatar avatar type : varchar(255) max_length : 255
 * @property integer $verify_email verify_email type : tinyint(1)
 * @property integer $verify_mobile verify_mobile type : tinyint(1)
 * @property string $nationality nationality type : enum('VIETNAM','CHINESE') max_length : 7
 * @property string $detail_address detail_address type : text max_length : 
 * @property integer $tt_id tt_id type : int(11)
 * @property string $tt_address tt_address type : text max_length : 
 * @property integer $qh_id qh_id type : int(11)
 * @property string $qh_address qh_address type : text max_length : 
 * @property string $first_name first_name type : varchar(50) max_length : 50
 * @property string $last_name last_name type : varchar(50) max_length : 50
 * @property integer $gender gender type : tinyint(1)
 * @property date $birthday birthday type : date
 * @property string $last_login_ip last_login_ip type : varchar(100) max_length : 100
 * @property string $facebook_id facebook_id type : varchar(100) max_length : 100
 * @property number $point_member point_member type : double
 * @property integer $level_id level_id type : int(11)
 * @property datetime $last_changed_pass last_changed_pass type : datetime
 * @property integer $has_deposited_order has_deposited_order type : tinyint(1)
 * @property integer $has_order has_order type : tinyint(1)
 * @property integer $has_received_order has_received_order type : tinyint(1)
 * @property datetime $last_login_time last_login_time type : datetime
 * @property string $version version type : varchar(50) max_length : 50
 * @property datetime $modified_time modified_time type : datetime
 * @property datetime $joined_time joined_time type : datetime

 * @method void setId(integer $id) set id value
 * @method integer getId() get id value
 * @method static \Users[] findById(integer $id) find objects in database by id
 * @method static \Users findOneById(integer $id) find object in database by id
 * @method static \Users retrieveById(integer $id) retrieve object from poll by id, get it from db if not exist in poll

 * @method void setUsername(string $username) set username value
 * @method string getUsername() get username value
 * @method static \Users[] findByUsername(string $username) find objects in database by username
 * @method static \Users findOneByUsername(string $username) find object in database by username
 * @method static \Users retrieveByUsername(string $username) retrieve object from poll by username, get it from db if not exist in poll

 * @method void setCode(string $code) set code value
 * @method string getCode() get code value
 * @method static \Users[] findByCode(string $code) find objects in database by code
 * @method static \Users findOneByCode(string $code) find object in database by code
 * @method static \Users retrieveByCode(string $code) retrieve object from poll by code, get it from db if not exist in poll

 * @method void setAccountNo(string $account_no) set account_no value
 * @method string getAccountNo() get account_no value
 * @method static \Users[] findByAccountNo(string $account_no) find objects in database by account_no
 * @method static \Users findOneByAccountNo(string $account_no) find object in database by account_no
 * @method static \Users retrieveByAccountNo(string $account_no) retrieve object from poll by account_no, get it from db if not exist in poll

 * @method void setAccountBalance(integer $account_balance) set account_balance value
 * @method integer getAccountBalance() get account_balance value
 * @method static \Users[] findByAccountBalance(integer $account_balance) find objects in database by account_balance
 * @method static \Users findOneByAccountBalance(integer $account_balance) find object in database by account_balance
 * @method static \Users retrieveByAccountBalance(integer $account_balance) retrieve object from poll by account_balance, get it from db if not exist in poll

 * @method void setPaymentPass(string $payment_pass) set payment_pass value
 * @method string getPaymentPass() get payment_pass value
 * @method static \Users[] findByPaymentPass(string $payment_pass) find objects in database by payment_pass
 * @method static \Users findOneByPaymentPass(string $payment_pass) find object in database by payment_pass
 * @method static \Users retrieveByPaymentPass(string $payment_pass) retrieve object from poll by payment_pass, get it from db if not exist in poll

 * @method void setSection(string $section) set section value
 * @method string getSection() get section value
 * @method static \Users[] findBySection(string $section) find objects in database by section
 * @method static \Users findOneBySection(string $section) find object in database by section
 * @method static \Users retrieveBySection(string $section) retrieve object from poll by section, get it from db if not exist in poll

 * @method void setStatus(string $status) set status value
 * @method string getStatus() get status value
 * @method static \Users[] findByStatus(string $status) find objects in database by status
 * @method static \Users findOneByStatus(string $status) find object in database by status
 * @method static \Users retrieveByStatus(string $status) retrieve object from poll by status, get it from db if not exist in poll

 * @method void setEmail(string $email) set email value
 * @method string getEmail() get email value
 * @method static \Users[] findByEmail(string $email) find objects in database by email
 * @method static \Users findOneByEmail(string $email) find object in database by email
 * @method static \Users retrieveByEmail(string $email) retrieve object from poll by email, get it from db if not exist in poll

 * @method void setPassword(string $password) set password value
 * @method string getPassword() get password value
 * @method static \Users[] findByPassword(string $password) find objects in database by password
 * @method static \Users findOneByPassword(string $password) find object in database by password
 * @method static \Users retrieveByPassword(string $password) retrieve object from poll by password, get it from db if not exist in poll

 * @method void setSecretKey(string $secret_key) set secret_key value
 * @method string getSecretKey() get secret_key value
 * @method static \Users[] findBySecretKey(string $secret_key) find objects in database by secret_key
 * @method static \Users findOneBySecretKey(string $secret_key) find object in database by secret_key
 * @method static \Users retrieveBySecretKey(string $secret_key) retrieve object from poll by secret_key, get it from db if not exist in poll

 * @method void setAvatar(string $avatar) set avatar value
 * @method string getAvatar() get avatar value
 * @method static \Users[] findByAvatar(string $avatar) find objects in database by avatar
 * @method static \Users findOneByAvatar(string $avatar) find object in database by avatar
 * @method static \Users retrieveByAvatar(string $avatar) retrieve object from poll by avatar, get it from db if not exist in poll

 * @method void setVerifyEmail(integer $verify_email) set verify_email value
 * @method integer getVerifyEmail() get verify_email value
 * @method static \Users[] findByVerifyEmail(integer $verify_email) find objects in database by verify_email
 * @method static \Users findOneByVerifyEmail(integer $verify_email) find object in database by verify_email
 * @method static \Users retrieveByVerifyEmail(integer $verify_email) retrieve object from poll by verify_email, get it from db if not exist in poll

 * @method void setVerifyMobile(integer $verify_mobile) set verify_mobile value
 * @method integer getVerifyMobile() get verify_mobile value
 * @method static \Users[] findByVerifyMobile(integer $verify_mobile) find objects in database by verify_mobile
 * @method static \Users findOneByVerifyMobile(integer $verify_mobile) find object in database by verify_mobile
 * @method static \Users retrieveByVerifyMobile(integer $verify_mobile) retrieve object from poll by verify_mobile, get it from db if not exist in poll

 * @method void setNationality(string $nationality) set nationality value
 * @method string getNationality() get nationality value
 * @method static \Users[] findByNationality(string $nationality) find objects in database by nationality
 * @method static \Users findOneByNationality(string $nationality) find object in database by nationality
 * @method static \Users retrieveByNationality(string $nationality) retrieve object from poll by nationality, get it from db if not exist in poll

 * @method void setDetailAddress(string $detail_address) set detail_address value
 * @method string getDetailAddress() get detail_address value
 * @method static \Users[] findByDetailAddress(string $detail_address) find objects in database by detail_address
 * @method static \Users findOneByDetailAddress(string $detail_address) find object in database by detail_address
 * @method static \Users retrieveByDetailAddress(string $detail_address) retrieve object from poll by detail_address, get it from db if not exist in poll

 * @method void setTtId(integer $tt_id) set tt_id value
 * @method integer getTtId() get tt_id value
 * @method static \Users[] findByTtId(integer $tt_id) find objects in database by tt_id
 * @method static \Users findOneByTtId(integer $tt_id) find object in database by tt_id
 * @method static \Users retrieveByTtId(integer $tt_id) retrieve object from poll by tt_id, get it from db if not exist in poll

 * @method void setTtAddress(string $tt_address) set tt_address value
 * @method string getTtAddress() get tt_address value
 * @method static \Users[] findByTtAddress(string $tt_address) find objects in database by tt_address
 * @method static \Users findOneByTtAddress(string $tt_address) find object in database by tt_address
 * @method static \Users retrieveByTtAddress(string $tt_address) retrieve object from poll by tt_address, get it from db if not exist in poll

 * @method void setQhId(integer $qh_id) set qh_id value
 * @method integer getQhId() get qh_id value
 * @method static \Users[] findByQhId(integer $qh_id) find objects in database by qh_id
 * @method static \Users findOneByQhId(integer $qh_id) find object in database by qh_id
 * @method static \Users retrieveByQhId(integer $qh_id) retrieve object from poll by qh_id, get it from db if not exist in poll

 * @method void setQhAddress(string $qh_address) set qh_address value
 * @method string getQhAddress() get qh_address value
 * @method static \Users[] findByQhAddress(string $qh_address) find objects in database by qh_address
 * @method static \Users findOneByQhAddress(string $qh_address) find object in database by qh_address
 * @method static \Users retrieveByQhAddress(string $qh_address) retrieve object from poll by qh_address, get it from db if not exist in poll

 * @method void setFirstName(string $first_name) set first_name value
 * @method string getFirstName() get first_name value
 * @method static \Users[] findByFirstName(string $first_name) find objects in database by first_name
 * @method static \Users findOneByFirstName(string $first_name) find object in database by first_name
 * @method static \Users retrieveByFirstName(string $first_name) retrieve object from poll by first_name, get it from db if not exist in poll

 * @method void setLastName(string $last_name) set last_name value
 * @method string getLastName() get last_name value
 * @method static \Users[] findByLastName(string $last_name) find objects in database by last_name
 * @method static \Users findOneByLastName(string $last_name) find object in database by last_name
 * @method static \Users retrieveByLastName(string $last_name) retrieve object from poll by last_name, get it from db if not exist in poll

 * @method void setGender(integer $gender) set gender value
 * @method integer getGender() get gender value
 * @method static \Users[] findByGender(integer $gender) find objects in database by gender
 * @method static \Users findOneByGender(integer $gender) find object in database by gender
 * @method static \Users retrieveByGender(integer $gender) retrieve object from poll by gender, get it from db if not exist in poll

 * @method void setBirthday(\Flywheel\Db\Type\DateTime $birthday) setBirthday(string $birthday) set birthday value
 * @method \Flywheel\Db\Type\DateTime getBirthday() get birthday value
 * @method static \Users[] findByBirthday(\Flywheel\Db\Type\DateTime $birthday) findByBirthday(string $birthday) find objects in database by birthday
 * @method static \Users findOneByBirthday(\Flywheel\Db\Type\DateTime $birthday) findOneByBirthday(string $birthday) find object in database by birthday
 * @method static \Users retrieveByBirthday(\Flywheel\Db\Type\DateTime $birthday) retrieveByBirthday(string $birthday) retrieve object from poll by birthday, get it from db if not exist in poll

 * @method void setLastLoginIp(string $last_login_ip) set last_login_ip value
 * @method string getLastLoginIp() get last_login_ip value
 * @method static \Users[] findByLastLoginIp(string $last_login_ip) find objects in database by last_login_ip
 * @method static \Users findOneByLastLoginIp(string $last_login_ip) find object in database by last_login_ip
 * @method static \Users retrieveByLastLoginIp(string $last_login_ip) retrieve object from poll by last_login_ip, get it from db if not exist in poll

 * @method void setFacebookId(string $facebook_id) set facebook_id value
 * @method string getFacebookId() get facebook_id value
 * @method static \Users[] findByFacebookId(string $facebook_id) find objects in database by facebook_id
 * @method static \Users findOneByFacebookId(string $facebook_id) find object in database by facebook_id
 * @method static \Users retrieveByFacebookId(string $facebook_id) retrieve object from poll by facebook_id, get it from db if not exist in poll

 * @method void setPointMember(number $point_member) set point_member value
 * @method number getPointMember() get point_member value
 * @method static \Users[] findByPointMember(number $point_member) find objects in database by point_member
 * @method static \Users findOneByPointMember(number $point_member) find object in database by point_member
 * @method static \Users retrieveByPointMember(number $point_member) retrieve object from poll by point_member, get it from db if not exist in poll

 * @method void setLevelId(integer $level_id) set level_id value
 * @method integer getLevelId() get level_id value
 * @method static \Users[] findByLevelId(integer $level_id) find objects in database by level_id
 * @method static \Users findOneByLevelId(integer $level_id) find object in database by level_id
 * @method static \Users retrieveByLevelId(integer $level_id) retrieve object from poll by level_id, get it from db if not exist in poll

 * @method void setLastChangedPass(\Flywheel\Db\Type\DateTime $last_changed_pass) setLastChangedPass(string $last_changed_pass) set last_changed_pass value
 * @method \Flywheel\Db\Type\DateTime getLastChangedPass() get last_changed_pass value
 * @method static \Users[] findByLastChangedPass(\Flywheel\Db\Type\DateTime $last_changed_pass) findByLastChangedPass(string $last_changed_pass) find objects in database by last_changed_pass
 * @method static \Users findOneByLastChangedPass(\Flywheel\Db\Type\DateTime $last_changed_pass) findOneByLastChangedPass(string $last_changed_pass) find object in database by last_changed_pass
 * @method static \Users retrieveByLastChangedPass(\Flywheel\Db\Type\DateTime $last_changed_pass) retrieveByLastChangedPass(string $last_changed_pass) retrieve object from poll by last_changed_pass, get it from db if not exist in poll

 * @method void setHasDepositedOrder(integer $has_deposited_order) set has_deposited_order value
 * @method integer getHasDepositedOrder() get has_deposited_order value
 * @method static \Users[] findByHasDepositedOrder(integer $has_deposited_order) find objects in database by has_deposited_order
 * @method static \Users findOneByHasDepositedOrder(integer $has_deposited_order) find object in database by has_deposited_order
 * @method static \Users retrieveByHasDepositedOrder(integer $has_deposited_order) retrieve object from poll by has_deposited_order, get it from db if not exist in poll

 * @method void setHasOrder(integer $has_order) set has_order value
 * @method integer getHasOrder() get has_order value
 * @method static \Users[] findByHasOrder(integer $has_order) find objects in database by has_order
 * @method static \Users findOneByHasOrder(integer $has_order) find object in database by has_order
 * @method static \Users retrieveByHasOrder(integer $has_order) retrieve object from poll by has_order, get it from db if not exist in poll

 * @method void setHasReceivedOrder(integer $has_received_order) set has_received_order value
 * @method integer getHasReceivedOrder() get has_received_order value
 * @method static \Users[] findByHasReceivedOrder(integer $has_received_order) find objects in database by has_received_order
 * @method static \Users findOneByHasReceivedOrder(integer $has_received_order) find object in database by has_received_order
 * @method static \Users retrieveByHasReceivedOrder(integer $has_received_order) retrieve object from poll by has_received_order, get it from db if not exist in poll

 * @method void setLastLoginTime(\Flywheel\Db\Type\DateTime $last_login_time) setLastLoginTime(string $last_login_time) set last_login_time value
 * @method \Flywheel\Db\Type\DateTime getLastLoginTime() get last_login_time value
 * @method static \Users[] findByLastLoginTime(\Flywheel\Db\Type\DateTime $last_login_time) findByLastLoginTime(string $last_login_time) find objects in database by last_login_time
 * @method static \Users findOneByLastLoginTime(\Flywheel\Db\Type\DateTime $last_login_time) findOneByLastLoginTime(string $last_login_time) find object in database by last_login_time
 * @method static \Users retrieveByLastLoginTime(\Flywheel\Db\Type\DateTime $last_login_time) retrieveByLastLoginTime(string $last_login_time) retrieve object from poll by last_login_time, get it from db if not exist in poll

 * @method void setVersion(string $version) set version value
 * @method string getVersion() get version value
 * @method static \Users[] findByVersion(string $version) find objects in database by version
 * @method static \Users findOneByVersion(string $version) find object in database by version
 * @method static \Users retrieveByVersion(string $version) retrieve object from poll by version, get it from db if not exist in poll

 * @method void setModifiedTime(\Flywheel\Db\Type\DateTime $modified_time) setModifiedTime(string $modified_time) set modified_time value
 * @method \Flywheel\Db\Type\DateTime getModifiedTime() get modified_time value
 * @method static \Users[] findByModifiedTime(\Flywheel\Db\Type\DateTime $modified_time) findByModifiedTime(string $modified_time) find objects in database by modified_time
 * @method static \Users findOneByModifiedTime(\Flywheel\Db\Type\DateTime $modified_time) findOneByModifiedTime(string $modified_time) find object in database by modified_time
 * @method static \Users retrieveByModifiedTime(\Flywheel\Db\Type\DateTime $modified_time) retrieveByModifiedTime(string $modified_time) retrieve object from poll by modified_time, get it from db if not exist in poll

 * @method void setJoinedTime(\Flywheel\Db\Type\DateTime $joined_time) setJoinedTime(string $joined_time) set joined_time value
 * @method \Flywheel\Db\Type\DateTime getJoinedTime() get joined_time value
 * @method static \Users[] findByJoinedTime(\Flywheel\Db\Type\DateTime $joined_time) findByJoinedTime(string $joined_time) find objects in database by joined_time
 * @method static \Users findOneByJoinedTime(\Flywheel\Db\Type\DateTime $joined_time) findOneByJoinedTime(string $joined_time) find object in database by joined_time
 * @method static \Users retrieveByJoinedTime(\Flywheel\Db\Type\DateTime $joined_time) retrieveByJoinedTime(string $joined_time) retrieve object from poll by joined_time, get it from db if not exist in poll


 */
abstract class UsersBase extends ActiveRecord {
    protected static $_tableName = 'users';
    protected static $_phpName = 'Users';
    protected static $_pk = 'id';
    protected static $_alias = 'u';
    protected static $_dbConnectName = 'users';
    protected static $_instances = array();
    protected static $_schema = array(
        'id' => array('name' => 'id',
                'not_null' => true,
                'type' => 'integer',
                'primary' => true,
                'auto_increment' => true,
                'db_type' => 'int(11) unsigned',
                'length' => 4),
        'username' => array('name' => 'username',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'varchar(100)',
                'length' => 100),
        'code' => array('name' => 'code',
                'not_null' => false,
                'type' => 'string',
                'db_type' => 'char(8)',
                'length' => 8),
        'account_no' => array('name' => 'account_no',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'char(16)',
                'length' => 16),
        'account_balance' => array('name' => 'account_balance',
                'default' => 0,
                'not_null' => true,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'int(11)',
                'length' => 4),
        'payment_pass' => array('name' => 'payment_pass',
                'not_null' => false,
                'type' => 'string',
                'db_type' => 'char(72)',
                'length' => 72),
        'section' => array('name' => 'section',
                'default' => 'CUSTOMER',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'enum(\'CUSTOMER\',\'CRANE\')',
                'length' => 8),
        'status' => array('name' => 'status',
                'default' => 'INACTIVE',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'enum(\'ACTIVE\',\'INACTIVE\',\'BAN\',\'LOCK\',\'DELETE\')',
                'length' => 8),
        'email' => array('name' => 'email',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'varchar(100)',
                'length' => 100),
        'password' => array('name' => 'password',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'char(72)',
                'length' => 72),
        'secret_key' => array('name' => 'secret_key',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'char(32)',
                'length' => 32),
        'avatar' => array('name' => 'avatar',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'varchar(255)',
                'length' => 255),
        'verify_email' => array('name' => 'verify_email',
                'default' => 0,
                'not_null' => true,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'tinyint(1)',
                'length' => 1),
        'verify_mobile' => array('name' => 'verify_mobile',
                'default' => 0,
                'not_null' => true,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'tinyint(1)',
                'length' => 1),
        'nationality' => array('name' => 'nationality',
                'default' => 'VIETNAM',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'enum(\'VIETNAM\',\'CHINESE\')',
                'length' => 7),
        'detail_address' => array('name' => 'detail_address',
                'not_null' => false,
                'type' => 'string',
                'db_type' => 'text'),
        'tt_id' => array('name' => 'tt_id',
                'not_null' => false,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'int(11)',
                'length' => 4),
        'tt_address' => array('name' => 'tt_address',
                'not_null' => false,
                'type' => 'string',
                'db_type' => 'text'),
        'qh_id' => array('name' => 'qh_id',
                'not_null' => false,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'int(11)',
                'length' => 4),
        'qh_address' => array('name' => 'qh_address',
                'not_null' => false,
                'type' => 'string',
                'db_type' => 'text'),
        'first_name' => array('name' => 'first_name',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'varchar(50)',
                'length' => 50),
        'last_name' => array('name' => 'last_name',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'varchar(50)',
                'length' => 50),
        'gender' => array('name' => 'gender',
                'not_null' => true,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'tinyint(1)',
                'length' => 1),
        'birthday' => array('name' => 'birthday',
                'not_null' => true,
                'type' => 'date',
                'db_type' => 'date'),
        'last_login_ip' => array('name' => 'last_login_ip',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'varchar(100)',
                'length' => 100),
        'facebook_id' => array('name' => 'facebook_id',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'varchar(100)',
                'length' => 100),
        'point_member' => array('name' => 'point_member',
                'default' => 0,
                'not_null' => true,
                'type' => 'number',
                'auto_increment' => false,
                'db_type' => 'double'),
        'level_id' => array('name' => 'level_id',
                'default' => 1,
                'not_null' => true,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'int(11)',
                'length' => 4),
        'last_changed_pass' => array('name' => 'last_changed_pass',
                'default' => '0000-00-00 00:00:00',
                'not_null' => true,
                'type' => 'datetime',
                'db_type' => 'datetime'),
        'has_deposited_order' => array('name' => 'has_deposited_order',
                'default' => 0,
                'not_null' => true,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'tinyint(1)',
                'length' => 1),
        'has_order' => array('name' => 'has_order',
                'default' => 0,
                'not_null' => true,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'tinyint(1)',
                'length' => 1),
        'has_received_order' => array('name' => 'has_received_order',
                'default' => 0,
                'not_null' => true,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'tinyint(1)',
                'length' => 1),
        'last_login_time' => array('name' => 'last_login_time',
                'not_null' => true,
                'type' => 'datetime',
                'db_type' => 'datetime'),
        'version' => array('name' => 'version',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'varchar(50)',
                'length' => 50),
        'modified_time' => array('name' => 'modified_time',
                'not_null' => true,
                'type' => 'datetime',
                'db_type' => 'datetime'),
        'joined_time' => array('name' => 'joined_time',
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
        'section' => array(
            array('name' => 'ValidValues',
                'value' => 'CUSTOMER|CRANE',
                'message'=> 'section\'s values is not allowed'
            ),
        ),
        'status' => array(
            array('name' => 'ValidValues',
                'value' => 'ACTIVE|INACTIVE|BAN|LOCK|DELETE',
                'message'=> 'status\'s values is not allowed'
            ),
        ),
        'nationality' => array(
            array('name' => 'ValidValues',
                'value' => 'VIETNAM|CHINESE',
                'message'=> 'nationality\'s values is not allowed'
            ),
        ),
    );
    protected static $_validatorRules = array(
        'username' => array(
            array('name' => 'Unique',
                'message'=> 'username\'s was used'
            ),
        ),
        'section' => array(
            array('name' => 'ValidValues',
                'value' => 'CUSTOMER|CRANE',
                'message'=> 'section\'s values is not allowed'
            ),
        ),
        'status' => array(
            array('name' => 'ValidValues',
                'value' => 'ACTIVE|INACTIVE|BAN|LOCK|DELETE',
                'message'=> 'status\'s values is not allowed'
            ),
        ),
        'nationality' => array(
            array('name' => 'ValidValues',
                'value' => 'VIETNAM|CHINESE',
                'message'=> 'nationality\'s values is not allowed'
            ),
        ),
    );
    protected static $_init = false;
    protected static $_cols = array('id','username','code','account_no','account_balance','payment_pass','section','status','email','password','secret_key','avatar','verify_email','verify_mobile','nationality','detail_address','tt_id','tt_address','qh_id','qh_address','first_name','last_name','gender','birthday','last_login_ip','facebook_id','point_member','level_id','last_changed_pass','has_deposited_order','has_order','has_received_order','last_login_time','version','modified_time','joined_time');

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