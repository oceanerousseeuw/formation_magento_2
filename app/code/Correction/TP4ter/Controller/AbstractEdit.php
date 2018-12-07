<?php

namespace Correction\TP4ter\Controller;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;

abstract class AbstractEdit extends AbstractNewAction
{
    protected $entityFactory;
    protected $entityResource;
    protected $entityProperties = [];

    public function __construct(
        Context $context,
        $entityFactory,
        $entityResource,
        $entityProperties
    )
    {
        parent::__construct($context, $entityFactory, $entityResource, $entityProperties);
        $this->isEdit = true;
    }
}