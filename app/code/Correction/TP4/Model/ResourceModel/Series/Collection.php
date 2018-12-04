<?php

namespace Correction\TP4bis\Model\ResourceModel\Series;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(\Correction\TP4bis\Model\Series::class, \Correction\TP4bis\Model\ResourceModel\Series::class);
    }
}