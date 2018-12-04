<?php

namespace Correction\TP4bis\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Series extends AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('correctiontp4_series', 'series_id');
    }
}