<?php

namespace Mongodb\Base;

/**
 * Base class of Mongodb\Items document.
 */
abstract class Items extends \Mandango\Document\Document implements \ArrayAccess
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
     * @return \Mongodb\Items The document (fluent interface).
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
        if (isset($data['titleOrigin'])) {
            $this->data['fields']['titleOrigin'] = (string) $data['titleOrigin'];
        } elseif (isset($data['_fields']['titleOrigin'])) {
            $this->data['fields']['titleOrigin'] = null;
        }
        if (isset($data['syncProcess'])) {
            $this->data['fields']['syncProcess'] = (bool) $data['syncProcess'];
        } elseif (isset($data['_fields']['syncProcess'])) {
            $this->data['fields']['syncProcess'] = null;
        }
        if (isset($data['homeLand'])) {
            $this->data['fields']['homeLand'] = (string) $data['homeLand'];
        } elseif (isset($data['_fields']['homeLand'])) {
            $this->data['fields']['homeLand'] = null;
        }
        if (isset($data['title'])) {
            $this->data['fields']['title'] = (string) $data['title'];
        } elseif (isset($data['_fields']['title'])) {
            $this->data['fields']['title'] = null;
        }
        if (isset($data['images'])) {
            $this->data['fields']['images'] = $data['images'];
        } elseif (isset($data['_fields']['images'])) {
            $this->data['fields']['images'] = null;
        }
        if (isset($data['imagesResponse'])) {
            $this->data['fields']['imagesResponse'] = $data['imagesResponse'];
        } elseif (isset($data['_fields']['imagesResponse'])) {
            $this->data['fields']['imagesResponse'] = null;
        }
        if (isset($data['specifications'])) {
            $this->data['fields']['specifications'] = $data['specifications'];
        } elseif (isset($data['_fields']['specifications'])) {
            $this->data['fields']['specifications'] = null;
        }
        if (isset($data['itemLocation'])) {
            $this->data['fields']['itemLocation'] = (string) $data['itemLocation'];
        } elseif (isset($data['_fields']['itemLocation'])) {
            $this->data['fields']['itemLocation'] = null;
        }
        if (isset($data['options'])) {
            $this->data['fields']['options'] = $data['options'];
        } elseif (isset($data['_fields']['options'])) {
            $this->data['fields']['options'] = null;
        }
        if (isset($data['minOriginPrice'])) {
            $this->data['fields']['minOriginPrice'] = (float) $data['minOriginPrice'];
        } elseif (isset($data['_fields']['minOriginPrice'])) {
            $this->data['fields']['minOriginPrice'] = null;
        }
        if (isset($data['maxOriginPrice'])) {
            $this->data['fields']['maxOriginPrice'] = (float) $data['maxOriginPrice'];
        } elseif (isset($data['_fields']['maxOriginPrice'])) {
            $this->data['fields']['maxOriginPrice'] = null;
        }
        if (isset($data['pricesTable'])) {
            $this->data['fields']['pricesTable'] = $data['pricesTable'];
        } elseif (isset($data['_fields']['pricesTable'])) {
            $this->data['fields']['pricesTable'] = null;
        }
        if (isset($data['quantitySteps'])) {
            $this->data['fields']['quantitySteps'] = (int) $data['quantitySteps'];
        } elseif (isset($data['_fields']['quantitySteps'])) {
            $this->data['fields']['quantitySteps'] = null;
        }
        if (isset($data['bodyImages'])) {
            $this->data['fields']['bodyImages'] = $data['bodyImages'];
        } elseif (isset($data['_fields']['bodyImages'])) {
            $this->data['fields']['bodyImages'] = null;
        }
        if (isset($data['hasDiscount'])) {
            $this->data['fields']['hasDiscount'] = (bool) $data['hasDiscount'];
        } elseif (isset($data['_fields']['hasDiscount'])) {
            $this->data['fields']['hasDiscount'] = null;
        }
        if (isset($data['sellerName'])) {
            $this->data['fields']['sellerName'] = (string) $data['sellerName'];
        } elseif (isset($data['_fields']['sellerName'])) {
            $this->data['fields']['sellerName'] = null;
        }
        if (isset($data['sellerId'])) {
            $this->data['fields']['sellerId'] = (string) $data['sellerId'];
        } elseif (isset($data['_fields']['sellerId'])) {
            $this->data['fields']['sellerId'] = null;
        }
        if (isset($data['sellerHomeUrl'])) {
            $this->data['fields']['sellerHomeUrl'] = (string) $data['sellerHomeUrl'];
        } elseif (isset($data['_fields']['sellerHomeUrl'])) {
            $this->data['fields']['sellerHomeUrl'] = null;
        }
        if (isset($data['sellerImage'])) {
            $this->data['fields']['sellerImage'] = (string) $data['sellerImage'];
        } elseif (isset($data['_fields']['sellerImage'])) {
            $this->data['fields']['sellerImage'] = null;
        }
        if (isset($data['sellerPolicy'])) {
            $this->data['fields']['sellerPolicy'] = (string) $data['sellerPolicy'];
        } elseif (isset($data['_fields']['sellerPolicy'])) {
            $this->data['fields']['sellerPolicy'] = null;
        }
        if (isset($data['sellerRequireMin'])) {
            $this->data['fields']['sellerRequireMin'] = (int) $data['sellerRequireMin'];
        } elseif (isset($data['_fields']['sellerRequireMin'])) {
            $this->data['fields']['sellerRequireMin'] = null;
        }
        if (isset($data['originalLink'])) {
            $this->data['fields']['originalLink'] = (string) $data['originalLink'];
        } elseif (isset($data['_fields']['originalLink'])) {
            $this->data['fields']['originalLink'] = null;
        }
        if (isset($data['checksum'])) {
            $this->data['fields']['checksum'] = (string) $data['checksum'];
        } elseif (isset($data['_fields']['checksum'])) {
            $this->data['fields']['checksum'] = null;
        }
        if (isset($data['integrationItems'])) {
            $this->data['fields']['integrationItems'] = $data['integrationItems'];
        } elseif (isset($data['_fields']['integrationItems'])) {
            $this->data['fields']['integrationItems'] = null;
        }
        if (isset($data['lastUpdateFromSource'])) {
            $this->data['fields']['lastUpdateFromSource'] = new \DateTime(); $this->data['fields']['lastUpdateFromSource']->setTimestamp($data['lastUpdateFromSource']->sec);
        } elseif (isset($data['_fields']['lastUpdateFromSource'])) {
            $this->data['fields']['lastUpdateFromSource'] = null;
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
        if (isset($data['isActive'])) {
            $this->data['fields']['isActive'] = (string) $data['isActive'];
        } elseif (isset($data['_fields']['isActive'])) {
            $this->data['fields']['isActive'] = null;
        }
        if (isset($data['isDeleted'])) {
            $this->data['fields']['isDeleted'] = (bool) $data['isDeleted'];
        } elseif (isset($data['_fields']['isDeleted'])) {
            $this->data['fields']['isDeleted'] = null;
        }
        if (isset($data['minPriceSale'])) {
            $this->data['fields']['minPriceSale'] = (float) $data['minPriceSale'];
        } elseif (isset($data['_fields']['minPriceSale'])) {
            $this->data['fields']['minPriceSale'] = null;
        }
        if (isset($data['maxPriceSale'])) {
            $this->data['fields']['maxPriceSale'] = (float) $data['maxPriceSale'];
        } elseif (isset($data['_fields']['maxPriceSale'])) {
            $this->data['fields']['maxPriceSale'] = null;
        }
        if (isset($data['onlyUpdatePrice'])) {
            $this->data['fields']['onlyUpdatePrice'] = (bool) $data['onlyUpdatePrice'];
        } elseif (isset($data['_fields']['onlyUpdatePrice'])) {
            $this->data['fields']['onlyUpdatePrice'] = null;
        }
        if (isset($data['tags'])) {
            $this->data['fields']['tags'] = (string) $data['tags'];
        } elseif (isset($data['_fields']['tags'])) {
            $this->data['fields']['tags'] = null;
        }
        if (isset($data['tagsProduct'])) {
            $this->data['fields']['tagsProduct'] = $data['tagsProduct'];
        } elseif (isset($data['_fields']['tagsProduct'])) {
            $this->data['fields']['tagsProduct'] = null;
        }
        if (isset($data['isAutoTranslate'])) {
            $this->data['fields']['isAutoTranslate'] = (bool) $data['isAutoTranslate'];
        } elseif (isset($data['_fields']['isAutoTranslate'])) {
            $this->data['fields']['isAutoTranslate'] = null;
        }
        if (isset($data['maxOriginalSalePrice'])) {
            $this->data['fields']['maxOriginalSalePrice'] = (float) $data['maxOriginalSalePrice'];
        } elseif (isset($data['_fields']['maxOriginalSalePrice'])) {
            $this->data['fields']['maxOriginalSalePrice'] = null;
        }
        if (isset($data['minOriginalSalePrice'])) {
            $this->data['fields']['minOriginalSalePrice'] = (float) $data['minOriginalSalePrice'];
        } elseif (isset($data['_fields']['minOriginalSalePrice'])) {
            $this->data['fields']['minOriginalSalePrice'] = null;
        }
        if (isset($data['isAutoTranslateOption'])) {
            $this->data['fields']['isAutoTranslateOption'] = (bool) $data['isAutoTranslateOption'];
        } elseif (isset($data['_fields']['isAutoTranslateOption'])) {
            $this->data['fields']['isAutoTranslateOption'] = null;
        }

        return $this;
    }

    /**
     * Set the "customerId" field.
     *
     * @param mixed $value The value.
     *
     * @return \Mongodb\Items The document (fluent interface).
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
     * Set the "uid" field.
     *
     * @param mixed $value The value.
     *
     * @return \Mongodb\Items The document (fluent interface).
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
     * @return \Mongodb\Items The document (fluent interface).
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
     * @return \Mongodb\Items The document (fluent interface).
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
     * Set the "titleOrigin" field.
     *
     * @param mixed $value The value.
     *
     * @return \Mongodb\Items The document (fluent interface).
     */
    public function setTitleOrigin($value)
    {
        if (!isset($this->data['fields']['titleOrigin'])) {
            if (!$this->isNew()) {
                $this->getTitleOrigin();
                if ($this->isFieldEqualTo('titleOrigin', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['titleOrigin'] = null;
                $this->data['fields']['titleOrigin'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('titleOrigin', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['titleOrigin']) && !array_key_exists('titleOrigin', $this->fieldsModified)) {
            $this->fieldsModified['titleOrigin'] = $this->data['fields']['titleOrigin'];
        } elseif ($this->isFieldModifiedEqualTo('titleOrigin', $value)) {
            unset($this->fieldsModified['titleOrigin']);
        }

        $this->data['fields']['titleOrigin'] = $value;

        return $this;
    }

    /**
     * Returns the "titleOrigin" field.
     *
     * @return mixed The $name field.
     */
    public function getTitleOrigin()
    {
        if (!isset($this->data['fields']['titleOrigin'])) {
            if ($this->isNew()) {
                $this->data['fields']['titleOrigin'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('titleOrigin', $this->data['fields'])) {
                $this->addFieldCache('titleOrigin');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('titleOrigin' => 1));
                if (isset($data['titleOrigin'])) {
                    $this->data['fields']['titleOrigin'] = (string) $data['titleOrigin'];
                } else {
                    $this->data['fields']['titleOrigin'] = null;
                }
            }
        }

        return $this->data['fields']['titleOrigin'];
    }

    /**
     * Set the "syncProcess" field.
     *
     * @param mixed $value The value.
     *
     * @return \Mongodb\Items The document (fluent interface).
     */
    public function setSyncProcess($value)
    {
        if (!isset($this->data['fields']['syncProcess'])) {
            if (!$this->isNew()) {
                $this->getSyncProcess();
                if ($this->isFieldEqualTo('syncProcess', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['syncProcess'] = null;
                $this->data['fields']['syncProcess'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('syncProcess', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['syncProcess']) && !array_key_exists('syncProcess', $this->fieldsModified)) {
            $this->fieldsModified['syncProcess'] = $this->data['fields']['syncProcess'];
        } elseif ($this->isFieldModifiedEqualTo('syncProcess', $value)) {
            unset($this->fieldsModified['syncProcess']);
        }

        $this->data['fields']['syncProcess'] = $value;

        return $this;
    }

    /**
     * Returns the "syncProcess" field.
     *
     * @return mixed The $name field.
     */
    public function getSyncProcess()
    {
        if (!isset($this->data['fields']['syncProcess'])) {
            if ($this->isNew()) {
                $this->data['fields']['syncProcess'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('syncProcess', $this->data['fields'])) {
                $this->addFieldCache('syncProcess');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('syncProcess' => 1));
                if (isset($data['syncProcess'])) {
                    $this->data['fields']['syncProcess'] = (bool) $data['syncProcess'];
                } else {
                    $this->data['fields']['syncProcess'] = null;
                }
            }
        }

        return $this->data['fields']['syncProcess'];
    }

    /**
     * Set the "homeLand" field.
     *
     * @param mixed $value The value.
     *
     * @return \Mongodb\Items The document (fluent interface).
     */
    public function setHomeLand($value)
    {
        if (!isset($this->data['fields']['homeLand'])) {
            if (!$this->isNew()) {
                $this->getHomeLand();
                if ($this->isFieldEqualTo('homeLand', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['homeLand'] = null;
                $this->data['fields']['homeLand'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('homeLand', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['homeLand']) && !array_key_exists('homeLand', $this->fieldsModified)) {
            $this->fieldsModified['homeLand'] = $this->data['fields']['homeLand'];
        } elseif ($this->isFieldModifiedEqualTo('homeLand', $value)) {
            unset($this->fieldsModified['homeLand']);
        }

        $this->data['fields']['homeLand'] = $value;

        return $this;
    }

    /**
     * Returns the "homeLand" field.
     *
     * @return mixed The $name field.
     */
    public function getHomeLand()
    {
        if (!isset($this->data['fields']['homeLand'])) {
            if ($this->isNew()) {
                $this->data['fields']['homeLand'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('homeLand', $this->data['fields'])) {
                $this->addFieldCache('homeLand');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('homeLand' => 1));
                if (isset($data['homeLand'])) {
                    $this->data['fields']['homeLand'] = (string) $data['homeLand'];
                } else {
                    $this->data['fields']['homeLand'] = null;
                }
            }
        }

        return $this->data['fields']['homeLand'];
    }

    /**
     * Set the "title" field.
     *
     * @param mixed $value The value.
     *
     * @return \Mongodb\Items The document (fluent interface).
     */
    public function setTitle($value)
    {
        if (!isset($this->data['fields']['title'])) {
            if (!$this->isNew()) {
                $this->getTitle();
                if ($this->isFieldEqualTo('title', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['title'] = null;
                $this->data['fields']['title'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('title', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['title']) && !array_key_exists('title', $this->fieldsModified)) {
            $this->fieldsModified['title'] = $this->data['fields']['title'];
        } elseif ($this->isFieldModifiedEqualTo('title', $value)) {
            unset($this->fieldsModified['title']);
        }

        $this->data['fields']['title'] = $value;

        return $this;
    }

    /**
     * Returns the "title" field.
     *
     * @return mixed The $name field.
     */
    public function getTitle()
    {
        if (!isset($this->data['fields']['title'])) {
            if ($this->isNew()) {
                $this->data['fields']['title'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('title', $this->data['fields'])) {
                $this->addFieldCache('title');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('title' => 1));
                if (isset($data['title'])) {
                    $this->data['fields']['title'] = (string) $data['title'];
                } else {
                    $this->data['fields']['title'] = null;
                }
            }
        }

        return $this->data['fields']['title'];
    }

    /**
     * Set the "images" field.
     *
     * @param mixed $value The value.
     *
     * @return \Mongodb\Items The document (fluent interface).
     */
    public function setImages($value)
    {
        if (!isset($this->data['fields']['images'])) {
            if (!$this->isNew()) {
                $this->getImages();
                if ($this->isFieldEqualTo('images', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['images'] = null;
                $this->data['fields']['images'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('images', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['images']) && !array_key_exists('images', $this->fieldsModified)) {
            $this->fieldsModified['images'] = $this->data['fields']['images'];
        } elseif ($this->isFieldModifiedEqualTo('images', $value)) {
            unset($this->fieldsModified['images']);
        }

        $this->data['fields']['images'] = $value;

        return $this;
    }

    /**
     * Returns the "images" field.
     *
     * @return mixed The $name field.
     */
    public function getImages()
    {
        if (!isset($this->data['fields']['images'])) {
            if ($this->isNew()) {
                $this->data['fields']['images'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('images', $this->data['fields'])) {
                $this->addFieldCache('images');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('images' => 1));
                if (isset($data['images'])) {
                    $this->data['fields']['images'] = $data['images'];
                } else {
                    $this->data['fields']['images'] = null;
                }
            }
        }

        return $this->data['fields']['images'];
    }

    /**
     * Set the "imagesResponse" field.
     *
     * @param mixed $value The value.
     *
     * @return \Mongodb\Items The document (fluent interface).
     */
    public function setImagesResponse($value)
    {
        if (!isset($this->data['fields']['imagesResponse'])) {
            if (!$this->isNew()) {
                $this->getImagesResponse();
                if ($this->isFieldEqualTo('imagesResponse', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['imagesResponse'] = null;
                $this->data['fields']['imagesResponse'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('imagesResponse', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['imagesResponse']) && !array_key_exists('imagesResponse', $this->fieldsModified)) {
            $this->fieldsModified['imagesResponse'] = $this->data['fields']['imagesResponse'];
        } elseif ($this->isFieldModifiedEqualTo('imagesResponse', $value)) {
            unset($this->fieldsModified['imagesResponse']);
        }

        $this->data['fields']['imagesResponse'] = $value;

        return $this;
    }

    /**
     * Returns the "imagesResponse" field.
     *
     * @return mixed The $name field.
     */
    public function getImagesResponse()
    {
        if (!isset($this->data['fields']['imagesResponse'])) {
            if ($this->isNew()) {
                $this->data['fields']['imagesResponse'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('imagesResponse', $this->data['fields'])) {
                $this->addFieldCache('imagesResponse');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('imagesResponse' => 1));
                if (isset($data['imagesResponse'])) {
                    $this->data['fields']['imagesResponse'] = $data['imagesResponse'];
                } else {
                    $this->data['fields']['imagesResponse'] = null;
                }
            }
        }

        return $this->data['fields']['imagesResponse'];
    }

    /**
     * Set the "specifications" field.
     *
     * @param mixed $value The value.
     *
     * @return \Mongodb\Items The document (fluent interface).
     */
    public function setSpecifications($value)
    {
        if (!isset($this->data['fields']['specifications'])) {
            if (!$this->isNew()) {
                $this->getSpecifications();
                if ($this->isFieldEqualTo('specifications', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['specifications'] = null;
                $this->data['fields']['specifications'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('specifications', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['specifications']) && !array_key_exists('specifications', $this->fieldsModified)) {
            $this->fieldsModified['specifications'] = $this->data['fields']['specifications'];
        } elseif ($this->isFieldModifiedEqualTo('specifications', $value)) {
            unset($this->fieldsModified['specifications']);
        }

        $this->data['fields']['specifications'] = $value;

        return $this;
    }

    /**
     * Returns the "specifications" field.
     *
     * @return mixed The $name field.
     */
    public function getSpecifications()
    {
        if (!isset($this->data['fields']['specifications'])) {
            if ($this->isNew()) {
                $this->data['fields']['specifications'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('specifications', $this->data['fields'])) {
                $this->addFieldCache('specifications');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('specifications' => 1));
                if (isset($data['specifications'])) {
                    $this->data['fields']['specifications'] = $data['specifications'];
                } else {
                    $this->data['fields']['specifications'] = null;
                }
            }
        }

        return $this->data['fields']['specifications'];
    }

    /**
     * Set the "itemLocation" field.
     *
     * @param mixed $value The value.
     *
     * @return \Mongodb\Items The document (fluent interface).
     */
    public function setItemLocation($value)
    {
        if (!isset($this->data['fields']['itemLocation'])) {
            if (!$this->isNew()) {
                $this->getItemLocation();
                if ($this->isFieldEqualTo('itemLocation', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['itemLocation'] = null;
                $this->data['fields']['itemLocation'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('itemLocation', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['itemLocation']) && !array_key_exists('itemLocation', $this->fieldsModified)) {
            $this->fieldsModified['itemLocation'] = $this->data['fields']['itemLocation'];
        } elseif ($this->isFieldModifiedEqualTo('itemLocation', $value)) {
            unset($this->fieldsModified['itemLocation']);
        }

        $this->data['fields']['itemLocation'] = $value;

        return $this;
    }

    /**
     * Returns the "itemLocation" field.
     *
     * @return mixed The $name field.
     */
    public function getItemLocation()
    {
        if (!isset($this->data['fields']['itemLocation'])) {
            if ($this->isNew()) {
                $this->data['fields']['itemLocation'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('itemLocation', $this->data['fields'])) {
                $this->addFieldCache('itemLocation');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('itemLocation' => 1));
                if (isset($data['itemLocation'])) {
                    $this->data['fields']['itemLocation'] = (string) $data['itemLocation'];
                } else {
                    $this->data['fields']['itemLocation'] = null;
                }
            }
        }

        return $this->data['fields']['itemLocation'];
    }

    /**
     * Set the "options" field.
     *
     * @param mixed $value The value.
     *
     * @return \Mongodb\Items The document (fluent interface).
     */
    public function setOptions($value)
    {
        if (!isset($this->data['fields']['options'])) {
            if (!$this->isNew()) {
                $this->getOptions();
                if ($this->isFieldEqualTo('options', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['options'] = null;
                $this->data['fields']['options'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('options', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['options']) && !array_key_exists('options', $this->fieldsModified)) {
            $this->fieldsModified['options'] = $this->data['fields']['options'];
        } elseif ($this->isFieldModifiedEqualTo('options', $value)) {
            unset($this->fieldsModified['options']);
        }

        $this->data['fields']['options'] = $value;

        return $this;
    }

    /**
     * Returns the "options" field.
     *
     * @return mixed The $name field.
     */
    public function getOptions()
    {
        if (!isset($this->data['fields']['options'])) {
            if ($this->isNew()) {
                $this->data['fields']['options'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('options', $this->data['fields'])) {
                $this->addFieldCache('options');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('options' => 1));
                if (isset($data['options'])) {
                    $this->data['fields']['options'] = $data['options'];
                } else {
                    $this->data['fields']['options'] = null;
                }
            }
        }

        return $this->data['fields']['options'];
    }

    /**
     * Set the "minOriginPrice" field.
     *
     * @param mixed $value The value.
     *
     * @return \Mongodb\Items The document (fluent interface).
     */
    public function setMinOriginPrice($value)
    {
        if (!isset($this->data['fields']['minOriginPrice'])) {
            if (!$this->isNew()) {
                $this->getMinOriginPrice();
                if ($this->isFieldEqualTo('minOriginPrice', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['minOriginPrice'] = null;
                $this->data['fields']['minOriginPrice'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('minOriginPrice', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['minOriginPrice']) && !array_key_exists('minOriginPrice', $this->fieldsModified)) {
            $this->fieldsModified['minOriginPrice'] = $this->data['fields']['minOriginPrice'];
        } elseif ($this->isFieldModifiedEqualTo('minOriginPrice', $value)) {
            unset($this->fieldsModified['minOriginPrice']);
        }

        $this->data['fields']['minOriginPrice'] = $value;

        return $this;
    }

    /**
     * Returns the "minOriginPrice" field.
     *
     * @return mixed The $name field.
     */
    public function getMinOriginPrice()
    {
        if (!isset($this->data['fields']['minOriginPrice'])) {
            if ($this->isNew()) {
                $this->data['fields']['minOriginPrice'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('minOriginPrice', $this->data['fields'])) {
                $this->addFieldCache('minOriginPrice');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('minOriginPrice' => 1));
                if (isset($data['minOriginPrice'])) {
                    $this->data['fields']['minOriginPrice'] = (float) $data['minOriginPrice'];
                } else {
                    $this->data['fields']['minOriginPrice'] = null;
                }
            }
        }

        return $this->data['fields']['minOriginPrice'];
    }

    /**
     * Set the "maxOriginPrice" field.
     *
     * @param mixed $value The value.
     *
     * @return \Mongodb\Items The document (fluent interface).
     */
    public function setMaxOriginPrice($value)
    {
        if (!isset($this->data['fields']['maxOriginPrice'])) {
            if (!$this->isNew()) {
                $this->getMaxOriginPrice();
                if ($this->isFieldEqualTo('maxOriginPrice', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['maxOriginPrice'] = null;
                $this->data['fields']['maxOriginPrice'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('maxOriginPrice', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['maxOriginPrice']) && !array_key_exists('maxOriginPrice', $this->fieldsModified)) {
            $this->fieldsModified['maxOriginPrice'] = $this->data['fields']['maxOriginPrice'];
        } elseif ($this->isFieldModifiedEqualTo('maxOriginPrice', $value)) {
            unset($this->fieldsModified['maxOriginPrice']);
        }

        $this->data['fields']['maxOriginPrice'] = $value;

        return $this;
    }

    /**
     * Returns the "maxOriginPrice" field.
     *
     * @return mixed The $name field.
     */
    public function getMaxOriginPrice()
    {
        if (!isset($this->data['fields']['maxOriginPrice'])) {
            if ($this->isNew()) {
                $this->data['fields']['maxOriginPrice'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('maxOriginPrice', $this->data['fields'])) {
                $this->addFieldCache('maxOriginPrice');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('maxOriginPrice' => 1));
                if (isset($data['maxOriginPrice'])) {
                    $this->data['fields']['maxOriginPrice'] = (float) $data['maxOriginPrice'];
                } else {
                    $this->data['fields']['maxOriginPrice'] = null;
                }
            }
        }

        return $this->data['fields']['maxOriginPrice'];
    }

    /**
     * Set the "pricesTable" field.
     *
     * @param mixed $value The value.
     *
     * @return \Mongodb\Items The document (fluent interface).
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
     * Set the "quantitySteps" field.
     *
     * @param mixed $value The value.
     *
     * @return \Mongodb\Items The document (fluent interface).
     */
    public function setQuantitySteps($value)
    {
        if (!isset($this->data['fields']['quantitySteps'])) {
            if (!$this->isNew()) {
                $this->getQuantitySteps();
                if ($this->isFieldEqualTo('quantitySteps', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['quantitySteps'] = null;
                $this->data['fields']['quantitySteps'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('quantitySteps', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['quantitySteps']) && !array_key_exists('quantitySteps', $this->fieldsModified)) {
            $this->fieldsModified['quantitySteps'] = $this->data['fields']['quantitySteps'];
        } elseif ($this->isFieldModifiedEqualTo('quantitySteps', $value)) {
            unset($this->fieldsModified['quantitySteps']);
        }

        $this->data['fields']['quantitySteps'] = $value;

        return $this;
    }

    /**
     * Returns the "quantitySteps" field.
     *
     * @return mixed The $name field.
     */
    public function getQuantitySteps()
    {
        if (!isset($this->data['fields']['quantitySteps'])) {
            if ($this->isNew()) {
                $this->data['fields']['quantitySteps'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('quantitySteps', $this->data['fields'])) {
                $this->addFieldCache('quantitySteps');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('quantitySteps' => 1));
                if (isset($data['quantitySteps'])) {
                    $this->data['fields']['quantitySteps'] = (int) $data['quantitySteps'];
                } else {
                    $this->data['fields']['quantitySteps'] = null;
                }
            }
        }

        return $this->data['fields']['quantitySteps'];
    }

    /**
     * Set the "bodyImages" field.
     *
     * @param mixed $value The value.
     *
     * @return \Mongodb\Items The document (fluent interface).
     */
    public function setBodyImages($value)
    {
        if (!isset($this->data['fields']['bodyImages'])) {
            if (!$this->isNew()) {
                $this->getBodyImages();
                if ($this->isFieldEqualTo('bodyImages', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['bodyImages'] = null;
                $this->data['fields']['bodyImages'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('bodyImages', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['bodyImages']) && !array_key_exists('bodyImages', $this->fieldsModified)) {
            $this->fieldsModified['bodyImages'] = $this->data['fields']['bodyImages'];
        } elseif ($this->isFieldModifiedEqualTo('bodyImages', $value)) {
            unset($this->fieldsModified['bodyImages']);
        }

        $this->data['fields']['bodyImages'] = $value;

        return $this;
    }

    /**
     * Returns the "bodyImages" field.
     *
     * @return mixed The $name field.
     */
    public function getBodyImages()
    {
        if (!isset($this->data['fields']['bodyImages'])) {
            if ($this->isNew()) {
                $this->data['fields']['bodyImages'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('bodyImages', $this->data['fields'])) {
                $this->addFieldCache('bodyImages');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('bodyImages' => 1));
                if (isset($data['bodyImages'])) {
                    $this->data['fields']['bodyImages'] = $data['bodyImages'];
                } else {
                    $this->data['fields']['bodyImages'] = null;
                }
            }
        }

        return $this->data['fields']['bodyImages'];
    }

    /**
     * Set the "hasDiscount" field.
     *
     * @param mixed $value The value.
     *
     * @return \Mongodb\Items The document (fluent interface).
     */
    public function setHasDiscount($value)
    {
        if (!isset($this->data['fields']['hasDiscount'])) {
            if (!$this->isNew()) {
                $this->getHasDiscount();
                if ($this->isFieldEqualTo('hasDiscount', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['hasDiscount'] = null;
                $this->data['fields']['hasDiscount'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('hasDiscount', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['hasDiscount']) && !array_key_exists('hasDiscount', $this->fieldsModified)) {
            $this->fieldsModified['hasDiscount'] = $this->data['fields']['hasDiscount'];
        } elseif ($this->isFieldModifiedEqualTo('hasDiscount', $value)) {
            unset($this->fieldsModified['hasDiscount']);
        }

        $this->data['fields']['hasDiscount'] = $value;

        return $this;
    }

    /**
     * Returns the "hasDiscount" field.
     *
     * @return mixed The $name field.
     */
    public function getHasDiscount()
    {
        if (!isset($this->data['fields']['hasDiscount'])) {
            if ($this->isNew()) {
                $this->data['fields']['hasDiscount'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('hasDiscount', $this->data['fields'])) {
                $this->addFieldCache('hasDiscount');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('hasDiscount' => 1));
                if (isset($data['hasDiscount'])) {
                    $this->data['fields']['hasDiscount'] = (bool) $data['hasDiscount'];
                } else {
                    $this->data['fields']['hasDiscount'] = null;
                }
            }
        }

        return $this->data['fields']['hasDiscount'];
    }

    /**
     * Set the "sellerName" field.
     *
     * @param mixed $value The value.
     *
     * @return \Mongodb\Items The document (fluent interface).
     */
    public function setSellerName($value)
    {
        if (!isset($this->data['fields']['sellerName'])) {
            if (!$this->isNew()) {
                $this->getSellerName();
                if ($this->isFieldEqualTo('sellerName', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['sellerName'] = null;
                $this->data['fields']['sellerName'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('sellerName', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['sellerName']) && !array_key_exists('sellerName', $this->fieldsModified)) {
            $this->fieldsModified['sellerName'] = $this->data['fields']['sellerName'];
        } elseif ($this->isFieldModifiedEqualTo('sellerName', $value)) {
            unset($this->fieldsModified['sellerName']);
        }

        $this->data['fields']['sellerName'] = $value;

        return $this;
    }

    /**
     * Returns the "sellerName" field.
     *
     * @return mixed The $name field.
     */
    public function getSellerName()
    {
        if (!isset($this->data['fields']['sellerName'])) {
            if ($this->isNew()) {
                $this->data['fields']['sellerName'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('sellerName', $this->data['fields'])) {
                $this->addFieldCache('sellerName');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('sellerName' => 1));
                if (isset($data['sellerName'])) {
                    $this->data['fields']['sellerName'] = (string) $data['sellerName'];
                } else {
                    $this->data['fields']['sellerName'] = null;
                }
            }
        }

        return $this->data['fields']['sellerName'];
    }

    /**
     * Set the "sellerId" field.
     *
     * @param mixed $value The value.
     *
     * @return \Mongodb\Items The document (fluent interface).
     */
    public function setSellerId($value)
    {
        if (!isset($this->data['fields']['sellerId'])) {
            if (!$this->isNew()) {
                $this->getSellerId();
                if ($this->isFieldEqualTo('sellerId', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['sellerId'] = null;
                $this->data['fields']['sellerId'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('sellerId', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['sellerId']) && !array_key_exists('sellerId', $this->fieldsModified)) {
            $this->fieldsModified['sellerId'] = $this->data['fields']['sellerId'];
        } elseif ($this->isFieldModifiedEqualTo('sellerId', $value)) {
            unset($this->fieldsModified['sellerId']);
        }

        $this->data['fields']['sellerId'] = $value;

        return $this;
    }

    /**
     * Returns the "sellerId" field.
     *
     * @return mixed The $name field.
     */
    public function getSellerId()
    {
        if (!isset($this->data['fields']['sellerId'])) {
            if ($this->isNew()) {
                $this->data['fields']['sellerId'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('sellerId', $this->data['fields'])) {
                $this->addFieldCache('sellerId');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('sellerId' => 1));
                if (isset($data['sellerId'])) {
                    $this->data['fields']['sellerId'] = (string) $data['sellerId'];
                } else {
                    $this->data['fields']['sellerId'] = null;
                }
            }
        }

        return $this->data['fields']['sellerId'];
    }

    /**
     * Set the "sellerHomeUrl" field.
     *
     * @param mixed $value The value.
     *
     * @return \Mongodb\Items The document (fluent interface).
     */
    public function setSellerHomeUrl($value)
    {
        if (!isset($this->data['fields']['sellerHomeUrl'])) {
            if (!$this->isNew()) {
                $this->getSellerHomeUrl();
                if ($this->isFieldEqualTo('sellerHomeUrl', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['sellerHomeUrl'] = null;
                $this->data['fields']['sellerHomeUrl'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('sellerHomeUrl', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['sellerHomeUrl']) && !array_key_exists('sellerHomeUrl', $this->fieldsModified)) {
            $this->fieldsModified['sellerHomeUrl'] = $this->data['fields']['sellerHomeUrl'];
        } elseif ($this->isFieldModifiedEqualTo('sellerHomeUrl', $value)) {
            unset($this->fieldsModified['sellerHomeUrl']);
        }

        $this->data['fields']['sellerHomeUrl'] = $value;

        return $this;
    }

    /**
     * Returns the "sellerHomeUrl" field.
     *
     * @return mixed The $name field.
     */
    public function getSellerHomeUrl()
    {
        if (!isset($this->data['fields']['sellerHomeUrl'])) {
            if ($this->isNew()) {
                $this->data['fields']['sellerHomeUrl'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('sellerHomeUrl', $this->data['fields'])) {
                $this->addFieldCache('sellerHomeUrl');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('sellerHomeUrl' => 1));
                if (isset($data['sellerHomeUrl'])) {
                    $this->data['fields']['sellerHomeUrl'] = (string) $data['sellerHomeUrl'];
                } else {
                    $this->data['fields']['sellerHomeUrl'] = null;
                }
            }
        }

        return $this->data['fields']['sellerHomeUrl'];
    }

    /**
     * Set the "sellerImage" field.
     *
     * @param mixed $value The value.
     *
     * @return \Mongodb\Items The document (fluent interface).
     */
    public function setSellerImage($value)
    {
        if (!isset($this->data['fields']['sellerImage'])) {
            if (!$this->isNew()) {
                $this->getSellerImage();
                if ($this->isFieldEqualTo('sellerImage', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['sellerImage'] = null;
                $this->data['fields']['sellerImage'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('sellerImage', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['sellerImage']) && !array_key_exists('sellerImage', $this->fieldsModified)) {
            $this->fieldsModified['sellerImage'] = $this->data['fields']['sellerImage'];
        } elseif ($this->isFieldModifiedEqualTo('sellerImage', $value)) {
            unset($this->fieldsModified['sellerImage']);
        }

        $this->data['fields']['sellerImage'] = $value;

        return $this;
    }

    /**
     * Returns the "sellerImage" field.
     *
     * @return mixed The $name field.
     */
    public function getSellerImage()
    {
        if (!isset($this->data['fields']['sellerImage'])) {
            if ($this->isNew()) {
                $this->data['fields']['sellerImage'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('sellerImage', $this->data['fields'])) {
                $this->addFieldCache('sellerImage');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('sellerImage' => 1));
                if (isset($data['sellerImage'])) {
                    $this->data['fields']['sellerImage'] = (string) $data['sellerImage'];
                } else {
                    $this->data['fields']['sellerImage'] = null;
                }
            }
        }

        return $this->data['fields']['sellerImage'];
    }

    /**
     * Set the "sellerPolicy" field.
     *
     * @param mixed $value The value.
     *
     * @return \Mongodb\Items The document (fluent interface).
     */
    public function setSellerPolicy($value)
    {
        if (!isset($this->data['fields']['sellerPolicy'])) {
            if (!$this->isNew()) {
                $this->getSellerPolicy();
                if ($this->isFieldEqualTo('sellerPolicy', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['sellerPolicy'] = null;
                $this->data['fields']['sellerPolicy'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('sellerPolicy', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['sellerPolicy']) && !array_key_exists('sellerPolicy', $this->fieldsModified)) {
            $this->fieldsModified['sellerPolicy'] = $this->data['fields']['sellerPolicy'];
        } elseif ($this->isFieldModifiedEqualTo('sellerPolicy', $value)) {
            unset($this->fieldsModified['sellerPolicy']);
        }

        $this->data['fields']['sellerPolicy'] = $value;

        return $this;
    }

    /**
     * Returns the "sellerPolicy" field.
     *
     * @return mixed The $name field.
     */
    public function getSellerPolicy()
    {
        if (!isset($this->data['fields']['sellerPolicy'])) {
            if ($this->isNew()) {
                $this->data['fields']['sellerPolicy'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('sellerPolicy', $this->data['fields'])) {
                $this->addFieldCache('sellerPolicy');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('sellerPolicy' => 1));
                if (isset($data['sellerPolicy'])) {
                    $this->data['fields']['sellerPolicy'] = (string) $data['sellerPolicy'];
                } else {
                    $this->data['fields']['sellerPolicy'] = null;
                }
            }
        }

        return $this->data['fields']['sellerPolicy'];
    }

    /**
     * Set the "sellerRequireMin" field.
     *
     * @param mixed $value The value.
     *
     * @return \Mongodb\Items The document (fluent interface).
     */
    public function setSellerRequireMin($value)
    {
        if (!isset($this->data['fields']['sellerRequireMin'])) {
            if (!$this->isNew()) {
                $this->getSellerRequireMin();
                if ($this->isFieldEqualTo('sellerRequireMin', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['sellerRequireMin'] = null;
                $this->data['fields']['sellerRequireMin'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('sellerRequireMin', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['sellerRequireMin']) && !array_key_exists('sellerRequireMin', $this->fieldsModified)) {
            $this->fieldsModified['sellerRequireMin'] = $this->data['fields']['sellerRequireMin'];
        } elseif ($this->isFieldModifiedEqualTo('sellerRequireMin', $value)) {
            unset($this->fieldsModified['sellerRequireMin']);
        }

        $this->data['fields']['sellerRequireMin'] = $value;

        return $this;
    }

    /**
     * Returns the "sellerRequireMin" field.
     *
     * @return mixed The $name field.
     */
    public function getSellerRequireMin()
    {
        if (!isset($this->data['fields']['sellerRequireMin'])) {
            if ($this->isNew()) {
                $this->data['fields']['sellerRequireMin'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('sellerRequireMin', $this->data['fields'])) {
                $this->addFieldCache('sellerRequireMin');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('sellerRequireMin' => 1));
                if (isset($data['sellerRequireMin'])) {
                    $this->data['fields']['sellerRequireMin'] = (int) $data['sellerRequireMin'];
                } else {
                    $this->data['fields']['sellerRequireMin'] = null;
                }
            }
        }

        return $this->data['fields']['sellerRequireMin'];
    }

    /**
     * Set the "originalLink" field.
     *
     * @param mixed $value The value.
     *
     * @return \Mongodb\Items The document (fluent interface).
     */
    public function setOriginalLink($value)
    {
        if (!isset($this->data['fields']['originalLink'])) {
            if (!$this->isNew()) {
                $this->getOriginalLink();
                if ($this->isFieldEqualTo('originalLink', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['originalLink'] = null;
                $this->data['fields']['originalLink'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('originalLink', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['originalLink']) && !array_key_exists('originalLink', $this->fieldsModified)) {
            $this->fieldsModified['originalLink'] = $this->data['fields']['originalLink'];
        } elseif ($this->isFieldModifiedEqualTo('originalLink', $value)) {
            unset($this->fieldsModified['originalLink']);
        }

        $this->data['fields']['originalLink'] = $value;

        return $this;
    }

    /**
     * Returns the "originalLink" field.
     *
     * @return mixed The $name field.
     */
    public function getOriginalLink()
    {
        if (!isset($this->data['fields']['originalLink'])) {
            if ($this->isNew()) {
                $this->data['fields']['originalLink'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('originalLink', $this->data['fields'])) {
                $this->addFieldCache('originalLink');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('originalLink' => 1));
                if (isset($data['originalLink'])) {
                    $this->data['fields']['originalLink'] = (string) $data['originalLink'];
                } else {
                    $this->data['fields']['originalLink'] = null;
                }
            }
        }

        return $this->data['fields']['originalLink'];
    }

    /**
     * Set the "checksum" field.
     *
     * @param mixed $value The value.
     *
     * @return \Mongodb\Items The document (fluent interface).
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
     * Set the "integrationItems" field.
     *
     * @param mixed $value The value.
     *
     * @return \Mongodb\Items The document (fluent interface).
     */
    public function setIntegrationItems($value)
    {
        if (!isset($this->data['fields']['integrationItems'])) {
            if (!$this->isNew()) {
                $this->getIntegrationItems();
                if ($this->isFieldEqualTo('integrationItems', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['integrationItems'] = null;
                $this->data['fields']['integrationItems'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('integrationItems', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['integrationItems']) && !array_key_exists('integrationItems', $this->fieldsModified)) {
            $this->fieldsModified['integrationItems'] = $this->data['fields']['integrationItems'];
        } elseif ($this->isFieldModifiedEqualTo('integrationItems', $value)) {
            unset($this->fieldsModified['integrationItems']);
        }

        $this->data['fields']['integrationItems'] = $value;

        return $this;
    }

    /**
     * Returns the "integrationItems" field.
     *
     * @return mixed The $name field.
     */
    public function getIntegrationItems()
    {
        if (!isset($this->data['fields']['integrationItems'])) {
            if ($this->isNew()) {
                $this->data['fields']['integrationItems'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('integrationItems', $this->data['fields'])) {
                $this->addFieldCache('integrationItems');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('integrationItems' => 1));
                if (isset($data['integrationItems'])) {
                    $this->data['fields']['integrationItems'] = $data['integrationItems'];
                } else {
                    $this->data['fields']['integrationItems'] = null;
                }
            }
        }

        return $this->data['fields']['integrationItems'];
    }

    /**
     * Set the "lastUpdateFromSource" field.
     *
     * @param mixed $value The value.
     *
     * @return \Mongodb\Items The document (fluent interface).
     */
    public function setLastUpdateFromSource($value)
    {
        if (!isset($this->data['fields']['lastUpdateFromSource'])) {
            if (!$this->isNew()) {
                $this->getLastUpdateFromSource();
                if ($this->isFieldEqualTo('lastUpdateFromSource', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['lastUpdateFromSource'] = null;
                $this->data['fields']['lastUpdateFromSource'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('lastUpdateFromSource', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['lastUpdateFromSource']) && !array_key_exists('lastUpdateFromSource', $this->fieldsModified)) {
            $this->fieldsModified['lastUpdateFromSource'] = $this->data['fields']['lastUpdateFromSource'];
        } elseif ($this->isFieldModifiedEqualTo('lastUpdateFromSource', $value)) {
            unset($this->fieldsModified['lastUpdateFromSource']);
        }

        $this->data['fields']['lastUpdateFromSource'] = $value;

        return $this;
    }

    /**
     * Returns the "lastUpdateFromSource" field.
     *
     * @return mixed The $name field.
     */
    public function getLastUpdateFromSource()
    {
        if (!isset($this->data['fields']['lastUpdateFromSource'])) {
            if ($this->isNew()) {
                $this->data['fields']['lastUpdateFromSource'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('lastUpdateFromSource', $this->data['fields'])) {
                $this->addFieldCache('lastUpdateFromSource');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('lastUpdateFromSource' => 1));
                if (isset($data['lastUpdateFromSource'])) {
                    $this->data['fields']['lastUpdateFromSource'] = new \DateTime(); $this->data['fields']['lastUpdateFromSource']->setTimestamp($data['lastUpdateFromSource']->sec);
                } else {
                    $this->data['fields']['lastUpdateFromSource'] = null;
                }
            }
        }

        return $this->data['fields']['lastUpdateFromSource'];
    }

    /**
     * Set the "createdTime" field.
     *
     * @param mixed $value The value.
     *
     * @return \Mongodb\Items The document (fluent interface).
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
     * @return \Mongodb\Items The document (fluent interface).
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

    /**
     * Set the "isActive" field.
     *
     * @param mixed $value The value.
     *
     * @return \Mongodb\Items The document (fluent interface).
     */
    public function setIsActive($value)
    {
        if (!isset($this->data['fields']['isActive'])) {
            if (!$this->isNew()) {
                $this->getIsActive();
                if ($this->isFieldEqualTo('isActive', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['isActive'] = null;
                $this->data['fields']['isActive'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('isActive', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['isActive']) && !array_key_exists('isActive', $this->fieldsModified)) {
            $this->fieldsModified['isActive'] = $this->data['fields']['isActive'];
        } elseif ($this->isFieldModifiedEqualTo('isActive', $value)) {
            unset($this->fieldsModified['isActive']);
        }

        $this->data['fields']['isActive'] = $value;

        return $this;
    }

    /**
     * Returns the "isActive" field.
     *
     * @return mixed The $name field.
     */
    public function getIsActive()
    {
        if (!isset($this->data['fields']['isActive'])) {
            if ($this->isNew()) {
                $this->data['fields']['isActive'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('isActive', $this->data['fields'])) {
                $this->addFieldCache('isActive');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('isActive' => 1));
                if (isset($data['isActive'])) {
                    $this->data['fields']['isActive'] = (string) $data['isActive'];
                } else {
                    $this->data['fields']['isActive'] = null;
                }
            }
        }

        return $this->data['fields']['isActive'];
    }

    /**
     * Set the "isDeleted" field.
     *
     * @param mixed $value The value.
     *
     * @return \Mongodb\Items The document (fluent interface).
     */
    public function setIsDeleted($value)
    {
        if (!isset($this->data['fields']['isDeleted'])) {
            if (!$this->isNew()) {
                $this->getIsDeleted();
                if ($this->isFieldEqualTo('isDeleted', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['isDeleted'] = null;
                $this->data['fields']['isDeleted'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('isDeleted', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['isDeleted']) && !array_key_exists('isDeleted', $this->fieldsModified)) {
            $this->fieldsModified['isDeleted'] = $this->data['fields']['isDeleted'];
        } elseif ($this->isFieldModifiedEqualTo('isDeleted', $value)) {
            unset($this->fieldsModified['isDeleted']);
        }

        $this->data['fields']['isDeleted'] = $value;

        return $this;
    }

    /**
     * Returns the "isDeleted" field.
     *
     * @return mixed The $name field.
     */
    public function getIsDeleted()
    {
        if (!isset($this->data['fields']['isDeleted'])) {
            if ($this->isNew()) {
                $this->data['fields']['isDeleted'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('isDeleted', $this->data['fields'])) {
                $this->addFieldCache('isDeleted');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('isDeleted' => 1));
                if (isset($data['isDeleted'])) {
                    $this->data['fields']['isDeleted'] = (bool) $data['isDeleted'];
                } else {
                    $this->data['fields']['isDeleted'] = null;
                }
            }
        }

        return $this->data['fields']['isDeleted'];
    }

    /**
     * Set the "minPriceSale" field.
     *
     * @param mixed $value The value.
     *
     * @return \Mongodb\Items The document (fluent interface).
     */
    public function setMinPriceSale($value)
    {
        if (!isset($this->data['fields']['minPriceSale'])) {
            if (!$this->isNew()) {
                $this->getMinPriceSale();
                if ($this->isFieldEqualTo('minPriceSale', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['minPriceSale'] = null;
                $this->data['fields']['minPriceSale'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('minPriceSale', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['minPriceSale']) && !array_key_exists('minPriceSale', $this->fieldsModified)) {
            $this->fieldsModified['minPriceSale'] = $this->data['fields']['minPriceSale'];
        } elseif ($this->isFieldModifiedEqualTo('minPriceSale', $value)) {
            unset($this->fieldsModified['minPriceSale']);
        }

        $this->data['fields']['minPriceSale'] = $value;

        return $this;
    }

    /**
     * Returns the "minPriceSale" field.
     *
     * @return mixed The $name field.
     */
    public function getMinPriceSale()
    {
        if (!isset($this->data['fields']['minPriceSale'])) {
            if ($this->isNew()) {
                $this->data['fields']['minPriceSale'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('minPriceSale', $this->data['fields'])) {
                $this->addFieldCache('minPriceSale');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('minPriceSale' => 1));
                if (isset($data['minPriceSale'])) {
                    $this->data['fields']['minPriceSale'] = (float) $data['minPriceSale'];
                } else {
                    $this->data['fields']['minPriceSale'] = null;
                }
            }
        }

        return $this->data['fields']['minPriceSale'];
    }

    /**
     * Set the "maxPriceSale" field.
     *
     * @param mixed $value The value.
     *
     * @return \Mongodb\Items The document (fluent interface).
     */
    public function setMaxPriceSale($value)
    {
        if (!isset($this->data['fields']['maxPriceSale'])) {
            if (!$this->isNew()) {
                $this->getMaxPriceSale();
                if ($this->isFieldEqualTo('maxPriceSale', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['maxPriceSale'] = null;
                $this->data['fields']['maxPriceSale'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('maxPriceSale', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['maxPriceSale']) && !array_key_exists('maxPriceSale', $this->fieldsModified)) {
            $this->fieldsModified['maxPriceSale'] = $this->data['fields']['maxPriceSale'];
        } elseif ($this->isFieldModifiedEqualTo('maxPriceSale', $value)) {
            unset($this->fieldsModified['maxPriceSale']);
        }

        $this->data['fields']['maxPriceSale'] = $value;

        return $this;
    }

    /**
     * Returns the "maxPriceSale" field.
     *
     * @return mixed The $name field.
     */
    public function getMaxPriceSale()
    {
        if (!isset($this->data['fields']['maxPriceSale'])) {
            if ($this->isNew()) {
                $this->data['fields']['maxPriceSale'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('maxPriceSale', $this->data['fields'])) {
                $this->addFieldCache('maxPriceSale');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('maxPriceSale' => 1));
                if (isset($data['maxPriceSale'])) {
                    $this->data['fields']['maxPriceSale'] = (float) $data['maxPriceSale'];
                } else {
                    $this->data['fields']['maxPriceSale'] = null;
                }
            }
        }

        return $this->data['fields']['maxPriceSale'];
    }

    /**
     * Set the "onlyUpdatePrice" field.
     *
     * @param mixed $value The value.
     *
     * @return \Mongodb\Items The document (fluent interface).
     */
    public function setOnlyUpdatePrice($value)
    {
        if (!isset($this->data['fields']['onlyUpdatePrice'])) {
            if (!$this->isNew()) {
                $this->getOnlyUpdatePrice();
                if ($this->isFieldEqualTo('onlyUpdatePrice', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['onlyUpdatePrice'] = null;
                $this->data['fields']['onlyUpdatePrice'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('onlyUpdatePrice', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['onlyUpdatePrice']) && !array_key_exists('onlyUpdatePrice', $this->fieldsModified)) {
            $this->fieldsModified['onlyUpdatePrice'] = $this->data['fields']['onlyUpdatePrice'];
        } elseif ($this->isFieldModifiedEqualTo('onlyUpdatePrice', $value)) {
            unset($this->fieldsModified['onlyUpdatePrice']);
        }

        $this->data['fields']['onlyUpdatePrice'] = $value;

        return $this;
    }

    /**
     * Returns the "onlyUpdatePrice" field.
     *
     * @return mixed The $name field.
     */
    public function getOnlyUpdatePrice()
    {
        if (!isset($this->data['fields']['onlyUpdatePrice'])) {
            if ($this->isNew()) {
                $this->data['fields']['onlyUpdatePrice'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('onlyUpdatePrice', $this->data['fields'])) {
                $this->addFieldCache('onlyUpdatePrice');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('onlyUpdatePrice' => 1));
                if (isset($data['onlyUpdatePrice'])) {
                    $this->data['fields']['onlyUpdatePrice'] = (bool) $data['onlyUpdatePrice'];
                } else {
                    $this->data['fields']['onlyUpdatePrice'] = null;
                }
            }
        }

        return $this->data['fields']['onlyUpdatePrice'];
    }

    /**
     * Set the "tags" field.
     *
     * @param mixed $value The value.
     *
     * @return \Mongodb\Items The document (fluent interface).
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
     * Set the "tagsProduct" field.
     *
     * @param mixed $value The value.
     *
     * @return \Mongodb\Items The document (fluent interface).
     */
    public function setTagsProduct($value)
    {
        if (!isset($this->data['fields']['tagsProduct'])) {
            if (!$this->isNew()) {
                $this->getTagsProduct();
                if ($this->isFieldEqualTo('tagsProduct', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['tagsProduct'] = null;
                $this->data['fields']['tagsProduct'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('tagsProduct', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['tagsProduct']) && !array_key_exists('tagsProduct', $this->fieldsModified)) {
            $this->fieldsModified['tagsProduct'] = $this->data['fields']['tagsProduct'];
        } elseif ($this->isFieldModifiedEqualTo('tagsProduct', $value)) {
            unset($this->fieldsModified['tagsProduct']);
        }

        $this->data['fields']['tagsProduct'] = $value;

        return $this;
    }

    /**
     * Returns the "tagsProduct" field.
     *
     * @return mixed The $name field.
     */
    public function getTagsProduct()
    {
        if (!isset($this->data['fields']['tagsProduct'])) {
            if ($this->isNew()) {
                $this->data['fields']['tagsProduct'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('tagsProduct', $this->data['fields'])) {
                $this->addFieldCache('tagsProduct');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('tagsProduct' => 1));
                if (isset($data['tagsProduct'])) {
                    $this->data['fields']['tagsProduct'] = $data['tagsProduct'];
                } else {
                    $this->data['fields']['tagsProduct'] = null;
                }
            }
        }

        return $this->data['fields']['tagsProduct'];
    }

    /**
     * Set the "isAutoTranslate" field.
     *
     * @param mixed $value The value.
     *
     * @return \Mongodb\Items The document (fluent interface).
     */
    public function setIsAutoTranslate($value)
    {
        if (!isset($this->data['fields']['isAutoTranslate'])) {
            if (!$this->isNew()) {
                $this->getIsAutoTranslate();
                if ($this->isFieldEqualTo('isAutoTranslate', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['isAutoTranslate'] = null;
                $this->data['fields']['isAutoTranslate'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('isAutoTranslate', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['isAutoTranslate']) && !array_key_exists('isAutoTranslate', $this->fieldsModified)) {
            $this->fieldsModified['isAutoTranslate'] = $this->data['fields']['isAutoTranslate'];
        } elseif ($this->isFieldModifiedEqualTo('isAutoTranslate', $value)) {
            unset($this->fieldsModified['isAutoTranslate']);
        }

        $this->data['fields']['isAutoTranslate'] = $value;

        return $this;
    }

    /**
     * Returns the "isAutoTranslate" field.
     *
     * @return mixed The $name field.
     */
    public function getIsAutoTranslate()
    {
        if (!isset($this->data['fields']['isAutoTranslate'])) {
            if ($this->isNew()) {
                $this->data['fields']['isAutoTranslate'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('isAutoTranslate', $this->data['fields'])) {
                $this->addFieldCache('isAutoTranslate');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('isAutoTranslate' => 1));
                if (isset($data['isAutoTranslate'])) {
                    $this->data['fields']['isAutoTranslate'] = (bool) $data['isAutoTranslate'];
                } else {
                    $this->data['fields']['isAutoTranslate'] = null;
                }
            }
        }

        return $this->data['fields']['isAutoTranslate'];
    }

    /**
     * Set the "maxOriginalSalePrice" field.
     *
     * @param mixed $value The value.
     *
     * @return \Mongodb\Items The document (fluent interface).
     */
    public function setMaxOriginalSalePrice($value)
    {
        if (!isset($this->data['fields']['maxOriginalSalePrice'])) {
            if (!$this->isNew()) {
                $this->getMaxOriginalSalePrice();
                if ($this->isFieldEqualTo('maxOriginalSalePrice', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['maxOriginalSalePrice'] = null;
                $this->data['fields']['maxOriginalSalePrice'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('maxOriginalSalePrice', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['maxOriginalSalePrice']) && !array_key_exists('maxOriginalSalePrice', $this->fieldsModified)) {
            $this->fieldsModified['maxOriginalSalePrice'] = $this->data['fields']['maxOriginalSalePrice'];
        } elseif ($this->isFieldModifiedEqualTo('maxOriginalSalePrice', $value)) {
            unset($this->fieldsModified['maxOriginalSalePrice']);
        }

        $this->data['fields']['maxOriginalSalePrice'] = $value;

        return $this;
    }

    /**
     * Returns the "maxOriginalSalePrice" field.
     *
     * @return mixed The $name field.
     */
    public function getMaxOriginalSalePrice()
    {
        if (!isset($this->data['fields']['maxOriginalSalePrice'])) {
            if ($this->isNew()) {
                $this->data['fields']['maxOriginalSalePrice'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('maxOriginalSalePrice', $this->data['fields'])) {
                $this->addFieldCache('maxOriginalSalePrice');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('maxOriginalSalePrice' => 1));
                if (isset($data['maxOriginalSalePrice'])) {
                    $this->data['fields']['maxOriginalSalePrice'] = (float) $data['maxOriginalSalePrice'];
                } else {
                    $this->data['fields']['maxOriginalSalePrice'] = null;
                }
            }
        }

        return $this->data['fields']['maxOriginalSalePrice'];
    }

    /**
     * Set the "minOriginalSalePrice" field.
     *
     * @param mixed $value The value.
     *
     * @return \Mongodb\Items The document (fluent interface).
     */
    public function setMinOriginalSalePrice($value)
    {
        if (!isset($this->data['fields']['minOriginalSalePrice'])) {
            if (!$this->isNew()) {
                $this->getMinOriginalSalePrice();
                if ($this->isFieldEqualTo('minOriginalSalePrice', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['minOriginalSalePrice'] = null;
                $this->data['fields']['minOriginalSalePrice'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('minOriginalSalePrice', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['minOriginalSalePrice']) && !array_key_exists('minOriginalSalePrice', $this->fieldsModified)) {
            $this->fieldsModified['minOriginalSalePrice'] = $this->data['fields']['minOriginalSalePrice'];
        } elseif ($this->isFieldModifiedEqualTo('minOriginalSalePrice', $value)) {
            unset($this->fieldsModified['minOriginalSalePrice']);
        }

        $this->data['fields']['minOriginalSalePrice'] = $value;

        return $this;
    }

    /**
     * Returns the "minOriginalSalePrice" field.
     *
     * @return mixed The $name field.
     */
    public function getMinOriginalSalePrice()
    {
        if (!isset($this->data['fields']['minOriginalSalePrice'])) {
            if ($this->isNew()) {
                $this->data['fields']['minOriginalSalePrice'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('minOriginalSalePrice', $this->data['fields'])) {
                $this->addFieldCache('minOriginalSalePrice');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('minOriginalSalePrice' => 1));
                if (isset($data['minOriginalSalePrice'])) {
                    $this->data['fields']['minOriginalSalePrice'] = (float) $data['minOriginalSalePrice'];
                } else {
                    $this->data['fields']['minOriginalSalePrice'] = null;
                }
            }
        }

        return $this->data['fields']['minOriginalSalePrice'];
    }

    /**
     * Set the "isAutoTranslateOption" field.
     *
     * @param mixed $value The value.
     *
     * @return \Mongodb\Items The document (fluent interface).
     */
    public function setIsAutoTranslateOption($value)
    {
        if (!isset($this->data['fields']['isAutoTranslateOption'])) {
            if (!$this->isNew()) {
                $this->getIsAutoTranslateOption();
                if ($this->isFieldEqualTo('isAutoTranslateOption', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['isAutoTranslateOption'] = null;
                $this->data['fields']['isAutoTranslateOption'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('isAutoTranslateOption', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['isAutoTranslateOption']) && !array_key_exists('isAutoTranslateOption', $this->fieldsModified)) {
            $this->fieldsModified['isAutoTranslateOption'] = $this->data['fields']['isAutoTranslateOption'];
        } elseif ($this->isFieldModifiedEqualTo('isAutoTranslateOption', $value)) {
            unset($this->fieldsModified['isAutoTranslateOption']);
        }

        $this->data['fields']['isAutoTranslateOption'] = $value;

        return $this;
    }

    /**
     * Returns the "isAutoTranslateOption" field.
     *
     * @return mixed The $name field.
     */
    public function getIsAutoTranslateOption()
    {
        if (!isset($this->data['fields']['isAutoTranslateOption'])) {
            if ($this->isNew()) {
                $this->data['fields']['isAutoTranslateOption'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('isAutoTranslateOption', $this->data['fields'])) {
                $this->addFieldCache('isAutoTranslateOption');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('isAutoTranslateOption' => 1));
                if (isset($data['isAutoTranslateOption'])) {
                    $this->data['fields']['isAutoTranslateOption'] = (bool) $data['isAutoTranslateOption'];
                } else {
                    $this->data['fields']['isAutoTranslateOption'] = null;
                }
            }
        }

        return $this->data['fields']['isAutoTranslateOption'];
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
        if ('uid' == $name) {
            return $this->setUid($value);
        }
        if ('originItemId' == $name) {
            return $this->setOriginItemId($value);
        }
        if ('originId' == $name) {
            return $this->setOriginId($value);
        }
        if ('titleOrigin' == $name) {
            return $this->setTitleOrigin($value);
        }
        if ('syncProcess' == $name) {
            return $this->setSyncProcess($value);
        }
        if ('homeLand' == $name) {
            return $this->setHomeLand($value);
        }
        if ('title' == $name) {
            return $this->setTitle($value);
        }
        if ('images' == $name) {
            return $this->setImages($value);
        }
        if ('imagesResponse' == $name) {
            return $this->setImagesResponse($value);
        }
        if ('specifications' == $name) {
            return $this->setSpecifications($value);
        }
        if ('itemLocation' == $name) {
            return $this->setItemLocation($value);
        }
        if ('options' == $name) {
            return $this->setOptions($value);
        }
        if ('minOriginPrice' == $name) {
            return $this->setMinOriginPrice($value);
        }
        if ('maxOriginPrice' == $name) {
            return $this->setMaxOriginPrice($value);
        }
        if ('pricesTable' == $name) {
            return $this->setPricesTable($value);
        }
        if ('quantitySteps' == $name) {
            return $this->setQuantitySteps($value);
        }
        if ('bodyImages' == $name) {
            return $this->setBodyImages($value);
        }
        if ('hasDiscount' == $name) {
            return $this->setHasDiscount($value);
        }
        if ('sellerName' == $name) {
            return $this->setSellerName($value);
        }
        if ('sellerId' == $name) {
            return $this->setSellerId($value);
        }
        if ('sellerHomeUrl' == $name) {
            return $this->setSellerHomeUrl($value);
        }
        if ('sellerImage' == $name) {
            return $this->setSellerImage($value);
        }
        if ('sellerPolicy' == $name) {
            return $this->setSellerPolicy($value);
        }
        if ('sellerRequireMin' == $name) {
            return $this->setSellerRequireMin($value);
        }
        if ('originalLink' == $name) {
            return $this->setOriginalLink($value);
        }
        if ('checksum' == $name) {
            return $this->setChecksum($value);
        }
        if ('integrationItems' == $name) {
            return $this->setIntegrationItems($value);
        }
        if ('lastUpdateFromSource' == $name) {
            return $this->setLastUpdateFromSource($value);
        }
        if ('createdTime' == $name) {
            return $this->setCreatedTime($value);
        }
        if ('modifiedTime' == $name) {
            return $this->setModifiedTime($value);
        }
        if ('isActive' == $name) {
            return $this->setIsActive($value);
        }
        if ('isDeleted' == $name) {
            return $this->setIsDeleted($value);
        }
        if ('minPriceSale' == $name) {
            return $this->setMinPriceSale($value);
        }
        if ('maxPriceSale' == $name) {
            return $this->setMaxPriceSale($value);
        }
        if ('onlyUpdatePrice' == $name) {
            return $this->setOnlyUpdatePrice($value);
        }
        if ('tags' == $name) {
            return $this->setTags($value);
        }
        if ('tagsProduct' == $name) {
            return $this->setTagsProduct($value);
        }
        if ('isAutoTranslate' == $name) {
            return $this->setIsAutoTranslate($value);
        }
        if ('maxOriginalSalePrice' == $name) {
            return $this->setMaxOriginalSalePrice($value);
        }
        if ('minOriginalSalePrice' == $name) {
            return $this->setMinOriginalSalePrice($value);
        }
        if ('isAutoTranslateOption' == $name) {
            return $this->setIsAutoTranslateOption($value);
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
        if ('uid' == $name) {
            return $this->getUid();
        }
        if ('originItemId' == $name) {
            return $this->getOriginItemId();
        }
        if ('originId' == $name) {
            return $this->getOriginId();
        }
        if ('titleOrigin' == $name) {
            return $this->getTitleOrigin();
        }
        if ('syncProcess' == $name) {
            return $this->getSyncProcess();
        }
        if ('homeLand' == $name) {
            return $this->getHomeLand();
        }
        if ('title' == $name) {
            return $this->getTitle();
        }
        if ('images' == $name) {
            return $this->getImages();
        }
        if ('imagesResponse' == $name) {
            return $this->getImagesResponse();
        }
        if ('specifications' == $name) {
            return $this->getSpecifications();
        }
        if ('itemLocation' == $name) {
            return $this->getItemLocation();
        }
        if ('options' == $name) {
            return $this->getOptions();
        }
        if ('minOriginPrice' == $name) {
            return $this->getMinOriginPrice();
        }
        if ('maxOriginPrice' == $name) {
            return $this->getMaxOriginPrice();
        }
        if ('pricesTable' == $name) {
            return $this->getPricesTable();
        }
        if ('quantitySteps' == $name) {
            return $this->getQuantitySteps();
        }
        if ('bodyImages' == $name) {
            return $this->getBodyImages();
        }
        if ('hasDiscount' == $name) {
            return $this->getHasDiscount();
        }
        if ('sellerName' == $name) {
            return $this->getSellerName();
        }
        if ('sellerId' == $name) {
            return $this->getSellerId();
        }
        if ('sellerHomeUrl' == $name) {
            return $this->getSellerHomeUrl();
        }
        if ('sellerImage' == $name) {
            return $this->getSellerImage();
        }
        if ('sellerPolicy' == $name) {
            return $this->getSellerPolicy();
        }
        if ('sellerRequireMin' == $name) {
            return $this->getSellerRequireMin();
        }
        if ('originalLink' == $name) {
            return $this->getOriginalLink();
        }
        if ('checksum' == $name) {
            return $this->getChecksum();
        }
        if ('integrationItems' == $name) {
            return $this->getIntegrationItems();
        }
        if ('lastUpdateFromSource' == $name) {
            return $this->getLastUpdateFromSource();
        }
        if ('createdTime' == $name) {
            return $this->getCreatedTime();
        }
        if ('modifiedTime' == $name) {
            return $this->getModifiedTime();
        }
        if ('isActive' == $name) {
            return $this->getIsActive();
        }
        if ('isDeleted' == $name) {
            return $this->getIsDeleted();
        }
        if ('minPriceSale' == $name) {
            return $this->getMinPriceSale();
        }
        if ('maxPriceSale' == $name) {
            return $this->getMaxPriceSale();
        }
        if ('onlyUpdatePrice' == $name) {
            return $this->getOnlyUpdatePrice();
        }
        if ('tags' == $name) {
            return $this->getTags();
        }
        if ('tagsProduct' == $name) {
            return $this->getTagsProduct();
        }
        if ('isAutoTranslate' == $name) {
            return $this->getIsAutoTranslate();
        }
        if ('maxOriginalSalePrice' == $name) {
            return $this->getMaxOriginalSalePrice();
        }
        if ('minOriginalSalePrice' == $name) {
            return $this->getMinOriginalSalePrice();
        }
        if ('isAutoTranslateOption' == $name) {
            return $this->getIsAutoTranslateOption();
        }

        throw new \InvalidArgumentException(sprintf('The document data "%s" is not valid.', $name));
    }

    /**
     * Imports data from an array.
     *
     * @param array $array An array.
     *
     * @return \Mongodb\Items The document (fluent interface).
     */
    public function fromArray(array $array)
    {
        if (isset($array['id'])) {
            $this->setId($array['id']);
        }
        if (isset($array['customerId'])) {
            $this->setCustomerId($array['customerId']);
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
        if (isset($array['titleOrigin'])) {
            $this->setTitleOrigin($array['titleOrigin']);
        }
        if (isset($array['syncProcess'])) {
            $this->setSyncProcess($array['syncProcess']);
        }
        if (isset($array['homeLand'])) {
            $this->setHomeLand($array['homeLand']);
        }
        if (isset($array['title'])) {
            $this->setTitle($array['title']);
        }
        if (isset($array['images'])) {
            $this->setImages($array['images']);
        }
        if (isset($array['imagesResponse'])) {
            $this->setImagesResponse($array['imagesResponse']);
        }
        if (isset($array['specifications'])) {
            $this->setSpecifications($array['specifications']);
        }
        if (isset($array['itemLocation'])) {
            $this->setItemLocation($array['itemLocation']);
        }
        if (isset($array['options'])) {
            $this->setOptions($array['options']);
        }
        if (isset($array['minOriginPrice'])) {
            $this->setMinOriginPrice($array['minOriginPrice']);
        }
        if (isset($array['maxOriginPrice'])) {
            $this->setMaxOriginPrice($array['maxOriginPrice']);
        }
        if (isset($array['pricesTable'])) {
            $this->setPricesTable($array['pricesTable']);
        }
        if (isset($array['quantitySteps'])) {
            $this->setQuantitySteps($array['quantitySteps']);
        }
        if (isset($array['bodyImages'])) {
            $this->setBodyImages($array['bodyImages']);
        }
        if (isset($array['hasDiscount'])) {
            $this->setHasDiscount($array['hasDiscount']);
        }
        if (isset($array['sellerName'])) {
            $this->setSellerName($array['sellerName']);
        }
        if (isset($array['sellerId'])) {
            $this->setSellerId($array['sellerId']);
        }
        if (isset($array['sellerHomeUrl'])) {
            $this->setSellerHomeUrl($array['sellerHomeUrl']);
        }
        if (isset($array['sellerImage'])) {
            $this->setSellerImage($array['sellerImage']);
        }
        if (isset($array['sellerPolicy'])) {
            $this->setSellerPolicy($array['sellerPolicy']);
        }
        if (isset($array['sellerRequireMin'])) {
            $this->setSellerRequireMin($array['sellerRequireMin']);
        }
        if (isset($array['originalLink'])) {
            $this->setOriginalLink($array['originalLink']);
        }
        if (isset($array['checksum'])) {
            $this->setChecksum($array['checksum']);
        }
        if (isset($array['integrationItems'])) {
            $this->setIntegrationItems($array['integrationItems']);
        }
        if (isset($array['lastUpdateFromSource'])) {
            $this->setLastUpdateFromSource($array['lastUpdateFromSource']);
        }
        if (isset($array['createdTime'])) {
            $this->setCreatedTime($array['createdTime']);
        }
        if (isset($array['modifiedTime'])) {
            $this->setModifiedTime($array['modifiedTime']);
        }
        if (isset($array['isActive'])) {
            $this->setIsActive($array['isActive']);
        }
        if (isset($array['isDeleted'])) {
            $this->setIsDeleted($array['isDeleted']);
        }
        if (isset($array['minPriceSale'])) {
            $this->setMinPriceSale($array['minPriceSale']);
        }
        if (isset($array['maxPriceSale'])) {
            $this->setMaxPriceSale($array['maxPriceSale']);
        }
        if (isset($array['onlyUpdatePrice'])) {
            $this->setOnlyUpdatePrice($array['onlyUpdatePrice']);
        }
        if (isset($array['tags'])) {
            $this->setTags($array['tags']);
        }
        if (isset($array['tagsProduct'])) {
            $this->setTagsProduct($array['tagsProduct']);
        }
        if (isset($array['isAutoTranslate'])) {
            $this->setIsAutoTranslate($array['isAutoTranslate']);
        }
        if (isset($array['maxOriginalSalePrice'])) {
            $this->setMaxOriginalSalePrice($array['maxOriginalSalePrice']);
        }
        if (isset($array['minOriginalSalePrice'])) {
            $this->setMinOriginalSalePrice($array['minOriginalSalePrice']);
        }
        if (isset($array['isAutoTranslateOption'])) {
            $this->setIsAutoTranslateOption($array['isAutoTranslateOption']);
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
        $array['uid'] = $this->getUid();
        $array['originItemId'] = $this->getOriginItemId();
        $array['originId'] = $this->getOriginId();
        $array['titleOrigin'] = $this->getTitleOrigin();
        $array['syncProcess'] = $this->getSyncProcess();
        $array['homeLand'] = $this->getHomeLand();
        $array['title'] = $this->getTitle();
        $array['images'] = $this->getImages();
        $array['imagesResponse'] = $this->getImagesResponse();
        $array['specifications'] = $this->getSpecifications();
        $array['itemLocation'] = $this->getItemLocation();
        $array['options'] = $this->getOptions();
        $array['minOriginPrice'] = $this->getMinOriginPrice();
        $array['maxOriginPrice'] = $this->getMaxOriginPrice();
        $array['pricesTable'] = $this->getPricesTable();
        $array['quantitySteps'] = $this->getQuantitySteps();
        $array['bodyImages'] = $this->getBodyImages();
        $array['hasDiscount'] = $this->getHasDiscount();
        $array['sellerName'] = $this->getSellerName();
        $array['sellerId'] = $this->getSellerId();
        $array['sellerHomeUrl'] = $this->getSellerHomeUrl();
        $array['sellerImage'] = $this->getSellerImage();
        $array['sellerPolicy'] = $this->getSellerPolicy();
        $array['sellerRequireMin'] = $this->getSellerRequireMin();
        $array['originalLink'] = $this->getOriginalLink();
        $array['checksum'] = $this->getChecksum();
        $array['integrationItems'] = $this->getIntegrationItems();
        $array['lastUpdateFromSource'] = $this->getLastUpdateFromSource();
        $array['createdTime'] = $this->getCreatedTime();
        $array['modifiedTime'] = $this->getModifiedTime();
        $array['isActive'] = $this->getIsActive();
        $array['isDeleted'] = $this->getIsDeleted();
        $array['minPriceSale'] = $this->getMinPriceSale();
        $array['maxPriceSale'] = $this->getMaxPriceSale();
        $array['onlyUpdatePrice'] = $this->getOnlyUpdatePrice();
        $array['tags'] = $this->getTags();
        $array['tagsProduct'] = $this->getTagsProduct();
        $array['isAutoTranslate'] = $this->getIsAutoTranslate();
        $array['maxOriginalSalePrice'] = $this->getMaxOriginalSalePrice();
        $array['minOriginalSalePrice'] = $this->getMinOriginalSalePrice();
        $array['isAutoTranslateOption'] = $this->getIsAutoTranslateOption();

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
                if (isset($this->data['fields']['uid'])) {
                    $query['uid'] = (string) $this->data['fields']['uid'];
                }
                if (isset($this->data['fields']['originItemId'])) {
                    $query['originItemId'] = (string) $this->data['fields']['originItemId'];
                }
                if (isset($this->data['fields']['originId'])) {
                    $query['originId'] = (string) $this->data['fields']['originId'];
                }
                if (isset($this->data['fields']['titleOrigin'])) {
                    $query['titleOrigin'] = (string) $this->data['fields']['titleOrigin'];
                }
                if (isset($this->data['fields']['syncProcess'])) {
                    $query['syncProcess'] = (bool) $this->data['fields']['syncProcess'];
                }
                if (isset($this->data['fields']['homeLand'])) {
                    $query['homeLand'] = (string) $this->data['fields']['homeLand'];
                }
                if (isset($this->data['fields']['title'])) {
                    $query['title'] = (string) $this->data['fields']['title'];
                }
                if (isset($this->data['fields']['images'])) {
                    $query['images'] = $this->data['fields']['images'];
                }
                if (isset($this->data['fields']['imagesResponse'])) {
                    $query['imagesResponse'] = $this->data['fields']['imagesResponse'];
                }
                if (isset($this->data['fields']['specifications'])) {
                    $query['specifications'] = $this->data['fields']['specifications'];
                }
                if (isset($this->data['fields']['itemLocation'])) {
                    $query['itemLocation'] = (string) $this->data['fields']['itemLocation'];
                }
                if (isset($this->data['fields']['options'])) {
                    $query['options'] = $this->data['fields']['options'];
                }
                if (isset($this->data['fields']['minOriginPrice'])) {
                    $query['minOriginPrice'] = (float) $this->data['fields']['minOriginPrice'];
                }
                if (isset($this->data['fields']['maxOriginPrice'])) {
                    $query['maxOriginPrice'] = (float) $this->data['fields']['maxOriginPrice'];
                }
                if (isset($this->data['fields']['pricesTable'])) {
                    $query['pricesTable'] = $this->data['fields']['pricesTable'];
                }
                if (isset($this->data['fields']['quantitySteps'])) {
                    $query['quantitySteps'] = (int) $this->data['fields']['quantitySteps'];
                }
                if (isset($this->data['fields']['bodyImages'])) {
                    $query['bodyImages'] = $this->data['fields']['bodyImages'];
                }
                if (isset($this->data['fields']['hasDiscount'])) {
                    $query['hasDiscount'] = (bool) $this->data['fields']['hasDiscount'];
                }
                if (isset($this->data['fields']['sellerName'])) {
                    $query['sellerName'] = (string) $this->data['fields']['sellerName'];
                }
                if (isset($this->data['fields']['sellerId'])) {
                    $query['sellerId'] = (string) $this->data['fields']['sellerId'];
                }
                if (isset($this->data['fields']['sellerHomeUrl'])) {
                    $query['sellerHomeUrl'] = (string) $this->data['fields']['sellerHomeUrl'];
                }
                if (isset($this->data['fields']['sellerImage'])) {
                    $query['sellerImage'] = (string) $this->data['fields']['sellerImage'];
                }
                if (isset($this->data['fields']['sellerPolicy'])) {
                    $query['sellerPolicy'] = (string) $this->data['fields']['sellerPolicy'];
                }
                if (isset($this->data['fields']['sellerRequireMin'])) {
                    $query['sellerRequireMin'] = (int) $this->data['fields']['sellerRequireMin'];
                }
                if (isset($this->data['fields']['originalLink'])) {
                    $query['originalLink'] = (string) $this->data['fields']['originalLink'];
                }
                if (isset($this->data['fields']['checksum'])) {
                    $query['checksum'] = (string) $this->data['fields']['checksum'];
                }
                if (isset($this->data['fields']['integrationItems'])) {
                    $query['integrationItems'] = $this->data['fields']['integrationItems'];
                }
                if (isset($this->data['fields']['lastUpdateFromSource'])) {
                    $query['lastUpdateFromSource'] = $this->data['fields']['lastUpdateFromSource']; if ($query['lastUpdateFromSource'] instanceof \DateTime) { $query['lastUpdateFromSource'] = $this->data['fields']['lastUpdateFromSource']->getTimestamp(); } elseif (is_string($query['lastUpdateFromSource'])) { $query['lastUpdateFromSource'] = strtotime($this->data['fields']['lastUpdateFromSource']); } $query['lastUpdateFromSource'] = new \MongoDate($query['lastUpdateFromSource']);
                }
                if (isset($this->data['fields']['createdTime'])) {
                    $query['createdTime'] = $this->data['fields']['createdTime']; if ($query['createdTime'] instanceof \DateTime) { $query['createdTime'] = $this->data['fields']['createdTime']->getTimestamp(); } elseif (is_string($query['createdTime'])) { $query['createdTime'] = strtotime($this->data['fields']['createdTime']); } $query['createdTime'] = new \MongoDate($query['createdTime']);
                }
                if (isset($this->data['fields']['modifiedTime'])) {
                    $query['modifiedTime'] = $this->data['fields']['modifiedTime']; if ($query['modifiedTime'] instanceof \DateTime) { $query['modifiedTime'] = $this->data['fields']['modifiedTime']->getTimestamp(); } elseif (is_string($query['modifiedTime'])) { $query['modifiedTime'] = strtotime($this->data['fields']['modifiedTime']); } $query['modifiedTime'] = new \MongoDate($query['modifiedTime']);
                }
                if (isset($this->data['fields']['isActive'])) {
                    $query['isActive'] = (string) $this->data['fields']['isActive'];
                }
                if (isset($this->data['fields']['isDeleted'])) {
                    $query['isDeleted'] = (bool) $this->data['fields']['isDeleted'];
                }
                if (isset($this->data['fields']['minPriceSale'])) {
                    $query['minPriceSale'] = (float) $this->data['fields']['minPriceSale'];
                }
                if (isset($this->data['fields']['maxPriceSale'])) {
                    $query['maxPriceSale'] = (float) $this->data['fields']['maxPriceSale'];
                }
                if (isset($this->data['fields']['onlyUpdatePrice'])) {
                    $query['onlyUpdatePrice'] = (bool) $this->data['fields']['onlyUpdatePrice'];
                }
                if (isset($this->data['fields']['tags'])) {
                    $query['tags'] = (string) $this->data['fields']['tags'];
                }
                if (isset($this->data['fields']['tagsProduct'])) {
                    $query['tagsProduct'] = $this->data['fields']['tagsProduct'];
                }
                if (isset($this->data['fields']['isAutoTranslate'])) {
                    $query['isAutoTranslate'] = (bool) $this->data['fields']['isAutoTranslate'];
                }
                if (isset($this->data['fields']['maxOriginalSalePrice'])) {
                    $query['maxOriginalSalePrice'] = (float) $this->data['fields']['maxOriginalSalePrice'];
                }
                if (isset($this->data['fields']['minOriginalSalePrice'])) {
                    $query['minOriginalSalePrice'] = (float) $this->data['fields']['minOriginalSalePrice'];
                }
                if (isset($this->data['fields']['isAutoTranslateOption'])) {
                    $query['isAutoTranslateOption'] = (bool) $this->data['fields']['isAutoTranslateOption'];
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
                if (isset($this->data['fields']['titleOrigin']) || array_key_exists('titleOrigin', $this->data['fields'])) {
                    $value = $this->data['fields']['titleOrigin'];
                    $originalValue = $this->getOriginalFieldValue('titleOrigin');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['titleOrigin'] = (string) $this->data['fields']['titleOrigin'];
                        } else {
                            $query['$unset']['titleOrigin'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['syncProcess']) || array_key_exists('syncProcess', $this->data['fields'])) {
                    $value = $this->data['fields']['syncProcess'];
                    $originalValue = $this->getOriginalFieldValue('syncProcess');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['syncProcess'] = (bool) $this->data['fields']['syncProcess'];
                        } else {
                            $query['$unset']['syncProcess'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['homeLand']) || array_key_exists('homeLand', $this->data['fields'])) {
                    $value = $this->data['fields']['homeLand'];
                    $originalValue = $this->getOriginalFieldValue('homeLand');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['homeLand'] = (string) $this->data['fields']['homeLand'];
                        } else {
                            $query['$unset']['homeLand'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['title']) || array_key_exists('title', $this->data['fields'])) {
                    $value = $this->data['fields']['title'];
                    $originalValue = $this->getOriginalFieldValue('title');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['title'] = (string) $this->data['fields']['title'];
                        } else {
                            $query['$unset']['title'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['images']) || array_key_exists('images', $this->data['fields'])) {
                    $value = $this->data['fields']['images'];
                    $originalValue = $this->getOriginalFieldValue('images');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['images'] = $this->data['fields']['images'];
                        } else {
                            $query['$unset']['images'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['imagesResponse']) || array_key_exists('imagesResponse', $this->data['fields'])) {
                    $value = $this->data['fields']['imagesResponse'];
                    $originalValue = $this->getOriginalFieldValue('imagesResponse');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['imagesResponse'] = $this->data['fields']['imagesResponse'];
                        } else {
                            $query['$unset']['imagesResponse'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['specifications']) || array_key_exists('specifications', $this->data['fields'])) {
                    $value = $this->data['fields']['specifications'];
                    $originalValue = $this->getOriginalFieldValue('specifications');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['specifications'] = $this->data['fields']['specifications'];
                        } else {
                            $query['$unset']['specifications'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['itemLocation']) || array_key_exists('itemLocation', $this->data['fields'])) {
                    $value = $this->data['fields']['itemLocation'];
                    $originalValue = $this->getOriginalFieldValue('itemLocation');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['itemLocation'] = (string) $this->data['fields']['itemLocation'];
                        } else {
                            $query['$unset']['itemLocation'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['options']) || array_key_exists('options', $this->data['fields'])) {
                    $value = $this->data['fields']['options'];
                    $originalValue = $this->getOriginalFieldValue('options');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['options'] = $this->data['fields']['options'];
                        } else {
                            $query['$unset']['options'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['minOriginPrice']) || array_key_exists('minOriginPrice', $this->data['fields'])) {
                    $value = $this->data['fields']['minOriginPrice'];
                    $originalValue = $this->getOriginalFieldValue('minOriginPrice');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['minOriginPrice'] = (float) $this->data['fields']['minOriginPrice'];
                        } else {
                            $query['$unset']['minOriginPrice'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['maxOriginPrice']) || array_key_exists('maxOriginPrice', $this->data['fields'])) {
                    $value = $this->data['fields']['maxOriginPrice'];
                    $originalValue = $this->getOriginalFieldValue('maxOriginPrice');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['maxOriginPrice'] = (float) $this->data['fields']['maxOriginPrice'];
                        } else {
                            $query['$unset']['maxOriginPrice'] = 1;
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
                if (isset($this->data['fields']['quantitySteps']) || array_key_exists('quantitySteps', $this->data['fields'])) {
                    $value = $this->data['fields']['quantitySteps'];
                    $originalValue = $this->getOriginalFieldValue('quantitySteps');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['quantitySteps'] = (int) $this->data['fields']['quantitySteps'];
                        } else {
                            $query['$unset']['quantitySteps'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['bodyImages']) || array_key_exists('bodyImages', $this->data['fields'])) {
                    $value = $this->data['fields']['bodyImages'];
                    $originalValue = $this->getOriginalFieldValue('bodyImages');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['bodyImages'] = $this->data['fields']['bodyImages'];
                        } else {
                            $query['$unset']['bodyImages'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['hasDiscount']) || array_key_exists('hasDiscount', $this->data['fields'])) {
                    $value = $this->data['fields']['hasDiscount'];
                    $originalValue = $this->getOriginalFieldValue('hasDiscount');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['hasDiscount'] = (bool) $this->data['fields']['hasDiscount'];
                        } else {
                            $query['$unset']['hasDiscount'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['sellerName']) || array_key_exists('sellerName', $this->data['fields'])) {
                    $value = $this->data['fields']['sellerName'];
                    $originalValue = $this->getOriginalFieldValue('sellerName');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['sellerName'] = (string) $this->data['fields']['sellerName'];
                        } else {
                            $query['$unset']['sellerName'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['sellerId']) || array_key_exists('sellerId', $this->data['fields'])) {
                    $value = $this->data['fields']['sellerId'];
                    $originalValue = $this->getOriginalFieldValue('sellerId');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['sellerId'] = (string) $this->data['fields']['sellerId'];
                        } else {
                            $query['$unset']['sellerId'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['sellerHomeUrl']) || array_key_exists('sellerHomeUrl', $this->data['fields'])) {
                    $value = $this->data['fields']['sellerHomeUrl'];
                    $originalValue = $this->getOriginalFieldValue('sellerHomeUrl');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['sellerHomeUrl'] = (string) $this->data['fields']['sellerHomeUrl'];
                        } else {
                            $query['$unset']['sellerHomeUrl'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['sellerImage']) || array_key_exists('sellerImage', $this->data['fields'])) {
                    $value = $this->data['fields']['sellerImage'];
                    $originalValue = $this->getOriginalFieldValue('sellerImage');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['sellerImage'] = (string) $this->data['fields']['sellerImage'];
                        } else {
                            $query['$unset']['sellerImage'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['sellerPolicy']) || array_key_exists('sellerPolicy', $this->data['fields'])) {
                    $value = $this->data['fields']['sellerPolicy'];
                    $originalValue = $this->getOriginalFieldValue('sellerPolicy');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['sellerPolicy'] = (string) $this->data['fields']['sellerPolicy'];
                        } else {
                            $query['$unset']['sellerPolicy'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['sellerRequireMin']) || array_key_exists('sellerRequireMin', $this->data['fields'])) {
                    $value = $this->data['fields']['sellerRequireMin'];
                    $originalValue = $this->getOriginalFieldValue('sellerRequireMin');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['sellerRequireMin'] = (int) $this->data['fields']['sellerRequireMin'];
                        } else {
                            $query['$unset']['sellerRequireMin'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['originalLink']) || array_key_exists('originalLink', $this->data['fields'])) {
                    $value = $this->data['fields']['originalLink'];
                    $originalValue = $this->getOriginalFieldValue('originalLink');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['originalLink'] = (string) $this->data['fields']['originalLink'];
                        } else {
                            $query['$unset']['originalLink'] = 1;
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
                if (isset($this->data['fields']['integrationItems']) || array_key_exists('integrationItems', $this->data['fields'])) {
                    $value = $this->data['fields']['integrationItems'];
                    $originalValue = $this->getOriginalFieldValue('integrationItems');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['integrationItems'] = $this->data['fields']['integrationItems'];
                        } else {
                            $query['$unset']['integrationItems'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['lastUpdateFromSource']) || array_key_exists('lastUpdateFromSource', $this->data['fields'])) {
                    $value = $this->data['fields']['lastUpdateFromSource'];
                    $originalValue = $this->getOriginalFieldValue('lastUpdateFromSource');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['lastUpdateFromSource'] = $this->data['fields']['lastUpdateFromSource']; if ($query['$set']['lastUpdateFromSource'] instanceof \DateTime) { $query['$set']['lastUpdateFromSource'] = $this->data['fields']['lastUpdateFromSource']->getTimestamp(); } elseif (is_string($query['$set']['lastUpdateFromSource'])) { $query['$set']['lastUpdateFromSource'] = strtotime($this->data['fields']['lastUpdateFromSource']); } $query['$set']['lastUpdateFromSource'] = new \MongoDate($query['$set']['lastUpdateFromSource']);
                        } else {
                            $query['$unset']['lastUpdateFromSource'] = 1;
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
                if (isset($this->data['fields']['isActive']) || array_key_exists('isActive', $this->data['fields'])) {
                    $value = $this->data['fields']['isActive'];
                    $originalValue = $this->getOriginalFieldValue('isActive');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['isActive'] = (string) $this->data['fields']['isActive'];
                        } else {
                            $query['$unset']['isActive'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['isDeleted']) || array_key_exists('isDeleted', $this->data['fields'])) {
                    $value = $this->data['fields']['isDeleted'];
                    $originalValue = $this->getOriginalFieldValue('isDeleted');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['isDeleted'] = (bool) $this->data['fields']['isDeleted'];
                        } else {
                            $query['$unset']['isDeleted'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['minPriceSale']) || array_key_exists('minPriceSale', $this->data['fields'])) {
                    $value = $this->data['fields']['minPriceSale'];
                    $originalValue = $this->getOriginalFieldValue('minPriceSale');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['minPriceSale'] = (float) $this->data['fields']['minPriceSale'];
                        } else {
                            $query['$unset']['minPriceSale'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['maxPriceSale']) || array_key_exists('maxPriceSale', $this->data['fields'])) {
                    $value = $this->data['fields']['maxPriceSale'];
                    $originalValue = $this->getOriginalFieldValue('maxPriceSale');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['maxPriceSale'] = (float) $this->data['fields']['maxPriceSale'];
                        } else {
                            $query['$unset']['maxPriceSale'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['onlyUpdatePrice']) || array_key_exists('onlyUpdatePrice', $this->data['fields'])) {
                    $value = $this->data['fields']['onlyUpdatePrice'];
                    $originalValue = $this->getOriginalFieldValue('onlyUpdatePrice');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['onlyUpdatePrice'] = (bool) $this->data['fields']['onlyUpdatePrice'];
                        } else {
                            $query['$unset']['onlyUpdatePrice'] = 1;
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
                if (isset($this->data['fields']['tagsProduct']) || array_key_exists('tagsProduct', $this->data['fields'])) {
                    $value = $this->data['fields']['tagsProduct'];
                    $originalValue = $this->getOriginalFieldValue('tagsProduct');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['tagsProduct'] = $this->data['fields']['tagsProduct'];
                        } else {
                            $query['$unset']['tagsProduct'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['isAutoTranslate']) || array_key_exists('isAutoTranslate', $this->data['fields'])) {
                    $value = $this->data['fields']['isAutoTranslate'];
                    $originalValue = $this->getOriginalFieldValue('isAutoTranslate');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['isAutoTranslate'] = (bool) $this->data['fields']['isAutoTranslate'];
                        } else {
                            $query['$unset']['isAutoTranslate'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['maxOriginalSalePrice']) || array_key_exists('maxOriginalSalePrice', $this->data['fields'])) {
                    $value = $this->data['fields']['maxOriginalSalePrice'];
                    $originalValue = $this->getOriginalFieldValue('maxOriginalSalePrice');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['maxOriginalSalePrice'] = (float) $this->data['fields']['maxOriginalSalePrice'];
                        } else {
                            $query['$unset']['maxOriginalSalePrice'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['minOriginalSalePrice']) || array_key_exists('minOriginalSalePrice', $this->data['fields'])) {
                    $value = $this->data['fields']['minOriginalSalePrice'];
                    $originalValue = $this->getOriginalFieldValue('minOriginalSalePrice');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['minOriginalSalePrice'] = (float) $this->data['fields']['minOriginalSalePrice'];
                        } else {
                            $query['$unset']['minOriginalSalePrice'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['isAutoTranslateOption']) || array_key_exists('isAutoTranslateOption', $this->data['fields'])) {
                    $value = $this->data['fields']['isAutoTranslateOption'];
                    $originalValue = $this->getOriginalFieldValue('isAutoTranslateOption');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['isAutoTranslateOption'] = (bool) $this->data['fields']['isAutoTranslateOption'];
                        } else {
                            $query['$unset']['isAutoTranslateOption'] = 1;
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