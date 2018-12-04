<?php

namespace Formation\TP4\Model\ResourceModel\Series;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection{

    protected function _construct()
    {
        $this->_init(\Formation\TP4\Model\Series::class,
            \Formation\TP4\Model\ResourceModel\Series::class);
    }

}