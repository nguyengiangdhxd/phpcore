<?php

namespace Mongodb\Base;

/**
 * Base class of Mongodb\PFUploadLog document.
 */
abstract class PFUploadLog extends \Mandango\Document\Document implements \ArrayAccess
{
    /**
     * Initializes the document defaults.
     */
    public function initializeDefaults()
    {
    }

    /**
     * Set the document data (hydrate).
     *
     * @param array $data  The document data.
     * @param bool  $clean Whether clean the document.
     *
     * @return \Mongodb\PFUploadLog The document (fluent interface).
     */
    public function setDocumentData($data, $clean = false)
    {
        if ($clean) {
            $this->data = array();
            $this->fieldsModified = array();
        }

        if (isset($data['_query_hash'])) {
            $this->addQueryHash($data['_query_hash']);
        }
        if (isset($data['_id'])) {
            $this->setId($data['_id']);
            $this->setIsNew(false);
        }
        if (isset($data['uploader'])) {
            $this->data['fields']['uploader'] = (int) $data['uploader'];
        } elseif (isset($data['_fields']['uploader'])) {
            $this->data['fields']['uploader'] = null;
        }
        if (isset($data['message'])) {
            $this->data['fields']['message'] = (string) $data['message'];
        } elseif (isset($data['_fields']['message'])) {
            $this->data['fields']['message'] = null;
        }
        if (isset($data['type'])) {
            $this->data['fields']['type'] = (string) $data['type'];
        } elseif (isset($data['_fields']['type'])) {
            $this->data['fields']['type'] = null;
        }
        if (isset($data['objectId'])) {
            $this->data['fields']['objectId'] = (string) $data['objectId'];
        } elseif (isset($data['_fields']['objectId'])) {
            $this->data['fields']['objectId'] = null;
        }
        if (isset($data['logDate'])) {
            $this->data['fields']['logDate'] = new \DateTime(); $this->data['fields']['logDate']->setTimestamp($data['logDate']->sec);
        } elseif (isset($data['_fields']['logDate'])) {
            $this->data['fields']['logDate'] = null;
        }

        return $this;
    }

