<?php

namespace Correction\TP4ter\Controller\Vendor;

use Correction\TP4bis\Model\VendorFactory;
use Correction\TP4bis\Model\ResourceModel\Vendor as VendorResource;
use Magento\Framework\App\Action\Context;

class View extends \Correction\TP4ter\Controller\AbstractView
{
    public function __construct(
        Context $context,
        VendorFactory $seriesFactory,
        VendorResource $seriesResource
    )
    {
        parent::__construct($context, $seriesFactory, $seriesResource);
    }
}