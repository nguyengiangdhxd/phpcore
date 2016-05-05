<?php

namespace Mongodb\Base;

/**
 * Base class of Mongodb\OriginalItemVariant document.
 */
abstract class OriginalItemVariant extends \Mandango\Document\Document implements \ArrayAccess
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
     * @return \Mongodb\OriginalItemVariant The document (fluent interface).
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
        if (isset($data['uid'])) {
            $this->data['fields']['uid'] = (string) $data['uid'];
        } elseif (isset($data['_fields']['uid'])) {
            $this->data['fields']['uid'] = null;
        }
        if (isset($data['originItemId'])) {
            $this->data['fields']['originItemId'] = (string) $data['originItemId'];
        } elseif (isset($data['_fields']['originItemId'])) {
            $this->data['fields']['originItemId'] = null;
        }
        if (isset($data['originId'])) {
            $this->data['fields']['originId'] = (string) $data['originId'];
        } elseif (isset($data['_fields']['originId'])) {
            $this->data['fields']['originId'] = null;
        }
        if (isset($data['inventoryQuantity'])) {
            $this->data['fields']['inventoryQuantity'] = (int) $data['inventoryQuantity'];
        } elseif (isset($data['_fields']['inventoryQuantity'])) {
            $this->data['fields']['inventoryQuantity'] = null;
        }
        if (isset($data['salePrice'])) {
            $this->data['fields']['salePrice'] = (float) $data['salePrice'];
        } elseif (isset($data['_fields']['salePrice'])) {
            $this->data['fields']['salePrice'] = null;
        }
        if (isset($data['hasOption'])) {
            $this->data['fields']['hasOption'] = (string) $data['hasOption'];
        } elseif (isset($data['_fields']['hasOption'])) {
            $this->data['fields']['hasOption'] = null;
        }
        if (isset($data['price'])) {
            $this->data['fields']['price'] = (float) $data['price'];
        } elseif (isset($data['_fields']['price'])) {
            $this->data['fields']['price'] = null;
        }
        if (isset($data['pricesTable'])) {
            $this->data['fields']['pricesTable'] = $data['pricesTable'];
        } elseif (isset($data['_fields']['pricesTable'])) {
            $this->data['fields']['pricesTable'] = null;
        }
        if (isset($data['optKeys'])) {
            $this->data['fields']['optKeys'] = $data['optKeys'];
        } elseif (isset($data['_fields']['optKeys'])) {
            $this->data['fields']['optKeys'] = null;
        }
        if (isset($data['image'])) {
            $this->data['fields']['image'] = (string) $data['image'];
        } elseif (isset($data['_fields']['image'])) {
            $this->data['fields']['image'] = null;
        }
        if (isset($data['checksum'])) {
            $this->data['fields']['checksum'] = (string) $data['checksum'];
        } elseif (isset($data['_fields']['checksum'])) {
            $this->data['fields']['checksum'] = null;
        }
        if (isset($data['createdTime'])) {
            $this->data['fields']['createdTime'] = new \DateTime(); $this->data['fields']['createdTime']->setTimestamp($data['createdTime']->sec);
        } elseif (isset($data['_fields']['createdTime'])) {
            $this->data['fields']['createdTime'] = null;
        }
        if (isset($data['modifiedTime'])) {
            $this->data['fields']['modifiedTime'] = new \DateTime(); $this->data['fields']['modifiedTime']->setTimestamp($data['modifiedTime']->sec);
        } elseif (isset($data['_fields']['modifiedTime'])) {
            $this->data['fields']['modifiedTime'] = null;
        }

        return $this;
    }

    /**
     * Set the "uid" field.
     *
     * @param mixed $value The value.
     *
     * @return \Mongodb\OriginalItemVariant The document (fluent interface).
     */
    public function setUid($value)
    {
        if (!isset($this->data['fields']['uid'])) {
            if (!$this->isNew()) {
                $this->getUid();
                if ($this->isFieldEqualTo('uid', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['uid'] = null;
                $this->data['fields']['uid'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('uid', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['uid']) && !array_key_exists('uid', $this->fieldsModified)) {
            $this->fieldsModified['uid'] = $this->data['fields']['uid'];
        } elseif ($this->isFieldModifiedEqualTo('uid', $value)) {
            unset($this->fieldsModified['uid']);
        }

        $this->data['fields']['uid'] = $value;

        return $this;
    }

    /**
     * Returns the "uid" field.
     *
     * @return mixed The $name field.
     */
    public function getUid()
    {
        if (!isset($this->data['fields']['uid'])) {
            if ($this->isNew()) {
                $this->data['fields']['uid'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('uid', $this->data['fields'])) {
                $this->addFieldCache('uid');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('uid' => 1));
                if (isset($data['uid'])) {
                    $this->data['fields']['uid'] = (string) $data['uid'];
                } else {
                    $this->data['fields']['uid'] = null;
                }
            }
        }

        return $this->data['fields']['uid'];
    }

    /**
     * Set the "originItemId" field.
     *
     * @param mixed $value The value.
     *
     * @return \Mongodb\OriginalItemVariant The document (fluent interface).
     */
    public function setOriginItemId($value)
    {
        if (!isset($this->data['fields']['originItemId'])) {
            if (!$this->isNew()) {
                $this->getOriginItemId();
                if ($this->isFieldEqualTo('originItemId', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['originItemId'] = null;
                $this->data['fields']['originItemId'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('originItemId', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['originItemId']) && !array_key_exists('originItemId', $this->fieldsModified)) {
            $this->fieldsModified['originItemId'] = $this->data['fields']['originItemId'];
        } elseif ($this->isFieldModifiedEqualTo('originItemId', $value)) {
            unset($this->fieldsModified['originItemId']);
        }

        $this->data['fields']['originItemId'] = $value;

        return $this;
    }

    /**
     * Returns the "originItemId" field.
     *
     * @return mixed The $name field.
     */
    public function getOriginItemId()
    {
        if (!isset($this->data['fields']['originItemId'])) {
            if ($this->isNew()) {
                $this->data['fields']['originItemId'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('originItemId', $this->data['fields'])) {
                $this->addFieldCache('originItemId');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('originItemId' => 1));
                if (isset($data['originItemId'])) {
                    $this->data['fields']['originItemId'] = (string) $data['originItemId'];
                } else {
                    $this->data['fields']['originItemId'] = null;
                }
            }
        }

        return $this->data['fields']['originItemId'];
    }

    /**
     * Set the "originId" field.
     *
     * @param mixed $value The value.
     *
     * @return \Mongodb\OriginalItemVariant The document (fluent interface).
     */
    public function setOriginId($value)
    {
        if (!isset($this->data['fields']['originId'])) {
            if (!$this->isNew()) {
                $this->getOriginId();
                if ($this->isFieldEqualTo('originId', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['originId'] = null;
                $this->data['fields']['originId'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('originId', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['originId']) && !array_key_exists('originId', $this->fieldsModified)) {
            $this->fieldsModified['originId'] = $this->data['fields']['originId'];
        } elseif ($this->isFieldModifiedEqualTo('originId', $value)) {
            unset($this->fieldsModified['originId']);
        }

        $this->data['fields']['originId'] = $value;

        return $this;
    }

    /**
     * Returns the "originId" field.
     *
     * @return mixed The $name field.
     */
    public function getOriginId()
    {
        if (!isset($this->data['fields']['originId'])) {
            if ($this->isNew()) {
                $this->data['fields']['originId'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('originId', $this->data['fields'])) {
                $this->addFieldCache('originId');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('originId' => 1));
                if (isset($data['originId'])) {
                    $this->data['fields']['originId'] = (string) $data['originId'];
                } else {
                    $this->data['fields']['originId'] = null;
                }
            }
        }

        return $this->data['fields']['originId'];
    }

    /**
     * Set the "inventoryQuantity" field.
     *
     * @param mixed $value The value.
     *
     * @return \Mongodb\OriginalItemVariant The document (fluent interface).
     */
    public function setInventoryQuantity($value)
    {
        if (!isset($this->data['fields']['inventoryQuantity'])) {
            if (!$this->isNew()) {
                $this->getInventoryQuantity();
                if ($this->isFieldEqualTo('inventoryQuantity', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['inventoryQuantity'] = null;
                $this->data['fields']['inventoryQuantity'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('inventoryQuantity', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['inventoryQuantity']) && !array_key_exists('inventoryQuantity', $this->fieldsModified)) {
            $this->fieldsModified['inventoryQuantity'] = $this->data['fields']['inventoryQuantity'];
        } elseif ($this->isFieldModifiedEqualTo('inventoryQuantity', $value)) {
            unset($this->fieldsModified['inventoryQuantity']);
        }

        $this->data['fields']['inventoryQuantity'] = $value;

        return $this;
    }

    /**
     * Returns the "inventoryQuantity" field.
     *
     * @return mixed The $name field.
     */
    public function getInventoryQuantity()
    {
        if (!isset($this->data['fields']['inventoryQuantity'])) {
            if ($this->isNew()) {
                $this->data['fields']['inventoryQuantity'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('inventoryQuantity', $this->data['fields'])) {
                $this->addFieldCache('inventoryQuantity');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('inventoryQuantity' => 1));
                if (isset($data['inventoryQuantity'])) {
                    $this->data['fields']['inventoryQuantity'] = (int) $data['inventoryQuantity'];
                } else {
                    $this->data['fields']['inventoryQuantity'] = null;
                }
            }
        }

        return $this->data['fields']['inventoryQuantity'];
    }

    /**
     * Set the "salePrice" field.
     *
     * @param mixed $value The value.
     *
     * @return \Mongodb\OriginalItemVariant The document (fluent interface).
     */
    public function setSalePrice($value)
    {
        if (!isset($this->data['fields']['salePrice'])) {
            if (!$this->isNew()) {
                $this->getSalePrice();
                if ($this->isFieldEqualTo('salePrice', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['salePrice'] = null;
                $this->data['fields']['salePrice'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('salePrice', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['salePrice']) && !array_key_exists('salePrice', $this->fieldsModified)) {
            $this->fieldsModified['salePrice'] = $this->data['fields']['salePrice'];
        } elseif ($this->isFieldModifiedEqualTo('salePrice', $value)) {
            unset($this->fieldsModified['salePrice']);
        }

        $this->data['fields']['salePrice'] = $value;

        return $this;
    }

    /**
     * Returns the "salePrice" field.
     *
     * @return mixed The $name field.
     */
    public function getSalePrice()
    {
        if (!isset($this->data['fields']['salePrice'])) {
            if ($this->isNew()) {
                $this->data['fields']['salePrice'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('salePrice', $this->data['fields'])) {
                $this->addFieldCache('salePrice');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('salePrice' => 1));
                if (isset($data['salePrice'])) {
                    $this->data['fields']['salePrice'] = (float) $data['salePrice'];
                } else {
                    $this->data['fields']['salePrice'] = null;
                }
            }
        }

        return $this->data['fields']['salePrice'];
    }

    /**
     * Set the "hasOption" field.
     *
     * @param mixed $value The value.
     *
     * @return \Mongodb\OriginalItemVariant The document (fluent interface).
     */
    public function setHasOption($value)
    {
        if (!isset($this->data['fields']['hasOption'])) {
            if (!$this->isNew()) {
                $this->getHasOption();
                if ($this->isFieldEqualTo('hasOption', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['hasOption'] = null;
                $this->data['fields']['hasOption'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('hasOption', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['hasOption']) && !array_key_exists('hasOption', $this->fieldsModified)) {
            $this->fieldsModified['hasOption'] = $this->data['fields']['hasOption'];
        } elseif ($this->isFieldModifiedEqualTo('hasOption', $value)) {
            unset($this->fieldsModified['hasOption']);
        }

        $this->data['fields']['hasOption'] = $value;

        return $this;
    }

    /**
     * Returns the "hasOption" field.
     *
     * @return mixed The $name field.
     */
    public function getHasOption()
    {
        if (!isset($this->data['fields']['hasOption'])) {
            if ($this->isNew()) {
                $this->data['fields']['hasOption'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('hasOption', $this->data['fields'])) {
                $this->addFieldCache('hasOption');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('hasOption' => 1));
                if (isset($data['hasOption'])) {
                    $this->data['fields']['hasOption'] = (string) $data['hasOption'];
                } else {
                    $this->data['fields']['hasOption'] = null;
                }
            }
        }

        return $this->data['fields']['hasOption'];
    }

    /**
     * Set the "price" field.
     *
     * @param mixed $value The value.
     *
     * @return \Mongodb\OriginalItemVariant The document (fluent interface).
     */
    public function setPrice($value)
    {
        if (!isset($this->data['fields']['price'])) {
            if (!$this->isNew()) {
                $this->getPrice();
                if ($this->isFieldEqualTo('price', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['price'] = null;
                $this->data['fields']['price'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('price', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['price']) && !array_key_exists('price', $this->fieldsModified)) {
            $this->fieldsModified['price'] = $this->data['fields']['price'];
        } elseif ($this->isFieldModifiedEqualTo('price', $value)) {
            unset($this->fieldsModified['price']);
        }

        $this->data['fields']['price'] = $value;

        return $this;
    }

    /**
     * Returns the "price" field.
     *
     * @return mixed The $name field.
     */
    public function getPrice()
    {
        if (!isset($this->data['fields']['price'])) {
            if ($this->isNew()) {
                $this->data['fields']['price'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('price', $this->data['fields'])) {
                $this->addFieldCache('price');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('price' => 1));
                if (isset($data['price'])) {
                    $this->data['fields']['price'] = (float) $data['price'];
                } else {
                    $this->data['fields']['price'] = null;
                }
            }
        }

        return $this->data['fields']['price'];
    }

    /**
     * Set the "pricesTable" field.
     *
     * @param mixed $value The value.
     *
     * @return \Mongodb\OriginalItemVariant The document (fluent interface).
     */
    public function setPricesTable($value)
    {
        if (!isset($this->data['fields']['pricesTable'])) {
            if (!$this->isNew()) {
                $this->getPricesTable();
                if ($this->isFieldEqualTo('pricesTable', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['pricesTable'] = null;
                $this->data['fields']['pricesTable'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('pricesTable', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['pricesTable']) && !array_key_exists('pricesTable', $this->fieldsModified)) {
            $this->fieldsModified['pricesTable'] = $this->data['fields']['pricesTable'];
        } elseif ($this->isFieldModifiedEqualTo('pricesTable', $value)) {
            unset($this->fieldsModified['pricesTable']);
        }

        $this->data['fields']['pricesTable'] = $value;

        return $this;
    }

    /**
     * Returns the "pricesTable" field.
     *
     * @return mixed The $name field.
     */
    public function getPricesTable()
    {
        if (!isset($this->data['fields']['pricesTable'])) {
            if ($this->isNew()) {
                $this->data['fields']['pricesTable'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('pricesTable', $this->data['fields'])) {
                $this->addFieldCache('pricesTable');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('pricesTable' => 1));
                if (isset($data['pricesTable'])) {
                    $this->data['fields']['pricesTable'] = $data['pricesTable'];
                } else {
                    $this->data['fields']['pricesTable'] = null;
                }
            }
        }

        return $this->data['fields']['pricesTable'];
    }

    /**
     * Set the "optKeys" field.
     *
     * @param mixed $value The value.
     *
     * @return \Mongodb\OriginalItemVariant The document (fluent interface).
     */
    public function setOptKeys($value)
    {
        if (!isset($this->data['fields']['optKeys'])) {
            if (!$this->isNew()) {
                $this->getOptKeys();
                if ($this->isFieldEqualTo('optKeys', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['optKeys'] = null;
                $this->data['fields']['optKeys'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('optKeys', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['optKeys']) && !array_key_exists('optKeys', $this->fieldsModified)) {
            $this->fieldsModified['optKeys'] = $this->data['fields']['optKeys'];
        } elseif ($this->isFieldModifiedEqualTo('optKeys', $value)) {
            unset($this->fieldsModified['optKeys']);
        }

        $this->data['fields']['optKeys'] = $value;

        return $this;
    }

    /**
     * Returns the "optKeys" field.
     *
     * @return mixed The $name field.
     */
    public function getOptKeys()
    {
        if (!isset($this->data['fields']['optKeys'])) {
            if ($this->isNew()) {
                $this->data['fields']['optKeys'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('optKeys', $this->data['fields'])) {
                $this->addFieldCache('optKeys');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('optKeys' => 1));
                if (isset($data['optKeys'])) {
                    $this->data['fields']['optKeys'] = $data['optKeys'];
                } else {
                    $this->data['fields']['optKeys'] = null;
                }
            }
        }

        return $this->data['fields']['optKeys'];
    }

    /**
     * Set the "image" field.
     *
     * @param mixed $value The value.
     *
     * @return \Mongodb\OriginalItemVariant The document (fluent interface).
     */
    public function setImage($value)
    {
        if (!isset($this->data['fields']['image'])) {
            if (!$this->isNew()) {
                $this->getImage();
                if ($this->isFieldEqualTo('image', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['image'] = null;
                $this->data['fields']['image'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('image', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['image']) && !array_key_exists('image', $this->fieldsModified)) {
            $this->fieldsModified['image'] = $this->data['fields']['image'];
        } elseif ($this->isFieldModifiedEqualTo('image', $value)) {
            unset($this->fieldsModified['image']);
        }

        $this->data['fields']['image'] = $value;

        return $this;
    }

    /**
     * Returns the "image" field.
     *
     * @return mixed The $name field.
     */
    public function getImage()
    {
        if (!isset($this->data['fields']['image'])) {
            if ($this->isNew()) {
                $this->data['fields']['image'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('image', $this->data['fields'])) {
                $this->addFieldCache('image');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('image' => 1));
                if (isset($data['image'])) {
                    $this->data['fields']['image'] = (string) $data['image'];
                } else {
                    $this->data['fields']['image'] = null;
                }
            }
        }

        return $this->data['fields']['image'];
    }

    /**
     * Set the "checksum" field.
     *
     * @param mixed $value The value.
     *
     * @return \Mongodb\OriginalItemVariant The document (fluent interface).
     */
    public function setChecksum($value)
    {
        if (!isset($this->data['fields']['checksum'])) {
            if (!$this->isNew()) {
                $this->getChecksum();
                if ($this->isFieldEqualTo('checksum', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['checksum'] = null;
                $this->data['fields']['checksum'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('checksum', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['checksum']) && !array_key_exists('checksum', $this->fieldsModified)) {
            $this->fieldsModified['checksum'] = $this->data['fields']['checksum'];
        } elseif ($this->isFieldModifiedEqualTo('checksum', $value)) {
            unset($this->fieldsModified['checksum']);
        }

        $this->data['fields']['checksum'] = $value;

        return $this;
    }

    /**
     * Returns the "checksum" field.
     *
     * @return mixed The $name field.
     */
    public function getChecksum()
    {
        if (!isset($this->data['fields']['checksum'])) {
            if ($this->isNew()) {
                $this->data['fields']['checksum'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('checksum', $this->data['fields'])) {
                $this->addFieldCache('checksum');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('checksum' => 1));
                if (isset($data['checksum'])) {
                    $this->data['fields']['checksum'] = (string) $data['checksum'];
                } else {
                    $this->data['fields']['checksum'] = null;
                }
            }
        }

        return $this->data['fields']['checksum'];
    }

    /**
     * Set the "createdTime" field.
     *
     * @param mixed $value The value.
     *
     * @return \Mongodb\OriginalItemVariant The document (fluent interface).
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
     * Set the "modifiedTime" field.
     *
     * @param mixed $value The value.
     *
     * @return \Mongodb\OriginalItemVariant The document (fluent interface).
     */
    public function setModifiedTime($value)
    {
        if (!isset($this->data['fields']['modifiedTime'])) {
            if (!$this->isNew()) {
                $this->getModifiedTime();
                if ($this->isFieldEqualTo('modifiedTime', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['modifiedTime'] = null;
                $this->data['fields']['modifiedTime'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('modifiedTime', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['modifiedTime']) && !array_key_exists('modifiedTime', $this->fieldsModified)) {
            $this->fieldsModified['modifiedTime'] = $this->data['fields']['modifiedTime'];
        } elseif ($this->isFieldModifiedEqualTo('modifiedTime', $value)) {
            unset($this->fieldsModified['modifiedTime']);
        }

        $this->data['fields']['modifiedTime'] = $value;

        return $this;
    }

    /**
     * Returns the "modifiedTime" field.
     *
     * @return mixed The $name field.
     */
    public function getModifiedTime()
    {
        if (!isset($this->data['fields']['modifiedTime'])) {
            if ($this->isNew()) {
                $this->data['fields']['modifiedTime'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('modifiedTime', $this->data['fields'])) {
                $this->addFieldCache('modifiedTime');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('modifiedTime' => 1));
                if (isset($data['modifiedTime'])) {
                    $this->data['fields']['modifiedTime'] = new \DateTime(); $this->data['fields']['modifiedTime']->setTimestamp($data['modifiedTime']->sec);
                } else {
                    $this->data['fields']['modifiedTime'] = null;
                }
            }
        }

        return $this->data['fields']['modifiedTime'];
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
        if ('uid' == $name) {
            return $this->setUid($value);
        }
        if ('originItemId' == $name) {
            return $this->setOriginItemId($value);
        }
        if ('originId' == $name) {
            return $this->setOriginId($value);
        }
        if ('inventoryQuantity' == $name) {
            return $this->setInventoryQuantity($value);
        }
        if ('salePrice' == $name) {
            return $this->setSalePrice($value);
        }
        if ('hasOption' == $name) {
            return $this->setHasOption($value);
        }
        if ('price' == $name) {
            return $this->setPrice($value);
        }
        if ('pricesTable' == $name) {
            return $this->setPricesTable($value);
        }
        if ('optKeys' == $name) {
            return $this->setOptKeys($value);
        }
        if ('image' == $name) {
            return $this->setImage($value);
        }
        if ('checksum' == $name) {
            return $this->setChecksum($value);
        }
        if ('createdTime' == $name) {
            return $this->setCreatedTime($value);
        }
        if ('modifiedTime' == $name) {
            return $this->setModifiedTime($value);
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
        if ('uid' == $name) {
            return $this->getUid();
        }
        if ('originItemId' == $name) {
            return $this->getOriginItemId();
        }
        if ('originId' == $name) {
            return $this->getOriginId();
        }
        if ('inventoryQuantity' == $name) {
            return $this->getInventoryQuantity();
        }
        if ('salePrice' == $name) {
            return $this->getSalePrice();
        }
        if ('hasOption' == $name) {
            return $this->getHasOption();
        }
        if ('price' == $name) {
            return $this->getPrice();
        }
        if ('pricesTable' == $name) {
            return $this->getPricesTable();
        }
        if ('optKeys' == $name) {
            return $this->getOptKeys();
        }
        if ('image' == $name) {
            return $this->getImage();
        }
        if ('checksum' == $name) {
            return $this->getChecksum();
        }
        if ('createdTime' == $name) {
            return $this->getCreatedTime();
        }
        if ('modifiedTime' == $name) {
            return $this->getModifiedTime();
        }

        throw new \InvalidArgumentException(sprintf('The document data "%s" is not valid.', $name));
    }

    /**
     * Imports data from an array.
     *
     * @param array $array An array.
     *
     * @return \Mongodb\OriginalItemVariant The document (fluent interface).
     */
    public function fromArray(array $array)
    {
        if (isset($array['id'])) {
            $this->setId($array['id']);
        }
        if (isset($array['uid'])) {
            $this->setUid($array['uid']);
        }
        if (isset($array['originItemId'])) {
            $this->setOriginItemId($array['originItemId']);
        }
        if (isset($array['originId'])) {
            $this->setOriginId($array['originId']);
        }
        if (isset($array['inventoryQuantity'])) {
            $this->setInventoryQuantity($array['inventoryQuantity']);
        }
        if (isset($array['salePrice'])) {
            $this->setSalePrice($array['salePrice']);
        }
        if (isset($array['hasOption'])) {
            $this->setHasOption($array['hasOption']);
        }
        if (isset($array['price'])) {
            $this->setPrice($array['price']);
        }
        if (isset($array['pricesTable'])) {
            $this->setPricesTable($array['pricesTable']);
        }
        if (isset($array['optKeys'])) {
            $this->setOptKeys($array['optKeys']);
        }
        if (isset($array['image'])) {
            $this->setImage($array['image']);
        }
        if (isset($array['checksum'])) {
            $this->setChecksum($array['checksum']);
        }
        if (isset($array['createdTime'])) {
            $this->setCreatedTime($array['createdTime']);
        }
        if (isset($array['modifiedTime'])) {
            $this->setModifiedTime($array['modifiedTime']);
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

        $array['uid'] = $this->getUid();
        $array['originItemId'] = $this->getOriginItemId();
        $array['originId'] = $this->getOriginId();
        $array['inventoryQuantity'] = $this->getInventoryQuantity();
        $array['salePrice'] = $this->getSalePrice();
        $array['hasOption'] = $this->getHasOption();
        $array['price'] = $this->getPrice();
        $array['pricesTable'] = $this->getPricesTable();
        $array['optKeys'] = $this->getOptKeys();
        $array['image'] = $this->getImage();
        $array['checksum'] = $this->getChecksum();
        $array['createdTime'] = $this->getCreatedTime();
        $array['modifiedTime'] = $this->getModifiedTime();

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
                if (isset($this->data['fields']['uid'])) {
                    $query['uid'] = (string) $this->data['fields']['uid'];
                }
                if (isset($this->data['fields']['originItemId'])) {
                    $query['originItemId'] = (string) $this->data['fields']['originItemId'];
                }
                if (isset($this->data['fields']['originId'])) {
                    $query['originId'] = (string) $this->data['fields']['originId'];
                }
                if (isset($this->data['fields']['inventoryQuantity'])) {
                    $query['inventoryQuantity'] = (int) $this->data['fields']['inventoryQuantity'];
                }
                if (isset($this->data['fields']['salePrice'])) {
                    $query['salePrice'] = (float) $this->data['fields']['salePrice'];
                }
                if (isset($this->data['fields']['hasOption'])) {
                    $query['hasOption'] = (string) $this->data['fields']['hasOption'];
                }
                if (isset($this->data['fields']['price'])) {
                    $query['price'] = (float) $this->data['fields']['price'];
                }
                if (isset($this->data['fields']['pricesTable'])) {
                    $query['pricesTable'] = $this->data['fields']['pricesTable'];
                }
                if (isset($this->data['fields']['optKeys'])) {
                    $query['optKeys'] = $this->data['fields']['optKeys'];
                }
                if (isset($this->data['fields']['image'])) {
                    $query['image'] = (string) $this->data['fields']['image'];
                }
                if (isset($this->data['fields']['checksum'])) {
                    $query['checksum'] = (string) $this->data['fields']['checksum'];
                }
                if (isset($this->data['fields']['createdTime'])) {
                    $query['createdTime'] = $this->data['fields']['createdTime']; if ($query['createdTime'] instanceof \DateTime) { $query['createdTime'] = $this->data['fields']['createdTime']->getTimestamp(); } elseif (is_string($query['createdTime'])) { $query['createdTime'] = strtotime($this->data['fields']['createdTime']); } $query['createdTime'] = new \MongoDate($query['createdTime']);
                }
                if (isset($this->data['fields']['modifiedTime'])) {
                    $query['modifiedTime'] = $this->data['fields']['modifiedTime']; if ($query['modifiedTime'] instanceof \DateTime) { $query['modifiedTime'] = $this->data['fields']['modifiedTime']->getTimestamp(); } elseif (is_string($query['modifiedTime'])) { $query['modifiedTime'] = strtotime($this->data['fields']['modifiedTime']); } $query['modifiedTime'] = new \MongoDate($query['modifiedTime']);
                }
            } else {
                if (isset($this->data['fields']['uid']) || array_key_exists('uid', $this->data['fields'])) {
                    $value = $this->data['fields']['uid'];
                    $originalValue = $this->getOriginalFieldValue('uid');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['uid'] = (string) $this->data['fields']['uid'];
                        } else {
                            $query['$unset']['uid'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['originItemId']) || array_key_exists('originItemId', $this->data['fields'])) {
                    $value = $this->data['fields']['originItemId'];
                    $originalValue = $this->getOriginalFieldValue('originItemId');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['originItemId'] = (string) $this->data['fields']['originItemId'];
                        } else {
                            $query['$unset']['originItemId'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['originId']) || array_key_exists('originId', $this->data['fields'])) {
                    $value = $this->data['fields']['originId'];
                    $originalValue = $this->getOriginalFieldValue('originId');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['originId'] = (string) $this->data['fields']['originId'];
                        } else {
                            $query['$unset']['originId'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['inventoryQuantity']) || array_key_exists('inventoryQuantity', $this->data['fields'])) {
                    $value = $this->data['fields']['inventoryQuantity'];
                    $originalValue = $this->getOriginalFieldValue('inventoryQuantity');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['inventoryQuantity'] = (int) $this->data['fields']['inventoryQuantity'];
                        } else {
                            $query['$unset']['inventoryQuantity'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['salePrice']) || array_key_exists('salePrice', $this->data['fields'])) {
                    $value = $this->data['fields']['salePrice'];
                    $originalValue = $this->getOriginalFieldValue('salePrice');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['salePrice'] = (float) $this->data['fields']['salePrice'];
                        } else {
                            $query['$unset']['salePrice'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['hasOption']) || array_key_exists('hasOption', $this->data['fields'])) {
                    $value = $this->data['fields']['hasOption'];
                    $originalValue = $this->getOriginalFieldValue('hasOption');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['hasOption'] = (string) $this->data['fields']['hasOption'];
                        } else {
                            $query['$unset']['hasOption'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['price']) || array_key_exists('price', $this->data['fields'])) {
                    $value = $this->data['fields']['price'];
                    $originalValue = $this->getOriginalFieldValue('price');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['price'] = (float) $this->data['fields']['price'];
                        } else {
                            $query['$unset']['price'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['pricesTable']) || array_key_exists('pricesTable', $this->data['fields'])) {
                    $value = $this->data['fields']['pricesTable'];
                    $originalValue = $this->getOriginalFieldValue('pricesTable');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['pricesTable'] = $this->data['fields']['pricesTable'];
                        } else {
                            $query['$unset']['pricesTable'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['optKeys']) || array_key_exists('optKeys', $this->data['fields'])) {
                    $value = $this->data['fields']['optKeys'];
                    $originalValue = $this->getOriginalFieldValue('optKeys');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['optKeys'] = $this->data['fields']['optKeys'];
                        } else {
                            $query['$unset']['optKeys'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['image']) || array_key_exists('image', $this->data['fields'])) {
                    $value = $this->data['fields']['image'];
                    $originalValue = $this->getOriginalFieldValue('image');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['image'] = (string) $this->data['fields']['image'];
                        } else {
                            $query['$unset']['image'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['checksum']) || array_key_exists('checksum', $this->data['fields'])) {
                    $value = $this->data['fields']['checksum'];
                    $originalValue = $this->getOriginalFieldValue('checksum');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['checksum'] = (string) $this->data['fields']['checksum'];
                        } else {
                            $query['$unset']['checksum'] = 1;
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
                if (isset($this->data['fields']['modifiedTime']) || array_key_exists('modifiedTime', $this->data['fields'])) {
                    $value = $this->data['fields']['modifiedTime'];
                    $originalValue = $this->getOriginalFieldValue('modifiedTime');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['modifiedTime'] = $this->data['fields']['modifiedTime']; if ($query['$set']['modifiedTime'] instanceof \DateTime) { $query['$set']['modifiedTime'] = $this->data['fields']['modifiedTime']->getTimestamp(); } elseif (is_string($query['$set']['modifiedTime'])) { $query['$set']['modifiedTime'] = strtotime($this->data['fields']['modifiedTime']); } $query['$set']['modifiedTime'] = new \MongoDate($query['$set']['modifiedTime']);
                        } else {
                            $query['$unset']['modifiedTime'] = 1;
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