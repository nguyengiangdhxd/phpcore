<?php 
use Flywheel\Db\Manager;
use Flywheel\Model\ActiveRecord;
/**.
 * CustomerSettings
 * @version		$Id$
 * @package		Model

 * @property integer $id id primary auto_increment type : int(11)
 * @property integer $customer_id customer_id type : int(11)
 * @property string $name name type : varchar(50) max_length : 50
 * @property string $value value type : varchar(100) max_length : 100
 * @property integer $type type type : int(11)

 * @method void setId(integer $id) set id value
 * @method integer getId() get id value
 * @method static \CustomerSettings[] findById(integer $id) find objects in database by id
 * @method static \CustomerSettings findOneById(integer $id) find object in database by id
 * @method static \CustomerSettings retrieveById(integer $id) retrieve object from poll by id, get it from db if not exist in poll

 * @method void setCustomerId(integer $customer_id) set customer_id value
 * @method integer getCustomerId() get customer_id value
 * @method static \CustomerSettings[] findByCustomerId(integer $customer_id) find objects in database by customer_id
 * @method static \CustomerSettings findOneByCustomerId(integer $customer_id) find object in database by customer_id
 * @method static \CustomerSettings retrieveByCustomerId(integer $customer_id) retrieve object from poll by customer_id, get it from db if not exist in poll

 * @method void setName(string $name) set name value
 * @method string getName() get name value
 * @method static \CustomerSettings[] findByName(string $name) find objects in database by name
 * @method static \CustomerSettings findOneByName(string $name) find object in database by name
 * @method static \CustomerSettings retrieveByName(string $name) retrieve object from poll by name, get it from db if not exist in poll

 * @method void setValue(string $value) set value value
 * @method string getValue() get value value
 * @method static \CustomerSettings[] findByValue(string $value) find objects in database by value
 * @method static \CustomerSettings findOneByValue(string $value) find object in database by value
 * @method static \CustomerSettings retrieveByValue(string $value) retrieve object from poll by value, get it from db if not exist in poll

 * @method void setType(integer $type) set type value
 * @method integer getType() get type value
 * @method static \CustomerSettings[] findByType(integer $type) find objects in database by type
 * @method static \CustomerSettings findOneByType(integer $type) find object in database by type
 * @method static \CustomerSettings retrieveByType(integer $type) retrieve object from poll by type, get it from db if not exist in poll


 */
abstract class CustomerSettingsBase extends ActiveRecord {
    protected static $_tableName = 'customer_settings';
    protected static $_phpName = 'CustomerSettings';
    protected static $_pk = 'id';
    protected static $_alias = 'c';
    protected static $_dbConnectName = 'customer_settings';
    protected static $_instances = array();
    protected static $_schema = array(
        'id' => array('name' => 'id',
                'not_null' => true,
                'type' => 'integer',
                'primary' => true,
                'auto_increment' => true,
                'db_type' => 'int(11)',
                'length' => 4),
        'customer_id' => array('name' => 'customer_id',
                'not_null' => true,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'int(11)',
                'length' => 4),
        'name' => array('name' => 'name',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'varchar(50)',
                'length' => 50),
        'value' => array('name' => 'value',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'varchar(100)',
                'length' => 100),
        'type' => array('name' => 'type',
                'not_null' => true,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'int(11)',
                'length' => 4),
     );
    protected static $_validate = array(
    );
    protected static $_validatorRules = array(
    );
    protected static $_init = false;
    protected static $_cols = array('id','customer_id','name','value','type');

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