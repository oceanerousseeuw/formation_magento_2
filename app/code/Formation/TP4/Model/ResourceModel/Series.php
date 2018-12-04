<?php

namespace Formation\TP4\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Series extends AbstractDb{

    protected function _construct()
    {
        $this->_init('tp4_series', 'series_id');
    }
}