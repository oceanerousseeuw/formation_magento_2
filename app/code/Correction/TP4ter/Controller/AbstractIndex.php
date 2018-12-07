<?php

namespace Correction\TP4ter\Controller;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;

abstract class AbstractIndex extends Action
{
    protected $entityCollectionFactory;
    protected $entityProperties = [];

    public function __construct(
        Context $context,
        $entityCollectionFactory,
        $entityProperties
    )
    {
        parent::__construct($context);
        $this->entityProperties = $entityProperties;
        $this->entityCollectionFactory = $entityCollectionFactory;
    }


    /**
     * Execute action based on request and return result
     *
     * Note: Request will be added as operation argument in future
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function execute()
    {
        $collection = $this->entityCollectionFactory->create();
        $data = [];
        foreach($collection as $item) {
            $data[] = $item->getData();
        }
        $result = [
            'success' => '1',
            'data' => $data
        ];

        $json = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        $json->setData($result);
        return $json;
    }
}