<?php

namespace Correction\TP2bis\Controller\Json;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\JsonFactory;

class Test1 extends Action
{
    protected $jsonFactory;

    public function __construct(
        Context $context,
        JsonFactory $jsonFactory
    )
    {
        parent::__construct($context);
        $this->jsonFactory = $jsonFactory;
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
        $json = $this->jsonFactory->create();
        $json->setData(array_merge($this->getRequest()->getParams(),
            [
                'controller_class' => get_class($this),
                'tp' => 2,
                'controller' => 1,
                'correction' => true
            ]
        ));
        return $json;
    }
}