<?php

namespace Correction\TP7\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;

class Index extends Action
{
    protected $customerResource;
    protected $customerFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Customer\Model\CustomerFactory $customerFactory,
        \Magento\Customer\Model\ResourceModel\Customer $customerResource
    )
    {
        parent::__construct($context);
        $this->customerFactory = $customerFactory;
        $this->customerResource = $customerResource;
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
        $id = $this->getRequest()->getParam('id');
        $random = $this->getRequest()->getParam('random');

        $customerModel = $this->customerFactory->create();
        if($id)
        {
            if($random)
            {
                $customerModel->setData('random', true);
            }
            $this->customerResource->load($customerModel, $id);
        }

        $json = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        $json->setData($customerModel->getData());
        return $json;
    }
}