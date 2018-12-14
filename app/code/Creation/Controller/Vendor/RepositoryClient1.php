<?php

namespace Correction\TP9\Controller\Vendor;

use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;

class RepositoryClient1 extends Action
{
    protected $searchCriteriaBuilder;
    protected $vendorRepository;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        \Correction\TP9\Api\VendorRepositoryInterface $vendorRepository
    )
    {
        parent::__construct($context);
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->vendorRepository = $vendorRepository;
    }

    protected function prepareSearchCriteriaBuilder()
    {
        $this->searchCriteriaBuilder->setCurrentPage(1)->setPageSize(3);
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

        $vendorsSearchResult = $this->vendorRepository->getList($searchCriteria);

        $vendorDataTransferObjects = $vendorsSearchResult->getItems();
        $jsonResult = [];

        foreach($vendorDataTransferObjects as $vendorDataTransferObject)
        {
            $jsonResult[] = [
                'id' => $vendorDataTransferObject->getId(),
                'name' => $vendorDataTransferObject->getName()
            ];
        }
        $jsonResponse = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        $jsonResponse->setData($jsonResult);
        return $jsonResponse;
    }
}