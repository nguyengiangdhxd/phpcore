<?php

namespace Mongodb\Base;

/**
 * Base class of Mongodb\CustomerProfiles document.
 */
abstract class CustomerProfiles extends \Mandango\Document\Document implements \ArrayAccess
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
     * @return \Mongodb\CustomerProfiles The document (fluent interface).
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
        if (isset($data['customerUsername'])) {
            $this->data['fields']['customerUsername'] = (string) $data['customerUsername'];
        } elseif (isset($data['_fields']['customerUsername'])) {
            $this->data['fields']['customerUsername'] = null;
        }
        if (isset($data['lastPass'])) {
            $this->data['fields']['lastPass'] = $data['lastPass'];
        } elseif (isset($data['_fields']['lastPass'])) {
            $this->data['fields']['lastPass'] = null;
        }
        if (isset($data['integration'])) {
            $this->data['fields']['integration'] = $data['integration'];
        } elseif (isset($data['_fields']['integration'])) {
            $this->data['fields']['integration'] = null;
        }

        return $this;
    }

    /**
     * Set the "customerId" field.
     *
     * @param mixed $value The value.
     *
     * @return \Mongodb\CustomerProfiles The document (fluent interface).
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
     * Set the "customerUsername" field.
     *
     * @param mixed $value The value.
     *
     * @return \Mongodb\CustomerProfiles The document (fluent interface).
     */
    public function setCustomerUsername($value)
    {
        if (!isset($this->data['fields']['customerUsername'])) {
            if (!$this->isNew()) {
                $this->getCustomerUsername();
                if ($this->isFieldEqualTo('customerUsername', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['customerUsername'] = null;
                $this->data['fields']['customerUsername'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('customerUsername', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['customerUsername']) && !array_key_exists('customerUsername', $this->fieldsModified)) {
            $this->fieldsModified['customerUsername'] = $this->data['fields']['customerUsername'];
        } elseif ($this->isFieldModifiedEqualTo('customerUsername', $value)) {
            unset($this->fieldsModified['customerUsername']);
        }

        $this->data['fields']['customerUsername'] = $value;

        return $this;
    }

    /**
     * Returns the "customerUsername" field.
     *
     * @return mixed The $name field.
     */
    public function getCustomerUsername()
    {
        if (!isset($this->data['fields']['customerUsername'])) {
            if ($this->isNew()) {
                $this->data['fields']['customerUsername'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('customerUsername', $this->data['fields'])) {
                $this->addFieldCache('customerUsername');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('customerUsername' => 1));
                if (isset($data['customerUsername'])) {
                    $this->data['fields']['customerUsername'] = (string) $data['customerUsername'];
                } else {
                    $this->data['fields']['customerUsername'] = null;
                }
            }
        }

        return $this->data['fields']['customerUsername'];
    }

    /**
     * Set the "lastPass" field.
     *
     * @param mixed $value The value.
     *
     * @return \Mongodb\CustomerProfiles The document (fluent interface).
     */
    public function setLastPass($value)
    {
        if (!isset($this->data['fields']['lastPass'])) {
            if (!$this->isNew()) {
                $this->getLastPass();
                if ($this->isFieldEqualTo('lastPass', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['lastPass'] = null;
                $this->data['fields']['lastPass'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('lastPass', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['lastPass']) && !array_key_exists('lastPass', $this->fieldsModified)) {
            $this->fieldsModified['lastPass'] = $this->data['fields']['lastPass'];
        } elseif ($this->isFieldModifiedEqualTo('lastPass', $value)) {
            unset($this->fieldsModified['lastPass']);
        }

        $this->data['fields']['lastPass'] = $value;

        return $this;
    }

    /**
     * Returns the "lastPass" field.
     *
     * @return mixed The $name field.
     */
    public function getLastPass()
    {
        if (!isset($this->data['fields']['lastPass'])) {
            if ($this->isNew()) {
                $this->data['fields']['lastPass'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('lastPass', $this->data['fields'])) {
                $this->addFieldCache('lastPass');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('lastPass' => 1));
                if (isset($data['lastPass'])) {
                    $this->data['fields']['lastPass'] = $data['lastPass'];
                } else {
                    $this->data['fields']['lastPass'] = null;
                }
            }
        }

        return $this->data['fields']['lastPass'];
    }

    /**
     * Set the "integration" field.
     *
     * @param mixed $value The value.
     *
     * @return \Mongodb\CustomerProfiles The document (fluent interface).
     */
    public function setIntegration($value)
    {
        if (!isset($this->data['fields']['integration'])) {
            if (!$this->isNew()) {
                $this->getIntegration();
                if ($this->isFieldEqualTo('integration', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['integration'] = null;
                $this->data['fields']['integration'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('integration', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['integration']) && !array_key_exists('integration', $this->fieldsModified)) {
            $this->fieldsModified['integration'] = $this->data['fields']['integration'];
        } elseif ($this->isFieldModifiedEqualTo('integration', $value)) {
            unset($this->fieldsModified['integration']);
        }

        $this->data['fields']['integration'] = $value;

        return $this;
    }

    /**
     * Returns the "integration" field.
     *
     * @return mixed The $name field.
     */
    public function getIntegration()
    {
        if (!isset($this->data['fields']['integration'])) {
            if ($this->isNew()) {
                $this->data['fields']['integration'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('integration', $this->data['fields'])) {
                $this->addFieldCache('integration');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('integration' => 1));
                if (isset($data['integration'])) {
                    $this->data['fields']['integration'] = $data['integration'];
                } else {
                    $this->data['fields']['integration'] = null;
                }
            }
        }

        return $this->data['fields']['integration'];
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
        if ('customerUsername' == $name) {
            return $this->setCustomerUsername($value);
        }
        if ('lastPass' == $name) {
            return $this->setLastPass($value);
        }
        if ('integration' == $name) {
            return $this->setIntegration($value);
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
        if ('customerUsername' == $name) {
            return $this->getCustomerUsername();
        }
        if ('lastPass' == $name) {
            return $this->getLastPass();
        }
        if ('integration' == $name) {
            return $this->getIntegration();
        }

        throw new \InvalidArgumentException(sprintf('The document data "%s" is not valid.', $name));
    }

    /**
     * Imports data from an array.
     *
     * @param array $array An array.
     *
     * @return \Mongodb\CustomerProfiles The document (fluent interface).
     */
    public function fromArray(array $array)
    {
        if (isset($array['id'])) {
            $this->setId($array['id']);
        }
        if (isset($array['customerId'])) {
            $this->setCustomerId($array['customerId']);
        }
        if (isset($array['customerUsername'])) {
            $this->setCustomerUsername($array['customerUsername']);
        }
        if (isset($array['lastPass'])) {
            $this->setLastPass($array['lastPass']);
        }
        if (isset($array['integration'])) {
            $this->setIntegration($array['integration']);
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
        $array['customerUsername'] = $this->getCustomerUsername();
        $array['lastPass'] = $this->getLastPass();
        $array['integration'] = $this->getIntegration();

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
                if (isset($this->data['fields']['customerUsername'])) {
                    $query['customerUsername'] = (string) $this->data['fields']['customerUsername'];
                }
                if (isset($this->data['fields']['lastPass'])) {
                    $query['lastPass'] = $this->data['fields']['lastPass'];
                }
                if (isset($this->data['fields']['integration'])) {
                    $query['integration'] = $this->data['fields']['integration'];
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
                if (isset($this->data['fields']['customerUsername']) || array_key_exists('customerUsername', $this->data['fields'])) {
                    $value = $this->data['fields']['customerUsername'];
                    $originalValue = $this->getOriginalFieldValue('customerUsername');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['customerUsername'] = (string) $this->data['fields']['customerUsername'];
                        } else {
                            $query['$unset']['customerUsername'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['lastPass']) || array_key_exists('lastPass', $this->data['fields'])) {
                    $value = $this->data['fields']['lastPass'];
                    $originalValue = $this->getOriginalFieldValue('lastPass');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['lastPass'] = $this->data['fields']['lastPass'];
                        } else {
                            $query['$unset']['lastPass'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['integration']) || array_key_exists('integration', $this->data['fields'])) {
                    $value = $this->data['fields']['integration'];
                    $originalValue = $this->getOriginalFieldValue('integration');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['integration'] = $this->data['fields']['integration'];
                        } else {
                            $query['$unset']['integration'] = 1;
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