<?php

namespace Correction\TP4ter\Controller\Vendor;

use Correction\TP4bis\Model\ResourceModel\Vendor\CollectionFactory as VendorCollectionFactory;
use Magento\Framework\App\Action\Context;

class Index extends \Correction\TP4ter\Controller\AbstractIndex
{
    public function __construct(
        Context $context,
        VendorCollectionFactory $entityCollectionFactory
    )
    {
        parent::__construct($context, $entityCollectionFactory, [
            'name', 'color'
        ]);
    }
}