<?php

namespace Mongodb\Base;

/**
 * Base class of Mongodb\TranslatorTitleKeyword document.
 */
abstract class TranslatorTitleKeyword extends \Mandango\Document\Document implements \ArrayAccess
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
     * @return \Mongodb\TranslatorTitleKeyword The document (fluent interface).
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
        if (isset($data['keyword_china'])) {
            $this->data['fields']['keyword_china'] = (string) $data['keyword_china'];
        } elseif (isset($data['_fields']['keyword_china'])) {
            $this->data['fields']['keyword_china'] = null;
        }
        if (isset($data['keyword_vi'])) {
            $this->data['fields']['keyword_vi'] = (string) $data['keyword_vi'];
        } elseif (isset($data['_fields']['keyword_vi'])) {
            $this->data['fields']['keyword_vi'] = null;
        }
        if (isset($data['keyword_vi_sms'])) {
            $this->data['fields']['keyword_vi_sms'] = (string) $data['keyword_vi_sms'];
        } elseif (isset($data['_fields']['keyword_vi_sms'])) {
            $this->data['fields']['keyword_vi_sms'] = null;
        }
        if (isset($data['full_text_search'])) {
            $this->data['fields']['full_text_search'] = (string) $data['full_text_search'];
        } elseif (isset($data['_fields']['full_text_search'])) {
            $this->data['fields']['full_text_search'] = null;
        }
        if (isset($data['weighted'])) {
            $this->data['fields']['weighted'] = (int) $data['weighted'];
        } elseif (isset($data['_fields']['weighted'])) {
            $this->data['fields']['weighted'] = null;
        }
        if (isset($data['is_translated'])) {
            $this->data['fields']['is_translated'] = (int) $data['is_translated'];
        } elseif (isset($data['_fields']['is_translated'])) {
            $this->data['fields']['is_translated'] = null;
        }
        if (isset($data['tags'])) {
            $this->data['fields']['tags'] = (string) $data['tags'];
        } elseif (isset($data['_fields']['tags'])) {
            $this->data['fields']['tags'] = null;
        }
        if (isset($data['vi_position'])) {
            $this->data['fields']['vi_position'] = (int) $data['vi_position'];
        } elseif (isset($data['_fields']['vi_position'])) {
            $this->data['fields']['vi_position'] = null;
        }

        return $this;
    }

    /**
     * Set the "keyword_china" field.
     *
     * @param mixed $value The value.
     *
     * @return \Mongodb\TranslatorTitleKeyword The document (fluent interface).
     */
    public function setKeyword_china($value)
    {
        if (!isset($this->data['fields']['keyword_china'])) {
            if (!$this->isNew()) {
                $this->getKeyword_china();
                if ($this->isFieldEqualTo('keyword_china', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['keyword_china'] = null;
                $this->data['fields']['keyword_china'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('keyword_china', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['keyword_china']) && !array_key_exists('keyword_china', $this->fieldsModified)) {
            $this->fieldsModified['keyword_china'] = $this->data['fields']['keyword_china'];
        } elseif ($this->isFieldModifiedEqualTo('keyword_china', $value)) {
            unset($this->fieldsModified['keyword_china']);
        }

        $this->data['fields']['keyword_china'] = $value;

        return $this;
    }

    /**
     * Returns the "keyword_china" field.
     *
     * @return mixed The $name field.
     */
    public function getKeyword_china()
    {
        if (!isset($this->data['fields']['keyword_china'])) {
            if ($this->isNew()) {
                $this->data['fields']['keyword_china'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('keyword_china', $this->data['fields'])) {
                $this->addFieldCache('keyword_china');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('keyword_china' => 1));
                if (isset($data['keyword_china'])) {
                    $this->data['fields']['keyword_china'] = (string) $data['keyword_china'];
                } else {
                    $this->data['fields']['keyword_china'] = null;
                }
            }
        }

        return $this->data['fields']['keyword_china'];
    }

    /**
     * Set the "keyword_vi" field.
     *
     * @param mixed $value The value.
     *
     * @return \Mongodb\TranslatorTitleKeyword The document (fluent interface).
     */
    public function setKeyword_vi($value)
    {
        if (!isset($this->data['fields']['keyword_vi'])) {
            if (!$this->isNew()) {
                $this->getKeyword_vi();
                if ($this->isFieldEqualTo('keyword_vi', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['keyword_vi'] = null;
                $this->data['fields']['keyword_vi'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('keyword_vi', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['keyword_vi']) && !array_key_exists('keyword_vi', $this->fieldsModified)) {
            $this->fieldsModified['keyword_vi'] = $this->data['fields']['keyword_vi'];
        } elseif ($this->isFieldModifiedEqualTo('keyword_vi', $value)) {
            unset($this->fieldsModified['keyword_vi']);
        }

        $this->data['fields']['keyword_vi'] = $value;

        return $this;
    }

    /**
     * Returns the "keyword_vi" field.
     *
     * @return mixed The $name field.
     */
    public function getKeyword_vi()
    {
        if (!isset($this->data['fields']['keyword_vi'])) {
            if ($this->isNew()) {
                $this->data['fields']['keyword_vi'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('keyword_vi', $this->data['fields'])) {
                $this->addFieldCache('keyword_vi');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('keyword_vi' => 1));
                if (isset($data['keyword_vi'])) {
                    $this->data['fields']['keyword_vi'] = (string) $data['keyword_vi'];
                } else {
                    $this->data['fields']['keyword_vi'] = null;
                }
            }
        }

        return $this->data['fields']['keyword_vi'];
    }

    /**
     * Set the "keyword_vi_sms" field.
     *
     * @param mixed $value The value.
     *
     * @return \Mongodb\TranslatorTitleKeyword The document (fluent interface).
     */
    public function setKeyword_vi_sms($value)
    {
        if (!isset($this->data['fields']['keyword_vi_sms'])) {
            if (!$this->isNew()) {
                $this->getKeyword_vi_sms();
                if ($this->isFieldEqualTo('keyword_vi_sms', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['keyword_vi_sms'] = null;
                $this->data['fields']['keyword_vi_sms'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('keyword_vi_sms', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['keyword_vi_sms']) && !array_key_exists('keyword_vi_sms', $this->fieldsModified)) {
            $this->fieldsModified['keyword_vi_sms'] = $this->data['fields']['keyword_vi_sms'];
        } elseif ($this->isFieldModifiedEqualTo('keyword_vi_sms', $value)) {
            unset($this->fieldsModified['keyword_vi_sms']);
        }

        $this->data['fields']['keyword_vi_sms'] = $value;

        return $this;
    }

    /**
     * Returns the "keyword_vi_sms" field.
     *
     * @return mixed The $name field.
     */
    public function getKeyword_vi_sms()
    {
        if (!isset($this->data['fields']['keyword_vi_sms'])) {
            if ($this->isNew()) {
                $this->data['fields']['keyword_vi_sms'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('keyword_vi_sms', $this->data['fields'])) {
                $this->addFieldCache('keyword_vi_sms');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('keyword_vi_sms' => 1));
                if (isset($data['keyword_vi_sms'])) {
                    $this->data['fields']['keyword_vi_sms'] = (string) $data['keyword_vi_sms'];
                } else {
                    $this->data['fields']['keyword_vi_sms'] = null;
                }
            }
        }

        return $this->data['fields']['keyword_vi_sms'];
    }

    /**
     * Set the "full_text_search" field.
     *
     * @param mixed $value The value.
     *
     * @return \Mongodb\TranslatorTitleKeyword The document (fluent interface).
     */
    public function setFull_text_search($value)
    {
        if (!isset($this->data['fields']['full_text_search'])) {
            if (!$this->isNew()) {
                $this->getFull_text_search();
                if ($this->isFieldEqualTo('full_text_search', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['full_text_search'] = null;
                $this->data['fields']['full_text_search'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('full_text_search', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['full_text_search']) && !array_key_exists('full_text_search', $this->fieldsModified)) {
            $this->fieldsModified['full_text_search'] = $this->data['fields']['full_text_search'];
        } elseif ($this->isFieldModifiedEqualTo('full_text_search', $value)) {
            unset($this->fieldsModified['full_text_search']);
        }

        $this->data['fields']['full_text_search'] = $value;

        return $this;
    }

    /**
     * Returns the "full_text_search" field.
     *
     * @return mixed The $name field.
     */
    public function getFull_text_search()
    {
        if (!isset($this->data['fields']['full_text_search'])) {
            if ($this->isNew()) {
                $this->data['fields']['full_text_search'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('full_text_search', $this->data['fields'])) {
                $this->addFieldCache('full_text_search');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('full_text_search' => 1));
                if (isset($data['full_text_search'])) {
                    $this->data['fields']['full_text_search'] = (string) $data['full_text_search'];
                } else {
                    $this->data['fields']['full_text_search'] = null;
                }
            }
        }

        return $this->data['fields']['full_text_search'];
    }

    /**
     * Set the "weighted" field.
     *
     * @param mixed $value The value.
     *
     * @return \Mongodb\TranslatorTitleKeyword The document (fluent interface).
     */
    public function setWeighted($value)
    {
        if (!isset($this->data['fields']['weighted'])) {
            if (!$this->isNew()) {
                $this->getWeighted();
                if ($this->isFieldEqualTo('weighted', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['weighted'] = null;
                $this->data['fields']['weighted'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('weighted', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['weighted']) && !array_key_exists('weighted', $this->fieldsModified)) {
            $this->fieldsModified['weighted'] = $this->data['fields']['weighted'];
        } elseif ($this->isFieldModifiedEqualTo('weighted', $value)) {
            unset($this->fieldsModified['weighted']);
        }

        $this->data['fields']['weighted'] = $value;

        return $this;
    }

    /**
     * Returns the "weighted" field.
     *
     * @return mixed The $name field.
     */
    public function getWeighted()
    {
        if (!isset($this->data['fields']['weighted'])) {
            if ($this->isNew()) {
                $this->data['fields']['weighted'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('weighted', $this->data['fields'])) {
                $this->addFieldCache('weighted');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('weighted' => 1));
                if (isset($data['weighted'])) {
                    $this->data['fields']['weighted'] = (int) $data['weighted'];
                } else {
                    $this->data['fields']['weighted'] = null;
                }
            }
        }

        return $this->data['fields']['weighted'];
    }

    /**
     * Set the "is_translated" field.
     *
     * @param mixed $value The value.
     *
     * @return \Mongodb\TranslatorTitleKeyword The document (fluent interface).
     */
    public function setIs_translated($value)
    {
        if (!isset($this->data['fields']['is_translated'])) {
            if (!$this->isNew()) {
                $this->getIs_translated();
                if ($this->isFieldEqualTo('is_translated', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['is_translated'] = null;
                $this->data['fields']['is_translated'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('is_translated', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['is_translated']) && !array_key_exists('is_translated', $this->fieldsModified)) {
            $this->fieldsModified['is_translated'] = $this->data['fields']['is_translated'];
        } elseif ($this->isFieldModifiedEqualTo('is_translated', $value)) {
            unset($this->fieldsModified['is_translated']);
        }

        $this->data['fields']['is_translated'] = $value;

        return $this;
    }

    /**
     * Returns the "is_translated" field.
     *
     * @return mixed The $name field.
     */
    public function getIs_translated()
    {
        if (!isset($this->data['fields']['is_translated'])) {
            if ($this->isNew()) {
                $this->data['fields']['is_translated'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('is_translated', $this->data['fields'])) {
                $this->addFieldCache('is_translated');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('is_translated' => 1));
                if (isset($data['is_translated'])) {
                    $this->data['fields']['is_translated'] = (int) $data['is_translated'];
                } else {
                    $this->data['fields']['is_translated'] = null;
                }
            }
        }

        return $this->data['fields']['is_translated'];
    }

    /**
     * Set the "tags" field.
     *
     * @param mixed $value The value.
     *
     * @return \Mongodb\TranslatorTitleKeyword The document (fluent interface).
     */
    public function setTags($value)
    {
        if (!isset($this->data['fields']['tags'])) {
            if (!$this->isNew()) {
                $this->getTags();
                if ($this->isFieldEqualTo('tags', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['tags'] = null;
                $this->data['fields']['tags'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('tags', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['tags']) && !array_key_exists('tags', $this->fieldsModified)) {
            $this->fieldsModified['tags'] = $this->data['fields']['tags'];
        } elseif ($this->isFieldModifiedEqualTo('tags', $value)) {
            unset($this->fieldsModified['tags']);
        }

        $this->data['fields']['tags'] = $value;

        return $this;
    }

    /**
     * Returns the "tags" field.
     *
     * @return mixed The $name field.
     */
    public function getTags()
    {
        if (!isset($this->data['fields']['tags'])) {
            if ($this->isNew()) {
                $this->data['fields']['tags'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('tags', $this->data['fields'])) {
                $this->addFieldCache('tags');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('tags' => 1));
                if (isset($data['tags'])) {
                    $this->data['fields']['tags'] = (string) $data['tags'];
                } else {
                    $this->data['fields']['tags'] = null;
                }
            }
        }

        return $this->data['fields']['tags'];
    }

    /**
     * Set the "vi_position" field.
     *
     * @param mixed $value The value.
     *
     * @return \Mongodb\TranslatorTitleKeyword The document (fluent interface).
     */
    public function setVi_position($value)
    {
        if (!isset($this->data['fields']['vi_position'])) {
            if (!$this->isNew()) {
                $this->getVi_position();
                if ($this->isFieldEqualTo('vi_position', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['vi_position'] = null;
                $this->data['fields']['vi_position'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('vi_position', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['vi_position']) && !array_key_exists('vi_position', $this->fieldsModified)) {
            $this->fieldsModified['vi_position'] = $this->data['fields']['vi_position'];
        } elseif ($this->isFieldModifiedEqualTo('vi_position', $value)) {
            unset($this->fieldsModified['vi_position']);
        }

        $this->data['fields']['vi_position'] = $value;

        return $this;
    }

    /**
     * Returns the "vi_position" field.
     *
     * @return mixed The $name field.
     */
    public function getVi_position()
    {
        if (!isset($this->data['fields']['vi_position'])) {
            if ($this->isNew()) {
                $this->data['fields']['vi_position'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('vi_position', $this->data['fields'])) {
                $this->addFieldCache('vi_position');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('vi_position' => 1));
                if (isset($data['vi_position'])) {
                    $this->data['fields']['vi_position'] = (int) $data['vi_position'];
                } else {
                    $this->data['fields']['vi_position'] = null;
                }
            }
        }

        return $this->data['fields']['vi_position'];
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
        if ('keyword_china' == $name) {
            return $this->setKeyword_china($value);
        }
        if ('keyword_vi' == $name) {
            return $this->setKeyword_vi($value);
        }
        if ('keyword_vi_sms' == $name) {
            return $this->setKeyword_vi_sms($value);
        }
        if ('full_text_search' == $name) {
            return $this->setFull_text_search($value);
        }
        if ('weighted' == $name) {
            return $this->setWeighted($value);
        }
        if ('is_translated' == $name) {
            return $this->setIs_translated($value);
        }
        if ('tags' == $name) {
            return $this->setTags($value);
        }
        if ('vi_position' == $name) {
            return $this->setVi_position($value);
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
        if ('keyword_china' == $name) {
            return $this->getKeyword_china();
        }
        if ('keyword_vi' == $name) {
            return $this->getKeyword_vi();
        }
        if ('keyword_vi_sms' == $name) {
            return $this->getKeyword_vi_sms();
        }
        if ('full_text_search' == $name) {
            return $this->getFull_text_search();
        }
        if ('weighted' == $name) {
            return $this->getWeighted();
        }
        if ('is_translated' == $name) {
            return $this->getIs_translated();
        }
        if ('tags' == $name) {
            return $this->getTags();
        }
        if ('vi_position' == $name) {
            return $this->getVi_position();
        }

        throw new \InvalidArgumentException(sprintf('The document data "%s" is not valid.', $name));
    }

    /**
     * Imports data from an array.
     *
     * @param array $array An array.
     *
     * @return \Mongodb\TranslatorTitleKeyword The document (fluent interface).
     */
    public function fromArray(array $array)
    {
        if (isset($array['id'])) {
            $this->setId($array['id']);
        }
        if (isset($array['keyword_china'])) {
            $this->setKeyword_china($array['keyword_china']);
        }
        if (isset($array['keyword_vi'])) {
            $this->setKeyword_vi($array['keyword_vi']);
        }
        if (isset($array['keyword_vi_sms'])) {
            $this->setKeyword_vi_sms($array['keyword_vi_sms']);
        }
        if (isset($array['full_text_search'])) {
            $this->setFull_text_search($array['full_text_search']);
        }
        if (isset($array['weighted'])) {
            $this->setWeighted($array['weighted']);
        }
        if (isset($array['is_translated'])) {
            $this->setIs_translated($array['is_translated']);
        }
        if (isset($array['tags'])) {
            $this->setTags($array['tags']);
        }
        if (isset($array['vi_position'])) {
            $this->setVi_position($array['vi_position']);
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

        $array['keyword_china'] = $this->getKeyword_china();
        $array['keyword_vi'] = $this->getKeyword_vi();
        $array['keyword_vi_sms'] = $this->getKeyword_vi_sms();
        $array['full_text_search'] = $this->getFull_text_search();
        $array['weighted'] = $this->getWeighted();
        $array['is_translated'] = $this->getIs_translated();
        $array['tags'] = $this->getTags();
        $array['vi_position'] = $this->getVi_position();

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
                if (isset($this->data['fields']['keyword_china'])) {
                    $query['keyword_china'] = (string) $this->data['fields']['keyword_china'];
                }
                if (isset($this->data['fields']['keyword_vi'])) {
                    $query['keyword_vi'] = (string) $this->data['fields']['keyword_vi'];
                }
                if (isset($this->data['fields']['keyword_vi_sms'])) {
                    $query['keyword_vi_sms'] = (string) $this->data['fields']['keyword_vi_sms'];
                }
                if (isset($this->data['fields']['full_text_search'])) {
                    $query['full_text_search'] = (string) $this->data['fields']['full_text_search'];
                }
                if (isset($this->data['fields']['weighted'])) {
                    $query['weighted'] = (int) $this->data['fields']['weighted'];
                }
                if (isset($this->data['fields']['is_translated'])) {
                    $query['is_translated'] = (int) $this->data['fields']['is_translated'];
                }
                if (isset($this->data['fields']['tags'])) {
                    $query['tags'] = (string) $this->data['fields']['tags'];
                }
                if (isset($this->data['fields']['vi_position'])) {
                    $query['vi_position'] = (int) $this->data['fields']['vi_position'];
                }
            } else {
                if (isset($this->data['fields']['keyword_china']) || array_key_exists('keyword_china', $this->data['fields'])) {
                    $value = $this->data['fields']['keyword_china'];
                    $originalValue = $this->getOriginalFieldValue('keyword_china');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['keyword_china'] = (string) $this->data['fields']['keyword_china'];
                        } else {
                            $query['$unset']['keyword_china'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['keyword_vi']) || array_key_exists('keyword_vi', $this->data['fields'])) {
                    $value = $this->data['fields']['keyword_vi'];
                    $originalValue = $this->getOriginalFieldValue('keyword_vi');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['keyword_vi'] = (string) $this->data['fields']['keyword_vi'];
                        } else {
                            $query['$unset']['keyword_vi'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['keyword_vi_sms']) || array_key_exists('keyword_vi_sms', $this->data['fields'])) {
                    $value = $this->data['fields']['keyword_vi_sms'];
                    $originalValue = $this->getOriginalFieldValue('keyword_vi_sms');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['keyword_vi_sms'] = (string) $this->data['fields']['keyword_vi_sms'];
                        } else {
                            $query['$unset']['keyword_vi_sms'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['full_text_search']) || array_key_exists('full_text_search', $this->data['fields'])) {
                    $value = $this->data['fields']['full_text_search'];
                    $originalValue = $this->getOriginalFieldValue('full_text_search');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['full_text_search'] = (string) $this->data['fields']['full_text_search'];
                        } else {
                            $query['$unset']['full_text_search'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['weighted']) || array_key_exists('weighted', $this->data['fields'])) {
                    $value = $this->data['fields']['weighted'];
                    $originalValue = $this->getOriginalFieldValue('weighted');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['weighted'] = (int) $this->data['fields']['weighted'];
                        } else {
                            $query['$unset']['weighted'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['is_translated']) || array_key_exists('is_translated', $this->data['fields'])) {
                    $value = $this->data['fields']['is_translated'];
                    $originalValue = $this->getOriginalFieldValue('is_translated');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['is_translated'] = (int) $this->data['fields']['is_translated'];
                        } else {
                            $query['$unset']['is_translated'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['tags']) || array_key_exists('tags', $this->data['fields'])) {
                    $value = $this->data['fields']['tags'];
                    $originalValue = $this->getOriginalFieldValue('tags');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['tags'] = (string) $this->data['fields']['tags'];
                        } else {
                            $query['$unset']['tags'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['vi_position']) || array_key_exists('vi_position', $this->data['fields'])) {
                    $value = $this->data['fields']['vi_position'];
                    $originalValue = $this->getOriginalFieldValue('vi_position');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['vi_position'] = (int) $this->data['fields']['vi_position'];
                        } else {
                            $query['$unset']['vi_position'] = 1;
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