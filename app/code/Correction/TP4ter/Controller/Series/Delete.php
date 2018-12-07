<?php

namespace Correction\TP4ter\Controller\Series;

use Correction\TP4bis\Model\SeriesFactory;
use Correction\TP4bis\Model\ResourceModel\Series as SeriesResource;
use Magento\Framework\App\Action\Context;

class Delete extends \Correction\TP4ter\Controller\AbstractDelete
{
    public function __construct(
        Context $context,
        SeriesFactory $seriesFactory,
        SeriesResource $seriesResource
    )
    {
        parent::__construct($context, $seriesFactory, $seriesResource);
    }
}