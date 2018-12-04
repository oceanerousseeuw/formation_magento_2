<?php

namespace Correction\TP3\Controller\Product;

use Magento\Framework\App\Action\Context;
use Magento\Catalog\Model\ProductFactory;
use Magento\Catalog\Model\ResourceModel\Product as ProductResource;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\Raw;
use Magento\Framework\Controller\ResultFactory;

class View extends Action
{
    protected $productFactory;
    protected $productResource;

    public function __construct(
        Context $context,
        ProductFactory $productFactory,
        ProductResource $productResource,
        ResultFactory $resultFactory
    )
    {
        parent::__construct($context);
        $this->productFactory = $productFactory;
        $this->productResource = $productResource;
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
        $productId = $this->getRequest()->getParam('id');
        $productModel = $this->productFactory->create();
        if($productId)
        {
            $this->productResource->load($productModel, $productId);
        }

        /** @var Raw $rawResponse */
        $rawResponse = $this->resultFactory->create(ResultFactory::TYPE_RAW);
        $rawResponse->setContents($productModel->toXml(['entity_id', 'type_id', 'sku']));
        //return $rawResponse;

        $jsonResponse = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        $jsonResponse->setData([
            'name' => $productModel->getName(),
            'sku' => $productModel->getSku(),
            'type_id' => $productModel->getTypeId()
        ]);
        return $jsonResponse;
    }
}