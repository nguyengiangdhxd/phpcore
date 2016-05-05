<?php

namespace Mongodb\Base;

/**
 * Base class of Mongodb\ItemsComment document.
 */
abstract class ItemsComment extends \Mandango\Document\Document implements \ArrayAccess
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
     * @return \Mongodb\ItemsComment The document (fluent interface).
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
        if (isset($data['contextType'])) {
            $this->data['fields']['contextType'] = (string) $data['contextType'];
        } elseif (isset($data['_fields']['contextType'])) {
            $this->data['fields']['contextType'] = null;
        }
        if (isset($data['createdTime'])) {
            $this->data['fields']['createdTime'] = new \DateTime(); $this->data['fields']['createdTime']->setTimestamp($data['createdTime']->sec);
        } elseif (isset($data['_fields']['createdTime'])) {
            $this->data['fields']['createdTime'] = null;
        }
        if (isset($data['context'])) {
            $this->data['fields']['context'] = $data['context'];
        } elseif (isset($data['_fields']['context'])) {
            $this->data['fields']['context'] = null;
        }
        if (isset($data['idItems'])) {
            $this->data['fields']['idItems'] = (string) $data['idItems'];
        } elseif (isset($data['_fields']['idItems'])) {
            $this->data['fields']['idItems'] = null;
        }
        if (isset($data['createdBy'])) {
            $this->data['fields']['createdBy'] = (string) $data['createdBy'];
        } elseif (isset($data['_fields']['createdBy'])) {
            $this->data['fields']['createdBy'] = null;
        }
        if (isset($data['scope'])) {
            $this->data['fields']['scope'] = (string) $data['scope'];
        } elseif (isset($data['_fields']['scope'])) {
            $this->data['fields']['scope'] = null;
        }
        if (isset($data['isPublicProfile'])) {
            $this->data['fields']['isPublicProfile'] = (bool) $data['isPublicProfile'];
        } elseif (isset($data['_fields']['isPublicProfile'])) {
            $this->data['fields']['isPublicProfile'] = null;
        }
        if (isset($data['itemId'])) {
            $this->data['fields']['itemId_reference_field'] = $data['itemId'];
        } elseif (isset($data['_fields']['itemId'])) {
            $this->data['fields']['itemId_reference_field'] = null;
        }

        return $this;
    }

    /**
     * Set the "contextType" field.
     *
     * @param mixed $value The value.
     *
     * @return \Mongodb\ItemsComment The document (fluent interface).
     */
    public function setContextType($value)
    {
        if (!isset($this->data['fields']['contextType'])) {
            if (!$this->isNew()) {
                $this->getContextType();
                if ($this->isFieldEqualTo('contextType', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['contextType'] = null;
                $this->data['fields']['contextType'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('contextType', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['contextType']) && !array_key_exists('contextType', $this->fieldsModified)) {
            $this->fieldsModified['contextType'] = $this->data['fields']['contextType'];
        } elseif ($this->isFieldModifiedEqualTo('contextType', $value)) {
            unset($this->fieldsModified['contextType']);
        }

        $this->data['fields']['contextType'] = $value;

        return $this;
    }

    /**
     * Returns the "contextType" field.
     *
     * @return mixed The $name field.
     */
    public function getContextType()
    {
        if (!isset($this->data['fields']['contextType'])) {
            if ($this->isNew()) {
                $this->data['fields']['contextType'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('contextType', $this->data['fields'])) {
                $this->addFieldCache('contextType');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('contextType' => 1));
                if (isset($data['contextType'])) {
                    $this->data['fields']['contextType'] = (string) $data['contextType'];
                } else {
                    $this->data['fields']['contextType'] = null;
                }
            }
        }

        return $this->data['fields']['contextType'];
    }

    /**
     * Set the "createdTime" field.
     *
     * @param mixed $value The value.
     *
     * @return \Mongodb\ItemsComment The document (fluent interface).
     */
    public function setCreatedTime($value)
    {
        if (!isset($this->data['fields']['createdTime'])) {
            if (!$this->isNew()) {
                $this->getCreatedTime();
                if ($this->isFieldEqualTo('createdTime', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['createdTime'] = null;
                $this->data['fields']['createdTime'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('createdTime', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['createdTime']) && !array_key_exists('createdTime', $this->fieldsModified)) {
            $this->fieldsModified['createdTime'] = $this->data['fields']['createdTime'];
        } elseif ($this->isFieldModifiedEqualTo('createdTime', $value)) {
            unset($this->fieldsModified['createdTime']);
        }

        $this->data['fields']['createdTime'] = $value;

        return $this;
    }

    /**
     * Returns the "createdTime" field.
     *
     * @return mixed The $name field.
     */
    public function getCreatedTime()
    {
        if (!isset($this->data['fields']['createdTime'])) {
            if ($this->isNew()) {
                $this->data['fields']['createdTime'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('createdTime', $this->data['fields'])) {
                $this->addFieldCache('createdTime');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('createdTime' => 1));
                if (isset($data['createdTime'])) {
                    $this->data['fields']['createdTime'] = new \DateTime(); $this->data['fields']['createdTime']->setTimestamp($data['createdTime']->sec);
                } else {
                    $this->data['fields']['createdTime'] = null;
                }
            }
        }

        return $this->data['fields']['createdTime'];
    }

    /**
     * Set the "context" field.
     *
     * @param mixed $value The value.
     *
     * @return \Mongodb\ItemsComment The document (fluent interface).
     */
    public function setContext($value)
    {
        if (!isset($this->data['fields']['context'])) {
            if (!$this->isNew()) {
                $this->getContext();
                if ($this->isFieldEqualTo('context', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['context'] = null;
                $this->data['fields']['context'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('context', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['context']) && !array_key_exists('context', $this->fieldsModified)) {
            $this->fieldsModified['context'] = $this->data['fields']['context'];
        } elseif ($this->isFieldModifiedEqualTo('context', $value)) {
            unset($this->fieldsModified['context']);
        }

        $this->data['fields']['context'] = $value;

        return $this;
    }

    /**
     * Returns the "context" field.
     *
     * @return mixed The $name field.
     */
    public function getContext()
    {
        if (!isset($this->data['fields']['context'])) {
            if ($this->isNew()) {
                $this->data['fields']['context'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('context', $this->data['fields'])) {
                $this->addFieldCache('context');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('context' => 1));
                if (isset($data['context'])) {
                    $this->data['fields']['context'] = $data['context'];
                } else {
                    $this->data['fields']['context'] = null;
                }
            }
        }

        return $this->data['fields']['context'];
    }

    /**
     * Set the "idItems" field.
     *
     * @param mixed $value The value.
     *
     * @return \Mongodb\ItemsComment The document (fluent interface).
     */
    public function setIdItems($value)
    {
        if (!isset($this->data['fields']['idItems'])) {
            if (!$this->isNew()) {
                $this->getIdItems();
                if ($this->isFieldEqualTo('idItems', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['idItems'] = null;
                $this->data['fields']['idItems'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('idItems', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['idItems']) && !array_key_exists('idItems', $this->fieldsModified)) {
            $this->fieldsModified['idItems'] = $this->data['fields']['idItems'];
        } elseif ($this->isFieldModifiedEqualTo('idItems', $value)) {
            unset($this->fieldsModified['idItems']);
        }

        $this->data['fields']['idItems'] = $value;

        return $this;
    }

    /**
     * Returns the "idItems" field.
     *
     * @return mixed The $name field.
     */
    public function getIdItems()
    {
        if (!isset($this->data['fields']['idItems'])) {
            if ($this->isNew()) {
                $this->data['fields']['idItems'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('idItems', $this->data['fields'])) {
                $this->addFieldCache('idItems');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('idItems' => 1));
                if (isset($data['idItems'])) {
                    $this->data['fields']['idItems'] = (string) $data['idItems'];
                } else {
                    $this->data['fields']['idItems'] = null;
                }
            }
        }

        return $this->data['fields']['idItems'];
    }

    /**
     * Set the "createdBy" field.
     *
     * @param mixed $value The value.
     *
     * @return \Mongodb\ItemsComment The document (fluent interface).
     */
    public function setCreatedBy($value)
    {
        if (!isset($this->data['fields']['createdBy'])) {
            if (!$this->isNew()) {
                $this->getCreatedBy();
                if ($this->isFieldEqualTo('createdBy', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['createdBy'] = null;
                $this->data['fields']['createdBy'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('createdBy', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['createdBy']) && !array_key_exists('createdBy', $this->fieldsModified)) {
            $this->fieldsModified['createdBy'] = $this->data['fields']['createdBy'];
        } elseif ($this->isFieldModifiedEqualTo('createdBy', $value)) {
            unset($this->fieldsModified['createdBy']);
        }

        $this->data['fields']['createdBy'] = $value;

        return $this;
    }

    /**
     * Returns the "createdBy" field.
     *
     * @return mixed The $name field.
     */
    public function getCreatedBy()
    {
        if (!isset($this->data['fields']['createdBy'])) {
            if ($this->isNew()) {
                $this->data['fields']['createdBy'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('createdBy', $this->data['fields'])) {
                $this->addFieldCache('createdBy');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('createdBy' => 1));
                if (isset($data['createdBy'])) {
                    $this->data['fields']['createdBy'] = (string) $data['createdBy'];
                } else {
                    $this->data['fields']['createdBy'] = null;
                }
            }
        }

        return $this->data['fields']['createdBy'];
    }

    /**
     * Set the "scope" field.
     *
     * @param mixed $value The value.
     *
     * @return \Mongodb\ItemsComment The document (fluent interface).
     */
    public function setScope($value)
    {
        if (!isset($this->data['fields']['scope'])) {
            if (!$this->isNew()) {
                $this->getScope();
                if ($this->isFieldEqualTo('scope', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['scope'] = null;
                $this->data['fields']['scope'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('scope', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['scope']) && !array_key_exists('scope', $this->fieldsModified)) {
            $this->fieldsModified['scope'] = $this->data['fields']['scope'];
        } elseif ($this->isFieldModifiedEqualTo('scope', $value)) {
            unset($this->fieldsModified['scope']);
        }

        $this->data['fields']['scope'] = $value;

        return $this;
    }

    /**
     * Returns the "scope" field.
     *
     * @return mixed The $name field.
     */
    public function getScope()
    {
        if (!isset($this->data['fields']['scope'])) {
            if ($this->isNew()) {
                $this->data['fields']['scope'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('scope', $this->data['fields'])) {
                $this->addFieldCache('scope');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('scope' => 1));
                if (isset($data['scope'])) {
                    $this->data['fields']['scope'] = (string) $data['scope'];
                } else {
                    $this->data['fields']['scope'] = null;
                }
            }
        }

        return $this->data['fields']['scope'];
    }

    /**
     * Set the "isPublicProfile" field.
     *
     * @param mixed $value The value.
     *
     * @return \Mongodb\ItemsComment The document (fluent interface).
     */
    public function setIsPublicProfile($value)
    {
        if (!isset($this->data['fields']['isPublicProfile'])) {
            if (!$this->isNew()) {
                $this->getIsPublicProfile();
                if ($this->isFieldEqualTo('isPublicProfile', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['isPublicProfile'] = null;
                $this->data['fields']['isPublicProfile'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('isPublicProfile', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['isPublicProfile']) && !array_key_exists('isPublicProfile', $this->fieldsModified)) {
            $this->fieldsModified['isPublicProfile'] = $this->data['fields']['isPublicProfile'];
        } elseif ($this->isFieldModifiedEqualTo('isPublicProfile', $value)) {
            unset($this->fieldsModified['isPublicProfile']);
        }

        $this->data['fields']['isPublicProfile'] = $value;

        return $this;
    }

    /**
     * Returns the "isPublicProfile" field.
     *
     * @return mixed The $name field.
     */
    public function getIsPublicProfile()
    {
        if (!isset($this->data['fields']['isPublicProfile'])) {
            if ($this->isNew()) {
                $this->data['fields']['isPublicProfile'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('isPublicProfile', $this->data['fields'])) {
                $this->addFieldCache('isPublicProfile');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('isPublicProfile' => 1));
                if (isset($data['isPublicProfile'])) {
                    $this->data['fields']['isPublicProfile'] = (bool) $data['isPublicProfile'];
                } else {
                    $this->data['fields']['isPublicProfile'] = null;
                }
            }
        }

        return $this->data['fields']['isPublicProfile'];
    }

    /**
     * Set the "itemId_reference_field" field.
     *
     * @param mixed $value The value.
     *
     * @return \Mongodb\ItemsComment The document (fluent interface).
     */
    public function setItemId_reference_field($value)
    {
        if (!isset($this->data['fields']['itemId_reference_field'])) {
            if (!$this->isNew()) {
                $this->getItemId_reference_field();
                if ($this->isFieldEqualTo('itemId_reference_field', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['itemId_reference_field'] = null;
                $this->data['fields']['itemId_reference_field'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('itemId_reference_field', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['itemId_reference_field']) && !array_key_exists('itemId_reference_field', $this->fieldsModified)) {
            $this->fieldsModified['itemId_reference_field'] = $this->data['fields']['itemId_reference_field'];
        } elseif ($this->isFieldModifiedEqualTo('itemId_reference_field', $value)) {
            unset($this->fieldsModified['itemId_reference_field']);
        }

        $this->data['fields']['itemId_reference_field'] = $value;

        return $this;
    }

    /**
     * Returns the "itemId_reference_field" field.
     *
     * @return mixed The $name field.
     */
    public function getItemId_reference_field()
    {
        if (!isset($this->data['fields']['itemId_reference_field'])) {
            if ($this->isNew()) {
                $this->data['fields']['itemId_reference_field'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('itemId_reference_field', $this->data['fields'])) {
                $this->addFieldCache('itemId');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('itemId' => 1));
                if (isset($data['itemId'])) {
                    $this->data['fields']['itemId_reference_field'] = $data['itemId'];
                } else {
                    $this->data['fields']['itemId_reference_field'] = null;
                }
            }
        }

        return $this->data['fields']['itemId_reference_field'];
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
     * Set the "itemId" reference.
     *
     * @param \Mongodb\Items|null $value The reference, or null.
     *
     * @return \Mongodb\ItemsComment The document (fluent interface).
     *
     * @throws \InvalidArgumentException If the class is not an instance of Mongodb\Items.
     */
    public function setItemId($value)
    {
        if (null !== $value && !$value instanceof \Mongodb\Items) {
            throw new \InvalidArgumentException('The "itemId" reference is not an instance of Mongodb\Items.');
        }

        $this->setItemId_reference_field((null === $value || $value->isNew()) ? null : $value->getId());

        $this->data['referencesOne']['itemId'] = $value;

        return $this;
    }

    /**
     * Returns the "itemId" reference.
     *
     * @return \Mongodb\Items|null The reference or null if it does not exist.
     */
    public function getItemId()
    {
        if (!isset($this->data['referencesOne']['itemId'])) {
            if (!$this->isNew()) {
                $this->addReferenceCache('itemId');
            }
            if (!$id = $this->getItemId_reference_field()) {
                return null;
            }
            if (!$document = $this->getMandango()->getRepository('Mongodb\Items')->findOneById($id)) {
                throw new \RuntimeException('The reference "itemId" does not exist.');
            }
            $this->data['referencesOne']['itemId'] = $document;
        }

        return $this->data['referencesOne']['itemId'];
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
     * Update the value of the reference fields.
     */
    public function updateReferenceFields()
    {
        if (isset($this->data['referencesOne']['itemId']) && !isset($this->data['fields']['itemId_reference_field'])) {
            $this->setItemId_reference_field($this->data['referencesOne']['itemId']->getId());
        }
    }

    /**
     * Save the references.
     */
    public function saveReferences()
    {
        if (isset($this->data['referencesOne']['itemId'])) {
            $this->data['referencesOne']['itemId']->save();
        }
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
        if ('contextType' == $name) {
            return $this->setContextType($value);
        }
        if ('createdTime' == $name) {
            return $this->setCreatedTime($value);
        }
        if ('context' == $name) {
            return $this->setContext($value);
        }
        if ('idItems' == $name) {
            return $this->setIdItems($value);
        }
        if ('createdBy' == $name) {
            return $this->setCreatedBy($value);
        }
        if ('scope' == $name) {
            return $this->setScope($value);
        }
        if ('isPublicProfile' == $name) {
            return $this->setIsPublicProfile($value);
        }
        if ('itemId_reference_field' == $name) {
            return $this->setItemId_reference_field($value);
        }
        if ('itemId' == $name) {
            return $this->setItemId($value);
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
        if ('contextType' == $name) {
            return $this->getContextType();
        }
        if ('createdTime' == $name) {
            return $this->getCreatedTime();
        }
        if ('context' == $name) {
            return $this->getContext();
        }
        if ('idItems' == $name) {
            return $this->getIdItems();
        }
        if ('createdBy' == $name) {
            return $this->getCreatedBy();
        }
        if ('scope' == $name) {
            return $this->getScope();
        }
        if ('isPublicProfile' == $name) {
            return $this->getIsPublicProfile();
        }
        if ('itemId_reference_field' == $name) {
            return $this->getItemId_reference_field();
        }
        if ('itemId' == $name) {
            return $this->getItemId();
        }

        throw new \InvalidArgumentException(sprintf('The document data "%s" is not valid.', $name));
    }

    /**
     * Imports data from an array.
     *
     * @param array $array An array.
     *
     * @return \Mongodb\ItemsComment The document (fluent interface).
     */
    public function fromArray(array $array)
    {
        if (isset($array['id'])) {
            $this->setId($array['id']);
        }
        if (isset($array['contextType'])) {
            $this->setContextType($array['contextType']);
        }
        if (isset($array['createdTime'])) {
            $this->setCreatedTime($array['createdTime']);
        }
        if (isset($array['context'])) {
            $this->setContext($array['context']);
        }
        if (isset($array['idItems'])) {
            $this->setIdItems($array['idItems']);
        }
        if (isset($array['createdBy'])) {
            $this->setCreatedBy($array['createdBy']);
        }
        if (isset($array['scope'])) {
            $this->setScope($array['scope']);
        }
        if (isset($array['isPublicProfile'])) {
            $this->setIsPublicProfile($array['isPublicProfile']);
        }
        if (isset($array['itemId_reference_field'])) {
            $this->setItemId_reference_field($array['itemId_reference_field']);
        }
        if (isset($array['itemId'])) {
            $this->setItemId($array['itemId']);
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

        $array['contextType'] = $this->getContextType();
        $array['createdTime'] = $this->getCreatedTime();
        $array['context'] = $this->getContext();
        $array['idItems'] = $this->getIdItems();
        $array['createdBy'] = $this->getCreatedBy();
        $array['scope'] = $this->getScope();
        $array['isPublicProfile'] = $this->getIsPublicProfile();
        if ($withReferenceFields) {
            $array['itemId_reference_field'] = $this->getItemId_reference_field();
        }

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
                if (isset($this->data['fields']['contextType'])) {
                    $query['contextType'] = (string) $this->data['fields']['contextType'];
                }
                if (isset($this->data['fields']['createdTime'])) {
                    $query['createdTime'] = $this->data['fields']['createdTime']; if ($query['createdTime'] instanceof \DateTime) { $query['createdTime'] = $this->data['fields']['createdTime']->getTimestamp(); } elseif (is_string($query['createdTime'])) { $query['createdTime'] = strtotime($this->data['fields']['createdTime']); } $query['createdTime'] = new \MongoDate($query['createdTime']);
                }
                if (isset($this->data['fields']['context'])) {
                    $query['context'] = $this->data['fields']['context'];
                }
                if (isset($this->data['fields']['idItems'])) {
                    $query['idItems'] = (string) $this->data['fields']['idItems'];
                }
                if (isset($this->data['fields']['createdBy'])) {
                    $query['createdBy'] = (string) $this->data['fields']['createdBy'];
                }
                if (isset($this->data['fields']['scope'])) {
                    $query['scope'] = (string) $this->data['fields']['scope'];
                }
                if (isset($this->data['fields']['isPublicProfile'])) {
                    $query['isPublicProfile'] = (bool) $this->data['fields']['isPublicProfile'];
                }
                if (isset($this->data['fields']['itemId_reference_field'])) {
                    $query['itemId'] = $this->data['fields']['itemId_reference_field'];
                }
            } else {
                if (isset($this->data['fields']['contextType']) || array_key_exists('contextType', $this->data['fields'])) {
                    $value = $this->data['fields']['contextType'];
                    $originalValue = $this->getOriginalFieldValue('contextType');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['contextType'] = (string) $this->data['fields']['contextType'];
                        } else {
                            $query['$unset']['contextType'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['createdTime']) || array_key_exists('createdTime', $this->data['fields'])) {
                    $value = $this->data['fields']['createdTime'];
                    $originalValue = $this->getOriginalFieldValue('createdTime');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['createdTime'] = $this->data['fields']['createdTime']; if ($query['$set']['createdTime'] instanceof \DateTime) { $query['$set']['createdTime'] = $this->data['fields']['createdTime']->getTimestamp(); } elseif (is_string($query['$set']['createdTime'])) { $query['$set']['createdTime'] = strtotime($this->data['fields']['createdTime']); } $query['$set']['createdTime'] = new \MongoDate($query['$set']['createdTime']);
                        } else {
                            $query['$unset']['createdTime'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['context']) || array_key_exists('context', $this->data['fields'])) {
                    $value = $this->data['fields']['context'];
                    $originalValue = $this->getOriginalFieldValue('context');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['context'] = $this->data['fields']['context'];
                        } else {
                            $query['$unset']['context'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['idItems']) || array_key_exists('idItems', $this->data['fields'])) {
                    $value = $this->data['fields']['idItems'];
                    $originalValue = $this->getOriginalFieldValue('idItems');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['idItems'] = (string) $this->data['fields']['idItems'];
                        } else {
                            $query['$unset']['idItems'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['createdBy']) || array_key_exists('createdBy', $this->data['fields'])) {
                    $value = $this->data['fields']['createdBy'];
                    $originalValue = $this->getOriginalFieldValue('createdBy');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['createdBy'] = (string) $this->data['fields']['createdBy'];
                        } else {
                            $query['$unset']['createdBy'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['scope']) || array_key_exists('scope', $this->data['fields'])) {
                    $value = $this->data['fields']['scope'];
                    $originalValue = $this->getOriginalFieldValue('scope');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['scope'] = (string) $this->data['fields']['scope'];
                        } else {
                            $query['$unset']['scope'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['isPublicProfile']) || array_key_exists('isPublicProfile', $this->data['fields'])) {
                    $value = $this->data['fields']['isPublicProfile'];
                    $originalValue = $this->getOriginalFieldValue('isPublicProfile');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['isPublicProfile'] = (bool) $this->data['fields']['isPublicProfile'];
                        } else {
                            $query['$unset']['isPublicProfile'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['itemId_reference_field']) || array_key_exists('itemId_reference_field', $this->data['fields'])) {
                    $value = $this->data['fields']['itemId_reference_field'];
                    $originalValue = $this->getOriginalFieldValue('itemId_reference_field');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['itemId'] = $this->data['fields']['itemId_reference_field'];
                        } else {
                            $query['$unset']['itemId'] = 1;
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