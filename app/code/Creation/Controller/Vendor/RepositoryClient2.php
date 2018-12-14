<?php

namespace Correction\TP9\Controller\Vendor;

use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\SearchCriteriaBuilder;

class RepositoryClient2 extends RepositoryClient1
{
    protected $filterBuilder;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        \Correction\TP9\Api\VendorRepositoryInterface $vendorRepository,
        FilterBuilder $filterBuilder
    )
    {
        parent::__construct($context, $searchCriteriaBuilder, $vendorRepository);
        $this->filterBuilder = $filterBuilder;
    }

    protected function prepareSearchCriteriaBuilder()
    {
        $filterByName = $this->getRequest()->getParam('name');

        parent::prepareSearchCriteriaBuilder();
        if($filterByName)
        {
            // Je sais, je sais, injections SQL...
            $this->searchCriteriaBuilder->addFilters([
                $this->filterBuilder->setConditionType('like')->setField('name')->setValue('%'.$filterByName.'%')->create()
            ]);
        }
    }
}