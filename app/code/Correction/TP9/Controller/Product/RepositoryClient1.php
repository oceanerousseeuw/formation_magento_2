<?php

namespace Correction\TP9\Controller\Product;

use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;

class RepositoryClient1 extends Action
{
    protected $searchCriteriaBuilder;
    protected $productRepository;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository
    )
    {
        parent::__construct($context);
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->productRepository = $productRepository;
    }

    protected function prepareSearchCriteriaBuilder()
    {
        $this->searchCriteriaBuilder->setCurrentPage(1)->setPageSize(30);
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
        $this->prepareSearchCriteriaBuilder();
        $searchCriteria = $this->searchCriteriaBuilder->create();

        $productsSearchResult = $this->productRepository->getList($searchCriteria);

        $productDataTransferObjects = $productsSearchResult->getItems();
        $jsonResult = [];

        foreach($productDataTransferObjects as $productDataTransferObject)
        {
            $jsonResult[] = [
                'name' => $productDataTransferObject->getName(),
                'sku' => $productDataTransferObject->getSku(),
                'type' => $productDataTransferObject->getTypeId(),
                'price' => $productDataTransferObject->getPrice(),
            ];
        }
        $jsonResponse = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        $jsonResponse->setData($jsonResult);
        return $jsonResponse;
    }
}