<?php

namespace Correction\TP4bis\Model;

use Correction\TP4bis\Model\ResourceModel\Vendor as VendorResource;
use Magento\Framework\Model\AbstractModel;

class Vendor extends AbstractModel
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(VendorResource::class);
    }
}