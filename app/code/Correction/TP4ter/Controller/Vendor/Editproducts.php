<?php

namespace Correction\TP4ter\Controller\Vendor;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;

use Correction\TP4bis\Model\VendorFactory;
use Correction\TP4bis\Model\ResourceModel\Vendor as VendorResource;

class Editproducts extends \Correction\TP4ter\Controller\AbstractEdit
{
    public function __construct(
        Context $context,
        VendorFactory $seriesFactory,
        VendorResource $seriesResource
    )
    {
        parent::__construct($context, $seriesFactory, $seriesResource, [
            'name'
        ]);
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

        $products = $this->getRequest()->getParam('products');
        if(is_null($products))
        {
            $result = [
                'success' => '0',
                'data' => ['The following properties are mandatory: products']
            ];
            $json = $this->resultFactory->create(ResultFactory::TYPE_JSON);
            $json->setData($result);
            return $json;
        }
        $products = explode(',',$products);
        $entity->setData('product_ids', $products);
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