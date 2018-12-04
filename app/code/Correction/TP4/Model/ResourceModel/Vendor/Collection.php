<?php

namespace Correction\TP4bis\Model\ResourceModel\Vendor;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(\Correction\TP4bis\Model\Vendor::class, \Correction\TP4bis\Model\ResourceModel\Vendor::class);
    }

    /**
     * @return \Correction\TP4bis\Model\ResourceModel\Vendor\Collection
     */
    public function addProductFilter($productId)
    {
        return $this->addFieldToFilter('product_id', $productId);
    }
}