    /**
     * Set the "uploader" field.
     *
     * @param mixed $value The value.
     *
     * @return \Mongodb\PFUploadLog The document (fluent interface).
     */
    public function setUploader($value)
    {
        if (!isset($this->data['fields']['uploader'])) {
            if (!$this->isNew()) {
                $this->getUploader();
                if ($this->isFieldEqualTo('uploader', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['uploader'] = null;
                $this->data['fields']['uploader'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('uploader', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['uploader']) && !array_key_exists('uploader', $this->fieldsModified)) {
            $this->fieldsModified['uploader'] = $this->data['fields']['uploader'];
        } elseif ($this->isFieldModifiedEqualTo('uploader', $value)) {
            unset($this->fieldsModified['uploader']);
        }

        $this->data['fields']['uploader'] = $value;

        return $this;
    }

    /**
     * Returns the "uploader" field.
     *
     * @return mixed The $name field.
     */
    public function getUploader()
    {
        if (!isset($this->data['fields']['uploader'])) {
            if ($this->isNew()) {
                $this->data['fields']['uploader'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('uploader', $this->data['fields'])) {
                $this->addFieldCache('uploader');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('uploader' => 1));
                if (isset($data['uploader'])) {
                    $this->data['fields']['uploader'] = (int) $data['uploader'];
                } else {
                    $this->data['fields']['uploader'] = null;
                }
            }
        }

        return $this->data['fields']['uploader'];
    }

    /**
     * Set the "message" field.
     *
     * @param mixed $value The value.
     *
     * @return \Mongodb\PFUploadLog The document (fluent interface).
     */
    public function setMessage($value)
    {
        if (!isset($this->data['fields']['message'])) {
            if (!$this->isNew()) {
                $this->getMessage();
                if ($this->isFieldEqualTo('message', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['message'] = null;
                $this->data['fields']['message'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('message', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['message']) && !array_key_exists('message', $this->fieldsModified)) {
            $this->fieldsModified['message'] = $this->data['fields']['message'];
        } elseif ($this->isFieldModifiedEqualTo('message', $value)) {
            unset($this->fieldsModified['message']);
        }

        $this->data['fields']['message'] = $value;

        return $this;
    }

    /**
     * Returns the "message" field.
     *
     * @return mixed The $name field.
     */
    public function getMessage()
    {
        if (!isset($this->data['fields']['message'])) {
            if ($this->isNew()) {
                $this->data['fields']['message'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('message', $this->data['fields'])) {
                $this->addFieldCache('message');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('message' => 1));
                if (isset($data['message'])) {
                    $this->data['fields']['message'] = (string) $data['message'];
                } else {
                    $this->data['fields']['message'] = null;
                }
            }
        }

        return $this->data['fields']['message'];
    }

    /**
     * Set the "type" field.
     *
     * @param mixed $value The value.
     *
     * @return \Mongodb\PFUploadLog The document (fluent interface).
     */
    public function setType($value)
    {
        if (!isset($this->data['fields']['type'])) {
            if (!$this->isNew()) {
                $this->getType();
                if ($this->isFieldEqualTo('type', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['type'] = null;
                $this->data['fields']['type'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('type', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['type']) && !array_key_exists('type', $this->fieldsModified)) {
            $this->fieldsModified['type'] = $this->data['fields']['type'];
        } elseif ($this->isFieldModifiedEqualTo('type', $value)) {
            unset($this->fieldsModified['type']);
        }

        $this->data['fields']['type'] = $value;

        return $this;
    }

    /**
     * Returns the "type" field.
     *
     * @return mixed The $name field.
     */
    public function getType()
    {
        if (!isset($this->data['fields']['type'])) {
            if ($this->isNew()) {
                $this->data['fields']['type'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('type', $this->data['fields'])) {
                $this->addFieldCache('type');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('type' => 1));
                if (isset($data['type'])) {
                    $this->data['fields']['type'] = (string) $data['type'];
                } else {
                    $this->data['fields']['type'] = null;
                }
            }
        }

        return $this->data['fields']['type'];
    }

    /**
     * Set the "objectId" field.
     *
     * @param mixed $value The value.
     *
     * @return \Mongodb\PFUploadLog The document (fluent interface).
     */
    public function setObjectId($value)
    {
        if (!isset($this->data['fields']['objectId'])) {
            if (!$this->isNew()) {
                $this->getObjectId();
                if ($this->isFieldEqualTo('objectId', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['objectId'] = null;
                $this->data['fields']['objectId'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('objectId', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['objectId']) && !array_key_exists('objectId', $this->fieldsModified)) {
            $this->fieldsModified['objectId'] = $this->data['fields']['objectId'];
        } elseif ($this->isFieldModifiedEqualTo('objectId', $value)) {
            unset($this->fieldsModified['objectId']);
        }

        $this->data['fields']['objectId'] = $value;

        return $this;
    }

    /**
     * Returns the "objectId" field.
     *
     * @return mixed The $name field.
     */
    public function getObjectId()
    {
        if (!isset($this->data['fields']['objectId'])) {
            if ($this->isNew()) {
                $this->data['fields']['objectId'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('objectId', $this->data['fields'])) {
                $this->addFieldCache('objectId');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('objectId' => 1));
                if (isset($data['objectId'])) {
                    $this->data['fields']['objectId'] = (string) $data['objectId'];
                } else {
                    $this->data['fields']['objectId'] = null;
                }
            }
        }

        return $this->data['fields']['objectId'];
    }

    /**
     * Set the "logDate" field.
     *
     * @param mixed $value The value.
     *
     * @return \Mongodb\PFUploadLog The document (fluent interface).
     */
    public function setLogDate($value)
    {
        if (!isset($this->data['fields']['logDate'])) {
            if (!$this->isNew()) {
                $this->getLogDate();
                if ($this->isFieldEqualTo('logDate', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['logDate'] = null;
                $this->data['fields']['logDate'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('logDate', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['logDate']) && !array_key_exists('logDate', $this->fieldsModified)) {
            $this->fieldsModified['logDate'] = $this->data['fields']['logDate'];
        } elseif ($this->isFieldModifiedEqualTo('logDate', $value)) {
            unset($this->fieldsModified['logDate']);
        }

        $this->data['fields']['logDate'] = $value;

        return $this;
    }

    /**
     * Returns the "logDate" field.
     *
     * @return mixed The $name field.
     */
    public function getLogDate()
    {
        if (!isset($this->data['fields']['logDate'])) {
            if ($this->isNew()) {
                $this->data['fields']['logDate'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('logDate', $this->data['fields'])) {
                $this->addFieldCache('logDate');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('logDate' => 1));
                if (isset($data['logDate'])) {
                    $this->data['fields']['logDate'] = new \DateTime(); $this->data['fields']['logDate']->setTimestamp($data['logDate']->sec);
                } else {
                    $this->data['fields']['logDate'] = null;
                }
            }
        }

        return $this->data['fields']['logDate'];
    }

    private function isFieldEqualTo($field, $otherValue)
    {
        $value = $this->data['fields'][$field];

        return $this->isFieldValueEqualTo($value, $otherValue);
    }

    private function isFieldModifiedEqualTo($field, $otherValue)
    {
        $value = $this->fieldsModified[$field];

        return $this->isFieldValueEqualTo($value, $otherValue);
    }

    protected function isFieldValueEqualTo($value, $otherValue)
    {
        if (is_object($value)) {
            return $value == $otherValue;
        }

        return $value === $otherValue;
    }

    /**
     * Process onDelete.
     */
    public function processOnDelete()
    {
    }

    private function processOnDeleteCascade($class, array $criteria)
    {
        $repository = $this->getMandango()->getRepository($class);
        $documents = $repository->createQuery($criteria)->all();
        if (count($documents)) {
            $repository->delete($documents);
        }
    }

    private function processOnDeleteUnset($class, array $criteria, array $update)
    {
        $this->getMandango()->getRepository($class)->update($criteria, $update, array('multiple' => true));
    }

    /**
     * Set a document data value by data name as string.
     *
     * @param string $name  The data name.
     * @param mixed  $value The value.
     *
     * @return mixed the data name setter return value.
     *
     * @throws \InvalidArgumentException If the data name is not valid.
     */
    public function set($name, $value)
    {
        if ('uploader' == $name) {
            return $this->setUploader($value);
        }
        if ('message' == $name) {
            return $this->setMessage($value);
        }
        if ('type' == $name) {
            return $this->setType($value);
        }
        if ('objectId' == $name) {
            return $this->setObjectId($value);
        }
        if ('logDate' == $name) {
            return $this->setLogDate($value);
        }

        throw new \InvalidArgumentException(sprintf('The document data "%s" is not valid.', $name));
    }

    /**
     * Returns a document data by data name as string.
     *
     * @param string $name The data name.
     *
     * @return mixed The data name getter return value.
     *
     * @throws \InvalidArgumentException If the data name is not valid.
     */
    public function get($name)
    {
        if ('uploader' == $name) {
            return $this->getUploader();
        }
        if ('message' == $name) {
            return $this->getMessage();
        }
        if ('type' == $name) {
            return $this->getType();
        }
        if ('objectId' == $name) {
            return $this->getObjectId();
        }
        if ('logDate' == $name) {
            return $this->getLogDate();
        }

        throw new \InvalidArgumentException(sprintf('The document data "%s" is not valid.', $name));
    }

    /**
     * Imports data from an array.
     *
     * @param array $array An array.
     *
     * @return \Mongodb\PFUploadLog The document (fluent interface).
     */
    public function fromArray(array $array)
    {
        if (isset($array['id'])) {
            $this->setId($array['id']);
        }
        if (isset($array['uploader'])) {
            $this->setUploader($array['uploader']);
        }
        if (isset($array['message'])) {
            $this->setMessage($array['message']);
        }
        if (isset($array['type'])) {
            $this->setType($array['type']);
        }
        if (isset($array['objectId'])) {
            $this->setObjectId($array['objectId']);
        }
        if (isset($array['logDate'])) {
            $this->setLogDate($array['logDate']);
        }

        return $this;
    }

    /**
     * Export the document data to an array.
     *
     * @param Boolean $withReferenceFields Whether include the fields of references or not (false by default).
     *
     * @return array An array with the document data.
     */
    public function toArray($withReferenceFields = false)
    {
        $array = array('id' => $this->getId());

        $array['uploader'] = $this->getUploader();
        $array['message'] = $this->getMessage();
        $array['type'] = $this->getType();
        $array['objectId'] = $this->getObjectId();
        $array['logDate'] = $this->getLogDate();

        return $array;
    }

    /**
     * Query for save.
     */
    public function queryForSave()
    {
        $isNew = $this->isNew();
        $query = array();
        $reset = false;

        if (isset($this->data['fields'])) {
            if ($isNew || $reset) {
                if (isset($this->data['fields']['uploader'])) {
                    $query['uploader'] = (int) $this->data['fields']['uploader'];
                }
                if (isset($this->data['fields']['message'])) {
                    $query['message'] = (string) $this->data['fields']['message'];
                }
                if (isset($this->data['fields']['type'])) {
                    $query['type'] = (string) $this->data['fields']['type'];
                }
                if (isset($this->data['fields']['objectId'])) {
                    $query['objectId'] = (string) $this->data['fields']['objectId'];
                }
                if (isset($this->data['fields']['logDate'])) {
                    $query['logDate'] = $this->data['fields']['logDate']; if ($query['logDate'] instanceof \DateTime) { $query['logDate'] = $this->data['fields']['logDate']->getTimestamp(); } elseif (is_string($query['logDate'])) { $query['logDate'] = strtotime($this->data['fields']['logDate']); } $query['logDate'] = new \MongoDate($query['logDate']);
                }
            } else {
                if (isset($this->data['fields']['uploader']) || array_key_exists('uploader', $this->data['fields'])) {
                    $value = $this->data['fields']['uploader'];
                    $originalValue = $this->getOriginalFieldValue('uploader');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['uploader'] = (int) $this->data['fields']['uploader'];
                        } else {
                            $query['$unset']['uploader'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['message']) || array_key_exists('message', $this->data['fields'])) {
                    $value = $this->data['fields']['message'];
                    $originalValue = $this->getOriginalFieldValue('message');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['message'] = (string) $this->data['fields']['message'];
                        } else {
                            $query['$unset']['message'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['type']) || array_key_exists('type', $this->data['fields'])) {
                    $value = $this->data['fields']['type'];
                    $originalValue = $this->getOriginalFieldValue('type');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['type'] = (string) $this->data['fields']['type'];
                        } else {
                            $query['$unset']['type'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['objectId']) || array_key_exists('objectId', $this->data['fields'])) {
                    $value = $this->data['fields']['objectId'];
                    $originalValue = $this->getOriginalFieldValue('objectId');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['objectId'] = (string) $this->data['fields']['objectId'];
                        } else {
                            $query['$unset']['objectId'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['logDate']) || array_key_exists('logDate', $this->data['fields'])) {
                    $value = $this->data['fields']['logDate'];
                    $originalValue = $this->getOriginalFieldValue('logDate');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['logDate'] = $this->data['fields']['logDate']; if ($query['$set']['logDate'] instanceof \DateTime) { $query['$set']['logDate'] = $this->data['fields']['logDate']->getTimestamp(); } elseif (is_string($query['$set']['logDate'])) { $query['$set']['logDate'] = strtotime($this->data['fields']['logDate']); } $query['$set']['logDate'] = new \MongoDate($query['$set']['logDate']);
                        } else {
                            $query['$unset']['logDate'] = 1;
                        }
                    }
                }
            }
        }
        if (true === $reset) {
            $reset = 'deep';
        }

        return $query;
    }

    /**
     * Throws an \LogicException because you cannot check if data exists.
     *
     * @throws \LogicException
     */
    public function offsetExists($name)
    {
        throw new \LogicException('You cannot check if data exists.');
    }

    /**
     * Set data in the document.
     *
     * @param string $name  The data name.
     * @param mixed  $value The value.
     *
     * @throws \InvalidArgumentException If the data name does not exists.
     */
    public function offsetSet($name, $value)
    {
        $this->set($name, $value);
    }

    /**
     * Returns data of the document.
     *
     * @param string $name The data name.
     *
     * @return mixed Some data.
     *
     * @throws \InvalidArgumentException If the data name does not exists.
     */
    public function offsetGet($name)
    {
        return $this->get($name);
    }

    /**
     * Throws a \LogicException because you cannot unset data through ArrayAccess.
     *
     * @throws \LogicException
     */
    public function offsetUnset($name)
    {
        throw new \LogicException('You cannot unset data.');
    }

    /**
     * Set data in the document.
     *
     * @param string $name  The data name.
     * @param mixed  $value The value.
     *
     * @throws \InvalidArgumentException If the data name does not exists.
     */
    public function __set($name, $value)
    {
        $this->set($name, $value);
    }

    /**
     * Returns data of the document.
     *
     * @param string $name The data name.
     *
     * @return mixed Some data.
     *
     * @throws \InvalidArgumentException If the data name does not exists.
     */
    public function __get($name)
    {
        return $this->get($name);
    }
}