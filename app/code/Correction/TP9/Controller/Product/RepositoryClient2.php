<?php

namespace Correction\TP9\Controller\Product;

use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\SearchCriteriaBuilder;

class RepositoryClient2 extends RepositoryClient1
{
    protected $filterBuilder;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
        FilterBuilder $filterBuilder
    )
    {
        parent::__construct($context, $searchCriteriaBuilder, $productRepository);
        $this->filterBuilder = $filterBuilder;
    }

    protected function prepareSearchCriteriaBuilder()
    {
        $filterByType = $this->getRequest()->getParam('type');
        $filterByName = $this->getRequest()->getParam('name');

        parent::prepareSearchCriteriaBuilder();
        if($filterByType)
        {
            $this->searchCriteriaBuilder->addFilters([
                $this->filterBuilder->setConditionType('eq')->setField('type_id')->setValue($filterByType)->create()
            ]);
        }
        if($filterByName)
        {
            // Je sais, je sais, injections SQL...
            $this->searchCriteriaBuilder->addFilters([
                $this->filterBuilder->setConditionType('like')->setField('name')->setValue('%'.$filterByName.'%')->create()
            ]);
        }
    }
}