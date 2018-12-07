<?php

namespace Correction\TP4bis\Model;

use Correction\TP4bis\Model\ResourceModel\Series as SeriesResource;
use Magento\Framework\Model\AbstractModel;

class Series extends AbstractModel
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(SeriesResource::class);
    }
}