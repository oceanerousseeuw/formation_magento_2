<?php

namespace Correction\TP4ter\Controller\Series;

use Correction\TP4bis\Model\ResourceModel\Series\CollectionFactory as SeriesCollectionFactory;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;

class Index extends \Correction\TP4ter\Controller\AbstractIndex
{
    public function __construct(
        Context $context,
        SeriesCollectionFactory $entityCollectionFactory
    )
    {
        parent::__construct($context, $entityCollectionFactory, [
            'name', 'color'
        ]);
    }
}