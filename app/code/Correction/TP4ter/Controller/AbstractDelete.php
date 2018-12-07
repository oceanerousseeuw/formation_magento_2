<?php

namespace Correction\TP4ter\Controller;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;

abstract class AbstractDelete extends Action
{
    protected $entityFactory;
    protected $entityResource;
    protected $isEdit;

    public function __construct(
        Context $context,
        $entityFactory,
        $entityResource
    )
    {
        parent::__construct($context);
        $this->entityFactory = $entityFactory;
        $this->entityResource = $entityResource;
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
        $entity = $this->entityFactory->create();

        $id = $this->getRequest()->getParam('id');
        if(!$id)
        {
            $result = [
                'success' => '0',
                'data' => ['ID not provided']
            ];
            $json = $this->resultFactory->create(ResultFactory::TYPE_JSON);
            $json->setData($result);
            return $json;
        }
        $this->entityResource->load($entity, $id);
        if(!$entity->getId())
        {
            $result = [
                'success' => '0',
                'data' => ['Invalid ID']
            ];
            $json = $this->resultFactory->create(ResultFactory::TYPE_JSON);
            $json->setData($result);
            return $json;
        }
        try {
            $this->entityResource->delete($entity);
            $result = [
                'success' => '1',
                'data' => []
            ];
        }
        catch(\Exception $e)
        {
            $result = [
                'success' => '0',
                'data' => $e->getMessage()."\n".$e->getTraceAsString()
            ];
        }

        $json = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        $json->setData($result);
        return $json;
    }
}