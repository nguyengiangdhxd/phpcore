<?php

namespace Mongodb\Base;

/**
 * Base class of Mongodb\ItemsSalePriceFile document.
 */
abstract class ItemsSalePriceFile extends \Mandango\Document\Document implements \ArrayAccess
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
     * @return \Mongodb\ItemsSalePriceFile The document (fluent interface).
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
        if (isset($data['customerId'])) {
            $this->data['fields']['customerId'] = (int) $data['customerId'];
        } elseif (isset($data['_fields']['customerId'])) {
            $this->data['fields']['customerId'] = null;
        }
        if (isset($data['filePath'])) {
            $this->data['fields']['filePath'] = (string) $data['filePath'];
        } elseif (isset($data['_fields']['filePath'])) {
            $this->data['fields']['filePath'] = null;
        }
        if (isset($data['rawFileName'])) {
            $this->data['fields']['rawFileName'] = (string) $data['rawFileName'];
        } elseif (isset($data['_fields']['rawFileName'])) {
            $this->data['fields']['rawFileName'] = null;
        }
        if (isset($data['uploadTime'])) {
            $this->data['fields']['uploadTime'] = new \DateTime(); $this->data['fields']['uploadTime']->setTimestamp($data['uploadTime']->sec);
        } elseif (isset($data['_fields']['uploadTime'])) {
            $this->data['fields']['uploadTime'] = null;
        }

        return $this;
    }

    /**
     * Set the "customerId" field.
     *
     * @param mixed $value The value.
     *
     * @return \Mongodb\ItemsSalePriceFile The document (fluent interface).
     */
    public function setCustomerId($value)
    {
        if (!isset($this->data['fields']['customerId'])) {
            if (!$this->isNew()) {
                $this->getCustomerId();
                if ($this->isFieldEqualTo('customerId', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['customerId'] = null;
                $this->data['fields']['customerId'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('customerId', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['customerId']) && !array_key_exists('customerId', $this->fieldsModified)) {
            $this->fieldsModified['customerId'] = $this->data['fields']['customerId'];
        } elseif ($this->isFieldModifiedEqualTo('customerId', $value)) {
            unset($this->fieldsModified['customerId']);
        }

        $this->data['fields']['customerId'] = $value;

        return $this;
    }

    /**
     * Returns the "customerId" field.
     *
     * @return mixed The $name field.
     */
    public function getCustomerId()
    {
        if (!isset($this->data['fields']['customerId'])) {
            if ($this->isNew()) {
                $this->data['fields']['customerId'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('customerId', $this->data['fields'])) {
                $this->addFieldCache('customerId');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('customerId' => 1));
                if (isset($data['customerId'])) {
                    $this->data['fields']['customerId'] = (int) $data['customerId'];
                } else {
                    $this->data['fields']['customerId'] = null;
                }
            }
        }

        return $this->data['fields']['customerId'];
    }

    /**
     * Set the "filePath" field.
     *
     * @param mixed $value The value.
     *
     * @return \Mongodb\ItemsSalePriceFile The document (fluent interface).
     */
    public function setFilePath($value)
    {
        if (!isset($this->data['fields']['filePath'])) {
            if (!$this->isNew()) {
                $this->getFilePath();
                if ($this->isFieldEqualTo('filePath', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['filePath'] = null;
                $this->data['fields']['filePath'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('filePath', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['filePath']) && !array_key_exists('filePath', $this->fieldsModified)) {
            $this->fieldsModified['filePath'] = $this->data['fields']['filePath'];
        } elseif ($this->isFieldModifiedEqualTo('filePath', $value)) {
            unset($this->fieldsModified['filePath']);
        }

        $this->data['fields']['filePath'] = $value;

        return $this;
    }

    /**
     * Returns the "filePath" field.
     *
     * @return mixed The $name field.
     */
    public function getFilePath()
    {
        if (!isset($this->data['fields']['filePath'])) {
            if ($this->isNew()) {
                $this->data['fields']['filePath'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('filePath', $this->data['fields'])) {
                $this->addFieldCache('filePath');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('filePath' => 1));
                if (isset($data['filePath'])) {
                    $this->data['fields']['filePath'] = (string) $data['filePath'];
                } else {
                    $this->data['fields']['filePath'] = null;
                }
            }
        }

        return $this->data['fields']['filePath'];
    }

    /**
     * Set the "rawFileName" field.
     *
     * @param mixed $value The value.
     *
     * @return \Mongodb\ItemsSalePriceFile The document (fluent interface).
     */
    public function setRawFileName($value)
    {
        if (!isset($this->data['fields']['rawFileName'])) {
            if (!$this->isNew()) {
                $this->getRawFileName();
                if ($this->isFieldEqualTo('rawFileName', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['rawFileName'] = null;
                $this->data['fields']['rawFileName'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('rawFileName', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['rawFileName']) && !array_key_exists('rawFileName', $this->fieldsModified)) {
            $this->fieldsModified['rawFileName'] = $this->data['fields']['rawFileName'];
        } elseif ($this->isFieldModifiedEqualTo('rawFileName', $value)) {
            unset($this->fieldsModified['rawFileName']);
        }

        $this->data['fields']['rawFileName'] = $value;

        return $this;
    }

    /**
     * Returns the "rawFileName" field.
     *
     * @return mixed The $name field.
     */
    public function getRawFileName()
    {
        if (!isset($this->data['fields']['rawFileName'])) {
            if ($this->isNew()) {
                $this->data['fields']['rawFileName'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('rawFileName', $this->data['fields'])) {
                $this->addFieldCache('rawFileName');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('rawFileName' => 1));
                if (isset($data['rawFileName'])) {
                    $this->data['fields']['rawFileName'] = (string) $data['rawFileName'];
                } else {
                    $this->data['fields']['rawFileName'] = null;
                }
            }
        }

        return $this->data['fields']['rawFileName'];
    }

    /**
     * Set the "uploadTime" field.
     *
     * @param mixed $value The value.
     *
     * @return \Mongodb\ItemsSalePriceFile The document (fluent interface).
     */
    public function setUploadTime($value)
    {
        if (!isset($this->data['fields']['uploadTime'])) {
            if (!$this->isNew()) {
                $this->getUploadTime();
                if ($this->isFieldEqualTo('uploadTime', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['uploadTime'] = null;
                $this->data['fields']['uploadTime'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('uploadTime', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['uploadTime']) && !array_key_exists('uploadTime', $this->fieldsModified)) {
            $this->fieldsModified['uploadTime'] = $this->data['fields']['uploadTime'];
        } elseif ($this->isFieldModifiedEqualTo('uploadTime', $value)) {
            unset($this->fieldsModified['uploadTime']);
        }

        $this->data['fields']['uploadTime'] = $value;

        return $this;
    }

    /**
     * Returns the "uploadTime" field.
     *
     * @return mixed The $name field.
     */
    public function getUploadTime()
    {
        if (!isset($this->data['fields']['uploadTime'])) {
            if ($this->isNew()) {
                $this->data['fields']['uploadTime'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('uploadTime', $this->data['fields'])) {
                $this->addFieldCache('uploadTime');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('uploadTime' => 1));
                if (isset($data['uploadTime'])) {
                    $this->data['fields']['uploadTime'] = new \DateTime(); $this->data['fields']['uploadTime']->setTimestamp($data['uploadTime']->sec);
                } else {
                    $this->data['fields']['uploadTime'] = null;
                }
            }
        }

        return $this->data['fields']['uploadTime'];
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
        if ('customerId' == $name) {
            return $this->setCustomerId($value);
        }
        if ('filePath' == $name) {
            return $this->setFilePath($value);
        }
        if ('rawFileName' == $name) {
            return $this->setRawFileName($value);
        }
        if ('uploadTime' == $name) {
            return $this->setUploadTime($value);
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
        if ('customerId' == $name) {
            return $this->getCustomerId();
        }
        if ('filePath' == $name) {
            return $this->getFilePath();
        }
        if ('rawFileName' == $name) {
            return $this->getRawFileName();
        }
        if ('uploadTime' == $name) {
            return $this->getUploadTime();
        }

        throw new \InvalidArgumentException(sprintf('The document data "%s" is not valid.', $name));
    }

    /**
     * Imports data from an array.
     *
     * @param array $array An array.
     *
     * @return \Mongodb\ItemsSalePriceFile The document (fluent interface).
     */
    public function fromArray(array $array)
    {
        if (isset($array['id'])) {
            $this->setId($array['id']);
        }
        if (isset($array['customerId'])) {
            $this->setCustomerId($array['customerId']);
        }
        if (isset($array['filePath'])) {
            $this->setFilePath($array['filePath']);
        }
        if (isset($array['rawFileName'])) {
            $this->setRawFileName($array['rawFileName']);
        }
        if (isset($array['uploadTime'])) {
            $this->setUploadTime($array['uploadTime']);
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

        $array['customerId'] = $this->getCustomerId();
        $array['filePath'] = $this->getFilePath();
        $array['rawFileName'] = $this->getRawFileName();
        $array['uploadTime'] = $this->getUploadTime();

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
                if (isset($this->data['fields']['customerId'])) {
                    $query['customerId'] = (int) $this->data['fields']['customerId'];
                }
                if (isset($this->data['fields']['filePath'])) {
                    $query['filePath'] = (string) $this->data['fields']['filePath'];
                }
                if (isset($this->data['fields']['rawFileName'])) {
                    $query['rawFileName'] = (string) $this->data['fields']['rawFileName'];
                }
                if (isset($this->data['fields']['uploadTime'])) {
                    $query['uploadTime'] = $this->data['fields']['uploadTime']; if ($query['uploadTime'] instanceof \DateTime) { $query['uploadTime'] = $this->data['fields']['uploadTime']->getTimestamp(); } elseif (is_string($query['uploadTime'])) { $query['uploadTime'] = strtotime($this->data['fields']['uploadTime']); } $query['uploadTime'] = new \MongoDate($query['uploadTime']);
                }
            } else {
                if (isset($this->data['fields']['customerId']) || array_key_exists('customerId', $this->data['fields'])) {
                    $value = $this->data['fields']['customerId'];
                    $originalValue = $this->getOriginalFieldValue('customerId');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['customerId'] = (int) $this->data['fields']['customerId'];
                        } else {
                            $query['$unset']['customerId'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['filePath']) || array_key_exists('filePath', $this->data['fields'])) {
                    $value = $this->data['fields']['filePath'];
                    $originalValue = $this->getOriginalFieldValue('filePath');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['filePath'] = (string) $this->data['fields']['filePath'];
                        } else {
                            $query['$unset']['filePath'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['rawFileName']) || array_key_exists('rawFileName', $this->data['fields'])) {
                    $value = $this->data['fields']['rawFileName'];
                    $originalValue = $this->getOriginalFieldValue('rawFileName');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['rawFileName'] = (string) $this->data['fields']['rawFileName'];
                        } else {
                            $query['$unset']['rawFileName'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['uploadTime']) || array_key_exists('uploadTime', $this->data['fields'])) {
                    $value = $this->data['fields']['uploadTime'];
                    $originalValue = $this->getOriginalFieldValue('uploadTime');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['uploadTime'] = $this->data['fields']['uploadTime']; if ($query['$set']['uploadTime'] instanceof \DateTime) { $query['$set']['uploadTime'] = $this->data['fields']['uploadTime']->getTimestamp(); } elseif (is_string($query['$set']['uploadTime'])) { $query['$set']['uploadTime'] = strtotime($this->data['fields']['uploadTime']); } $query['$set']['uploadTime'] = new \MongoDate($query['$set']['uploadTime']);
                        } else {
                            $query['$unset']['uploadTime'] = 1;
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