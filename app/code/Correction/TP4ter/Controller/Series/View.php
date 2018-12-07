<?php

namespace Correction\TP4ter\Controller\Series;

use Correction\TP4bis\Model\SeriesFactory;
use Correction\TP4bis\Model\ResourceModel\Series as SeriesResource;
use Magento\Framework\App\Action\Context;

class View extends \Correction\TP4ter\Controller\AbstractView
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