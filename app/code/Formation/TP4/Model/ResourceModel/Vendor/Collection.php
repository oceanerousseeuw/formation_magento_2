<?php

namespace Formation\TP4\Model\ResourceModel\Vendor;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection{

    protected function _construct()
    {
        $this->_init(\Formation\TP4\Model\Vendor::class,
            \Formation\TP4\Model\ResourceModel\Vendor::class);
    }

}