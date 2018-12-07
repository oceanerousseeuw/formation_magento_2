<?php

namespace Correction\TP9\Model\Data;

use Correction\TP9\Api\Data\VendorInterface;
use Magento\Framework\Api\AbstractExtensibleObject;

class Vendor extends AbstractExtensibleObject implements VendorInterface
{
    /**
     * @return int
     */
    public function getId()
    {
        return $this->_get(self::ID);
    }

    /**
     * @param int $id
     * @return $this
     */
    public function setId($id)
    {
        return $this->setData(self::ID, $id);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->_get(self::NAME);
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }
}