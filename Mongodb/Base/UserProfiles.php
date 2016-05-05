<?php

namespace Mongodb\Base;

/**
 * Base class of Mongodb\UserProfiles document.
 */
abstract class UserProfiles extends \Mandango\Document\Document implements \ArrayAccess
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
     * @return \Mongodb\UserProfiles The document (fluent interface).
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
        if (isset($data['userId'])) {
            $this->data['fields']['userId'] = (int) $data['userId'];
        } elseif (isset($data['_fields']['userId'])) {
            $this->data['fields']['userId'] = null;
        }
        if (isset($data['username'])) {
            $this->data['fields']['username'] = (string) $data['username'];
        } elseif (isset($data['_fields']['username'])) {
            $this->data['fields']['username'] = null;
        }
        if (isset($data['lastPass'])) {
            $this->data['fields']['lastPass'] = $data['lastPass'];
        } elseif (isset($data['_fields']['lastPass'])) {
            $this->data['fields']['lastPass'] = null;
        }

        return $this;
    }

    /**
     * Set the "userId" field.
     *
     * @param mixed $value The value.
     *
     * @return \Mongodb\UserProfiles The document (fluent interface).
     */
    public function setUserId($value)
    {
        if (!isset($this->data['fields']['userId'])) {
            if (!$this->isNew()) {
                $this->getUserId();
                if ($this->isFieldEqualTo('userId', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['userId'] = null;
                $this->data['fields']['userId'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('userId', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['userId']) && !array_key_exists('userId', $this->fieldsModified)) {
            $this->fieldsModified['userId'] = $this->data['fields']['userId'];
        } elseif ($this->isFieldModifiedEqualTo('userId', $value)) {
            unset($this->fieldsModified['userId']);
        }

        $this->data['fields']['userId'] = $value;

        return $this;
    }

    /**
     * Returns the "userId" field.
     *
     * @return mixed The $name field.
     */
    public function getUserId()
    {
        if (!isset($this->data['fields']['userId'])) {
            if ($this->isNew()) {
                $this->data['fields']['userId'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('userId', $this->data['fields'])) {
                $this->addFieldCache('userId');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('userId' => 1));
                if (isset($data['userId'])) {
                    $this->data['fields']['userId'] = (int) $data['userId'];
                } else {
                    $this->data['fields']['userId'] = null;
                }
            }
        }

        return $this->data['fields']['userId'];
    }

    /**
     * Set the "username" field.
     *
     * @param mixed $value The value.
     *
     * @return \Mongodb\UserProfiles The document (fluent interface).
     */
    public function setUsername($value)
    {
        if (!isset($this->data['fields']['username'])) {
            if (!$this->isNew()) {
                $this->getUsername();
                if ($this->isFieldEqualTo('username', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['username'] = null;
                $this->data['fields']['username'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('username', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['username']) && !array_key_exists('username', $this->fieldsModified)) {
            $this->fieldsModified['username'] = $this->data['fields']['username'];
        } elseif ($this->isFieldModifiedEqualTo('username', $value)) {
            unset($this->fieldsModified['username']);
        }

        $this->data['fields']['username'] = $value;

        return $this;
    }

    /**
     * Returns the "username" field.
     *
     * @return mixed The $name field.
     */
    public function getUsername()
    {
        if (!isset($this->data['fields']['username'])) {
            if ($this->isNew()) {
                $this->data['fields']['username'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('username', $this->data['fields'])) {
                $this->addFieldCache('username');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('username' => 1));
                if (isset($data['username'])) {
                    $this->data['fields']['username'] = (string) $data['username'];
                } else {
                    $this->data['fields']['username'] = null;
                }
            }
        }

        return $this->data['fields']['username'];
    }

    /**
     * Set the "lastPass" field.
     *
     * @param mixed $value The value.
     *
     * @return \Mongodb\UserProfiles The document (fluent interface).
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
        if ('userId' == $name) {
            return $this->setUserId($value);
        }
        if ('username' == $name) {
            return $this->setUsername($value);
        }
        if ('lastPass' == $name) {
            return $this->setLastPass($value);
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
        if ('userId' == $name) {
            return $this->getUserId();
        }
        if ('username' == $name) {
            return $this->getUsername();
        }
        if ('lastPass' == $name) {
            return $this->getLastPass();
        }

        throw new \InvalidArgumentException(sprintf('The document data "%s" is not valid.', $name));
    }

    /**
     * Imports data from an array.
     *
     * @param array $array An array.
     *
     * @return \Mongodb\UserProfiles The document (fluent interface).
     */
    public function fromArray(array $array)
    {
        if (isset($array['id'])) {
            $this->setId($array['id']);
        }
        if (isset($array['userId'])) {
            $this->setUserId($array['userId']);
        }
        if (isset($array['username'])) {
            $this->setUsername($array['username']);
        }
        if (isset($array['lastPass'])) {
            $this->setLastPass($array['lastPass']);
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

        $array['userId'] = $this->getUserId();
        $array['username'] = $this->getUsername();
        $array['lastPass'] = $this->getLastPass();

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
                if (isset($this->data['fields']['userId'])) {
                    $query['userId'] = (int) $this->data['fields']['userId'];
                }
                if (isset($this->data['fields']['username'])) {
                    $query['username'] = (string) $this->data['fields']['username'];
                }
                if (isset($this->data['fields']['lastPass'])) {
                    $query['lastPass'] = $this->data['fields']['lastPass'];
                }
            } else {
                if (isset($this->data['fields']['userId']) || array_key_exists('userId', $this->data['fields'])) {
                    $value = $this->data['fields']['userId'];
                    $originalValue = $this->getOriginalFieldValue('userId');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['userId'] = (int) $this->data['fields']['userId'];
                        } else {
                            $query['$unset']['userId'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['username']) || array_key_exists('username', $this->data['fields'])) {
                    $value = $this->data['fields']['username'];
                    $originalValue = $this->getOriginalFieldValue('username');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['username'] = (string) $this->data['fields']['username'];
                        } else {
                            $query['$unset']['username'] = 1;
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