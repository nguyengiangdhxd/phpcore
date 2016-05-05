<?php

namespace Mongodb\Base;

/**
 * Base class of Mongodb\OriginalItem document.
 */
abstract class OriginalItem extends \Mandango\Document\Document implements \ArrayAccess
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
     * @return \Mongodb\OriginalItem The document (fluent interface).
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
        if (isset($data['originalId'])) {
            $this->data['fields']['originalId'] = (string) $data['originalId'];
        } elseif (isset($data['_fields']['originalId'])) {
            $this->data['fields']['originalId'] = null;
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
     * Set the "originalId" field.
     *
     * @param mixed $value The value.
     *
     * @return \Mongodb\OriginalItem The document (fluent interface).
     */
    public function setOriginalId($value)
    {
        if (!isset($this->data['fields']['originalId'])) {
            if (!$this->isNew()) {
                $this->getOriginalId();
                if ($this->isFieldEqualTo('originalId', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['originalId'] = null;
                $this->data['fields']['originalId'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('originalId', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['originalId']) && !array_key_exists('originalId', $this->fieldsModified)) {
            $this->fieldsModified['originalId'] = $this->data['fields']['originalId'];
        } elseif ($this->isFieldModifiedEqualTo('originalId', $value)) {
            unset($this->fieldsModified['originalId']);
        }

        $this->data['fields']['originalId'] = $value;

        return $this;
    }

    /**
     * Returns the "originalId" field.
     *
     * @return mixed The $name field.
     */
    public function getOriginalId()
    {
        if (!isset($this->data['fields']['originalId'])) {
            if ($this->isNew()) {
                $this->data['fields']['originalId'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('originalId', $this->data['fields'])) {
                $this->addFieldCache('originalId');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('originalId' => 1));
                if (isset($data['originalId'])) {
                    $this->data['fields']['originalId'] = (string) $data['originalId'];
                } else {
                    $this->data['fields']['originalId'] = null;
                }
            }
        }

        return $this->data['fields']['originalId'];
    }

    /**
     * Set the "homeLand" field.
     *
     * @param mixed $value The value.
     *
     * @return \Mongodb\OriginalItem The document (fluent interface).
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
     * @return \Mongodb\OriginalItem The document (fluent interface).
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
     * @return \Mongodb\OriginalItem The document (fluent interface).
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
     * Set the "specifications" field.
     *
     * @param mixed $value The value.
     *
     * @return \Mongodb\OriginalItem The document (fluent interface).
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
     * @return \Mongodb\OriginalItem The document (fluent interface).
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
     * @return \Mongodb\OriginalItem The document (fluent interface).
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
     * Set the "pricesTable" field.
     *
     * @param mixed $value The value.
     *
     * @return \Mongodb\OriginalItem The document (fluent interface).
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
     * @return \Mongodb\OriginalItem The document (fluent interface).
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
     * @return \Mongodb\OriginalItem The document (fluent interface).
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
     * @return \Mongodb\OriginalItem The document (fluent interface).
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
     * @return \Mongodb\OriginalItem The document (fluent interface).
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
     * @return \Mongodb\OriginalItem The document (fluent interface).
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
     * @return \Mongodb\OriginalItem The document (fluent interface).
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
     * @return \Mongodb\OriginalItem The document (fluent interface).
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
     * @return \Mongodb\OriginalItem The document (fluent interface).
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
     * @return \Mongodb\OriginalItem The document (fluent interface).
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
     * @return \Mongodb\OriginalItem The document (fluent interface).
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
     * @return \Mongodb\OriginalItem The document (fluent interface).
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
     * @return \Mongodb\OriginalItem The document (fluent interface).
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
     * @return \Mongodb\OriginalItem The document (fluent interface).
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
        if ('originalId' == $name) {
            return $this->setOriginalId($value);
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
        if ('specifications' == $name) {
            return $this->setSpecifications($value);
        }
        if ('itemLocation' == $name) {
            return $this->setItemLocation($value);
        }
        if ('options' == $name) {
            return $this->setOptions($value);
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
        if ('originalId' == $name) {
            return $this->getOriginalId();
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
        if ('specifications' == $name) {
            return $this->getSpecifications();
        }
        if ('itemLocation' == $name) {
            return $this->getItemLocation();
        }
        if ('options' == $name) {
            return $this->getOptions();
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
     * @return \Mongodb\OriginalItem The document (fluent interface).
     */
    public function fromArray(array $array)
    {
        if (isset($array['id'])) {
            $this->setId($array['id']);
        }
        if (isset($array['originalId'])) {
            $this->setOriginalId($array['originalId']);
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
        if (isset($array['specifications'])) {
            $this->setSpecifications($array['specifications']);
        }
        if (isset($array['itemLocation'])) {
            $this->setItemLocation($array['itemLocation']);
        }
        if (isset($array['options'])) {
            $this->setOptions($array['options']);
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

        $array['originalId'] = $this->getOriginalId();
        $array['homeLand'] = $this->getHomeLand();
        $array['title'] = $this->getTitle();
        $array['images'] = $this->getImages();
        $array['specifications'] = $this->getSpecifications();
        $array['itemLocation'] = $this->getItemLocation();
        $array['options'] = $this->getOptions();
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
                if (isset($this->data['fields']['originalId'])) {
                    $query['originalId'] = (string) $this->data['fields']['originalId'];
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
                if (isset($this->data['fields']['specifications'])) {
                    $query['specifications'] = $this->data['fields']['specifications'];
                }
                if (isset($this->data['fields']['itemLocation'])) {
                    $query['itemLocation'] = (string) $this->data['fields']['itemLocation'];
                }
                if (isset($this->data['fields']['options'])) {
                    $query['options'] = $this->data['fields']['options'];
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
                if (isset($this->data['fields']['createdTime'])) {
                    $query['createdTime'] = $this->data['fields']['createdTime']; if ($query['createdTime'] instanceof \DateTime) { $query['createdTime'] = $this->data['fields']['createdTime']->getTimestamp(); } elseif (is_string($query['createdTime'])) { $query['createdTime'] = strtotime($this->data['fields']['createdTime']); } $query['createdTime'] = new \MongoDate($query['createdTime']);
                }
                if (isset($this->data['fields']['modifiedTime'])) {
                    $query['modifiedTime'] = $this->data['fields']['modifiedTime']; if ($query['modifiedTime'] instanceof \DateTime) { $query['modifiedTime'] = $this->data['fields']['modifiedTime']->getTimestamp(); } elseif (is_string($query['modifiedTime'])) { $query['modifiedTime'] = strtotime($this->data['fields']['modifiedTime']); } $query['modifiedTime'] = new \MongoDate($query['modifiedTime']);
                }
            } else {
                if (isset($this->data['fields']['originalId']) || array_key_exists('originalId', $this->data['fields'])) {
                    $value = $this->data['fields']['originalId'];
                    $originalValue = $this->getOriginalFieldValue('originalId');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['originalId'] = (string) $this->data['fields']['originalId'];
                        } else {
                            $query['$unset']['originalId'] = 1;
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