<?php

namespace SysAction;
use mongodb\ConnectMongoDB;
use ReflectionClass;
use Users;

class Action extends \stdClass {

    #region -- STATIC --
    private static $_queue;
    #endregion

    #region -- PRIVATE --
    protected $_actionName;

    protected $_actionBy;

    protected $_actionTime;

    protected $_object;

    protected $_objectType;

    protected $_objectData;

    protected $_context;

    protected $_changes;

    protected $_actualObject;
    #endregion

    #region -- GET/SET --
    /**
     * @param int $actionBy
     * @return $this
     */
    public function setActionBy($actionBy)
    {
        $this->_actionBy = $actionBy;
        return $this;
    }

    /**
     * @return int
     */
    public function getActionBy()
    {
        return $this->_actionBy;
    }

    /**
     * @return bool|Users
     */
    public function getActionByUser()
    {
        if ($this->_actionBy > 0)
        {
            return \Users::retrieveById($this->_actionBy);
        }
        return false;
    }

    /**
     * @param string $actionName
     * @return $this
     */
    public function setActionName($actionName)
    {
        $this->_actionName = $actionName;
        return $this;
    }

    /**
     * @return string
     */
    public function getActionName()
    {
        return $this->_actionName;
    }

    /**
     * @param \DateTime|int $actionTime
     * @return $this
     */
    public function setActionTime($actionTime)
    {
        if (!$actionTime instanceof \DateTime)
        {
            $now = new \DateTime();
            $now->setTimestamp($actionTime);
            $actionTime = $now;
        }
        $this->_actionTime = $actionTime;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getActionTime()
    {
        return $this->_actionTime;
    }

    /**
     * Danh sách thay đổi với object, khuyến cáo dùng addChange
     * @param DataChange[] $changes
     * @return $this
     */
    public function setChanges($changes = [])
    {
        $this->_changes = $changes;
        return $this;
    }

    /**
     * @return DataChange[]
     */
    public function getChanges()
    {
        return $this->_changes;
    }

    /**
     * Thêm một thay đổi của object vào action, khuyến cáo dùng hàm này thay vì set changes
     * @param $name
     * @param DataChange $change
     * @return $this
     */
    public function addChange($name, DataChange $change)
    {
        if (!is_array($this->_changes))
        {
            $this->_changes = [];
        }
        $this->_changes[$name] = $change;

        return $this;
    }

    /**
     * Thêm một thay đổi của object vào action
     * @param $name
     * @param $old
     * @param $new
     */
    public function addDataChange($name, $old, $new)
    {
        $change = new DataChange();
        $change->from = $old;
        $change->to = $new;

        $this->addChange($name, $change);
    }

    /**
     * @param $field
     * @return mixed
     */
    public function getValueChangeTo($field)
    {
        $changes = $this->getChanges();
        if (array_key_exists($field,$changes))
        {
            if (isset($changes[$field]->to))
                return $changes[$field]->to;
        }
        return null;
    }

    /**
     * @param $field
     * @return mixed
     */
    public function getValueChangeFrom($field)
    {
        $changes = $this->getChanges();
        if (array_key_exists($field,$changes))
        {
            if (isset($changes[$field]->from))
                return $changes[$field]->from;
        }
        return null;
    }

    /**
     * @param array $context
     * @return $this
     */
    public function setContext($context = [])
    {
        $this->_context = $context;
        return $this;
    }

    /**
     * @return array
     */
    public function getContext()
    {
        return $this->_context;
    }

    public function getContextValue($key)
    {
        if (is_array($this->_context))
        {
            if (isset($this->_context[$key]))
            {
                return $this->_context[$key];
            }
        }
        return null;
    }

    /**
     * Đặt giá trị cho context theo key/value
     * @param $key
     * @param $value
     * @return $this
     */
    public function setContextValue($key, $value)
    {
        $this->_context[$key] = $value;
        return $this;
    }

    /**
     * @param mixed $object
     * @return $this
     */
    public function setObject($object)
    {
        if (is_object($object) && is_callable([$object, 'getId']))
        {
            $this->_object = $object->getId();
            if ($this->_object instanceof \MongoId)
            {
                $this->_object = $this->_object->{'$id'};
            }
            $this->_objectType = get_class($object);
        }
        else
        {
            $this->_object = $object;
        }
        return $this;
    }

    /**
     * @return mixed
     */
    public function getObject()
    {
        return $this->_object;
    }

    /**
     * @param string $objectType
     * @return $this
     */
    public function setObjectType($objectType)
    {
        $this->_objectType = $objectType;
        return $this;
    }

    /**
     * @return string
     */
    public function getObjectType()
    {
        return $this->_objectType;
    }

    /**
     * @param mixed $objectData
     */
    public function setObjectData($objectData)
    {
        $this->_objectData = $objectData;
    }

    /**
     * @return mixed
     */
    public function getObjectData()
    {
        return $this->_objectData;
    }
    #region -- Special --
    /**
     * Trả về object thực sự của action, tạm thời chỉ hỗ trợ ActiveRecord
     * @return \Flywheel\Model\ActiveRecord|\Mandango\Document\Document
     */
    public function getActualObject()
    {
        if (isset($this->_actualObject))
        {
            return $this->_actualObject;
        }

        if (!empty($this->_objectType))
        {
            $reflector = new ReflectionClass($this->_objectType);
            if ($reflector->isSubclassOf('Flywheel\Model\ActiveRecord'))
            {
                #region -- get data from queue --
                // nếu có thể lấy fill data theo hướng fromArray thì sử dụng hướng này
                if (!empty($this->_objectData))
                {
                    if (is_string($this->_objectData))
                    {
                        $data = json_decode($this->_objectData, true);
                    }
                    else {
                        $data = $this->_objectData;
                    }
                    $instance = $reflector->newInstance();
                    $instance->hydrate($data);
                    $this->_actualObject = $instance;
                    return $this->_actualObject;
                }
                #endregion

                #region -- retrieve by id --
                $method = $this->_objectType.'::retrieveById';
                if (is_callable($method))
                {
                    $this->_actualObject = call_user_func_array($method, [$this->_object]);
                    return $this->_actualObject;
                }
                #endregion
            }

            if ($reflector->isSubclassOf('Mandango\Document\Document'))
            {
                #region -- get by id (data from queue is not available at the moment)
                $mandango = ConnectMongoDB::getConnection();
                $repo_class = $this->_objectType.'Repository';

                $repo_reflector = new ReflectionClass($repo_class);
                /** @var \Mandango\Repository $repo */
                $repo = $repo_reflector->newInstanceArgs([$mandango]);
                $this->_actualObject = $repo->findOneById($this->_object);
                return $this->_actualObject;

                #endregion
            }
        }

        return null;
    }
    #endregion

    #endregion

    #region -- SERIALIZE METHODS --
    /**
     * stringify object's properties
     *
     * @return string
     */
    public function toJson() {
        return json_encode($this->toArray());
    }

    /**
     * @return array
     */
    public function toArray() {
        $array = [];
        $array['actionName'] = $this->_actionName;
        $array['actionBy'] = $this->_actionBy;
        if ($this->_actionTime instanceof \DateTime)
        {
            $array['actionTime'] = $this->_actionTime->format('y-m-d H:i:s');
        }
        $array['object'] = $this->_object;
        $array['objectType'] = $this->_objectType;
        $array['context'] = $this->_context;
        $array['changes'] = $this->_changes;

        $array['actionClass'] = get_class($this);

        return $array;
    }

    /**
     * @param array $data
     * @return Action
     */
    public static function fromArray($data)
    {
        $class = $data['actionClass'];
        $action = new $class($data['object'], $data['actionName'], $data['actionBy']);
        if (!$action instanceof Action)
        {
            $action = new Action($data['object'], $data['actionName'], $data['actionBy']);
        }
        $action->setActionTime(new \DateTime($data['actionTime']));
        $action->setObjectType($data['objectType']);
        $action->setContext($data['context']);
        //$action->setChanges($data['changes']);

        $changes = $data['changes'];

        if (is_array($changes) && !empty($changes))
        {
            foreach ($changes as $k => $change)
            {
                $temp = new DataChange();
                $temp->from = $change['from'];
                $temp->to = $change['to'];
                $action->addChange($k, $temp);
            }
        }

        return $action;
    }
    #endregion

    #region -- CONSTRUCTORS --
    /**
     * @param $object
     * @param $actionName
     * @param int $actionBy
     */
    public function __construct($object, $actionName, $actionBy = 0)
    {
        $this->setObject($object);
        $this->_changes = [];
        $this->_context = [];
        $this->_actionName = $actionName;
        $this->_actionBy = $actionBy;
        $this->_actionTime = new \DateTime();
    }
    #endregion

    #region -- QUEUE --
    public function addToQueue()
    {
        if (!isset(self::$_queue))
        {
            self::$_queue = Queue::getActionQueue();
        }

        self::$_queue->push($this->toJson());
    }

    /**
     * Tạo ra action và đẩy trực tiếp vào queue
     * @param $object
     * @param $actionName
     * @param int $actionBy
     * @return static
     */
    public static function pushAction($object, $actionName, $actionBy = 0)
    {
        /** @var Action $action */
        $action = new static($object, $actionName, $actionBy);
        $action->addtoQueue();

        return $action;
    }
    #endregion
}