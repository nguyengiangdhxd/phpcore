<?php

namespace Comment;

use Comment\Context\Activity;
use Comment\Context\IContext;
use Comment\Context\Logging;
use Mandango\Mandango;
use mongodb\ConnectMongoDB;

class Comment {
    /** @var Mandango */
    protected $_dataStore;
    protected $_modelClass = 'Mongodb\\Comment';
    protected $_attributes = [];

    public function __construct() {
        $this->setDataStore(ConnectMongoDB::getConnection());
    }

    protected function setDataStore($ds) {
        $this->_dataStore = $ds;
    }

    /**
     * @return Mandango
     */
    public function getDataStore() {
        return $this->_dataStore;
    }

    /**
     * @return \Mandango\Repository
     */
    public function repository() {
        return $this->getDataStore()
            ->getRepository($this->_modelClass);
    }

    /**
     * @return \Mandango\Query
     */
    public function query() {
        return $this->getDataStore()
            ->getRepository($this->_modelClass)
            ->createQuery();
    }

    /**
     * @param $object
     */
    public function hydrate($object) {
        if (is_object($object)) {
            $object = get_object_vars($object);
        }

        if (is_array($object)) {
            foreach($object as $k=>$v) {
                $this->$k = $v;
            }
        }
    }

    /**
     * @param IContext $context
     */
    public function setContext(IContext $context) {
        $this->_attributes['context'] = $context;
    }

    /**
     * @return \Comment\Context\IContext
     */
    public function getContext() {
        return $this->_attributes['context'];
    }

    public function save() {
        $dataStore = $this->getDataStore();
        /** @var \Mongodb\Comment $model */
        $model = $dataStore->create($this->_modelClass);

        if ($model->isNew()) {
            $model->setCreatedTime(new \DateTime());
        }

        foreach($this->_attributes as $attr => $value) {
            if ($attr != 'context') {
                $method = 'set' .ucfirst($attr);
                $model->$method($value);
            } else {
                $model->setContext($value->toArray());
            }
        }

        $model->setContextType($this->getContext()->getType());

        $model->save();
    }

    /******************* UTIL METHOD ***********************/

    /**
     * @param $creator
     * @param $act
     * @param $actDesc
     * @param $object
     * @param null $objectId
     * @param array $context
     * @return Comment
     */
    public static function createActivity($creator, $act, $actDesc, $object, $objectId = null, $context = []) {
        if ($creator instanceof \Users) {
            $creator = $creator->getId();
        }

        $comment = new static();
        $comment->createdBy = $creator;
        $comment->object = $object;
        $comment->objectId = $objectId;

        $commentContext = new Activity();
        $commentContext->act = $act;
        $actDesc = str_replace('  ',' ', $actDesc);
        $commentContext->actDesc = $actDesc;
        if (!empty($context) && is_array($context)) {
            foreach($context as $c=>$v) {
                $commentContext->$c = $v;
            }
        }
        $comment->setContext($commentContext);

        $comment->save();
        return $comment;
    }

    /**
     * @param $act
     * @param $actDesc
     * @param $object
     * @param null $objectId
     * @param array $context
     * @return Comment
     */
    public static function createLog($act, $actDesc, $object, $objectId = null, $context = []) {
        $comment = new static();
        $comment->object = $object;
        $comment->objectId = $objectId;

        $commentContext = new Logging();
        $commentContext->act = $act;
        $actDesc = str_replace('  ',' ', $actDesc);
        $actDesc = trim($actDesc);
        $commentContext->actDesc = ucfirst($actDesc);
        if (!empty($context) && is_array($context)) {
            foreach($context as $c=>$v) {
                $commentContext->$c = $v;
            }
        }
        $comment->setContext($commentContext);

        $comment->save();
        return $comment;
    }

    /******************* MAGIC METHODS ***********************/
    public function __set($name, $value) {
        $this->_attributes[$name] = $value;
    }

    public function __get($name) {
        return ($this->_attributes[$name])
            ? $this->_attributes[$name] : null;
    }
} 