<?php

namespace Correction\TP4ter\Controller;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;

abstract class AbstractNewAction extends Action
{
    protected $entityFactory;
    protected $entityResource;
    protected $entityProperties = [];
    protected $isEdit;

    public function __construct(
        Context $context,
        $entityFactory,
        $entityResource,
        $entityProperties
    )
    {
        parent::__construct($context);
        $this->entityFactory = $entityFactory;
        $this->entityResource = $entityResource;
        $this->entityProperties = $entityProperties;
        $this->isEdit = false;
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
        $result = [];
        $providedProperties = [];

        $entity = $this->entityFactory->create();
        if($this->isEdit)
        {
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
        }
        foreach($this->entityProperties as $property)
        {
            $propertyValue = $this->getRequest()->getParam($property);
            if(is_null($propertyValue))
            {
                $result = [
                    'success' => '0',
                    'data' => ['The following properties are mandatory: '.implode(', ',  $this->entityProperties)]
                ];
                $json = $this->resultFactory->create(ResultFactory::TYPE_JSON);
                $json->setData($result);
                return $json;
            }
            $providedProperties[$property] = $this->getRequest()->getParam($property);
        }
        $entity->addData($providedProperties);
        try {
            $this->entityResource->save($entity);
            $result = [
                'success' => '1',
                'data' => $entity->getData()
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