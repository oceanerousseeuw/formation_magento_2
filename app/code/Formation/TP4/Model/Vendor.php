<?php

namespace Formation\TP4\Model;

use Magento\Framework\Model\AbstractModel;

class Vendor extends AbstractModel {

    protected function _construct(){
        $this->_init(\Formation\TP4\Model\ResourceModel\Vendor::class);
    }

}