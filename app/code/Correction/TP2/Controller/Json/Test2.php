<?php

namespace Correction\TP2bis\Controller\Json;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;

class Test2 extends Action
{
    protected $jsonFactory;

    public function __construct(
        Context $context,
        ResultFactory $resultFactory
    )
    {
        parent::__construct($context);
        $this->resultFactory = $resultFactory;
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
        $action = $this->getRequest()->getParam('action');

        if($action == 'forward')
        {
            $forward = $this->resultFactory->create(ResultFactory::TYPE_FORWARD);
            /** @var $forward \Magento\Framework\Controller\Result\Forward */
            $forward->forward('test1');
            return $forward;
        }
        else
        {
            if($action == 'redirect')
            {
                $redirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
                /** @var $redirect \Magento\Framework\Controller\Result\Redirect */
                $redirect->setPath('*/*/test1', $this->getRequest()->getParams());
                return $redirect;
            }
        }

        $json = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        $json->setData([
            [
                'controller_class' => get_class($this),
                'tp' => 2,
                'controller' => 2,
                'correction' => true
            ]
        ]);
        return $json;
    }
}