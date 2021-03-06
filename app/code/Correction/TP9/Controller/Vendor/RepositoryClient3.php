<?php

namespace Correction\TP9\Controller\Vendor;

use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Api\SortOrderBuilder;

class RepositoryClient3 extends RepositoryClient1
{
    protected $sortOrderBuilder;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        \Correction\TP9\Api\VendorRepositoryInterface $vendorRepository,
        SortOrderBuilder $sortOrderBuilder
    )
    {
        parent::__construct($context, $searchCriteriaBuilder, $vendorRepository);
        $this->sortOrderBuilder = $sortOrderBuilder;
    }

    protected function prepareSearchCriteriaBuilder()
    {
        parent::prepareSearchCriteriaBuilder();
        $dir = $this->getRequest()->getParam('dir');
        if($dir)
        {
            $this->searchCriteriaBuilder->addSortOrder(
                $this->sortOrderBuilder->setField('name')
                    ->setDirection($dir == 'desc' ? SortOrder::SORT_DESC : SortOrder::SORT_ASC)->create()
            );
        }
    }
}