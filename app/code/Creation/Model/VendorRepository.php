<?php

namespace Correction\TP9\Model;

use Correction\TP9\Api\Data\VendorInterface;
use Correction\TP9\Api\Data\VendorSearchResultInterfaceFactory;
use Correction\TP9\Api\VendorRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\NoSuchEntityException;

class VendorRepository implements VendorRepositoryInterface
{
    protected $vendorDataHelper;
    protected $vendorSearchResultFactory;
    protected $collectionProcessor;
    protected $vendorCollectionFactory;
    protected $vendorModelFactory;
    protected $vendorResource;

    public function __construct(
        \Correction\TP9\Helper\VendorDataHelper $vendorDataHelper,
        VendorSearchResultInterfaceFactory $vendorSearchResultFactory,
        \Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface $collectionProcessor,
        \Correction\TP4bis\Model\ResourceModel\Vendor\CollectionFactory $vendorCollectionFactory,
        \Correction\TP4bis\Model\VendorFactory $vendorModelFactory,
        \Correction\TP4bis\Model\ResourceModel\Vendor $vendorResource
    )
    {
        $this->vendorDataHelper = $vendorDataHelper;
        $this->vendorSearchResultFactory = $vendorSearchResultFactory;
        $this->collectionProcessor = $collectionProcessor;
        $this->vendorCollectionFactory = $vendorCollectionFactory;
        $this->vendorModelFactory = $vendorModelFactory;
        $this->vendorResource = $vendorResource;
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return \Correction\TP9\Api\Data\VendorSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        /** @var \Correction\TP4bis\Model\ResourceModel\Vendor\Collection $collection */
        $collection = $this->vendorCollectionFactory->create();
        $this->collectionProcessor->process($searchCriteria, $collection);

        /** @var \Correction\TP9\Api\Data\VendorSearchResultInterface $searchResult */
        $searchResult = $this->vendorSearchResultFactory->create();
        $searchResult->setTotalCount($collection->getSize());
        $searchResult->setSearchCriteria($searchCriteria);

        $items = [];
        foreach($collection as $item)
        {
            $items[] = $this->vendorDataHelper->getDTOFromModel($item);
        }
        $searchResult->setItems($items);
        return $searchResult;
    }

    /**
     * @param int $id
     * @return VendorInterface
     * @throws NoSuchEntityException
     */
    public function load($id)
    {
        /** @var \Correction\TP4bis\Model\Vendor $vendorModel */
        $vendorModel = $this->vendorModelFactory->create();
        $this->vendorResource->load($vendorModel, $id);
        if(!$vendorModel->getId())
        {
            throw new NoSuchEntityException(
                __("The vendor doesn't exist.")
            );
        }
        return $this->vendorDataHelper->getDTOFromModel($vendorModel);
    }

    /**
     * @param VendorInterface $vendor
     * @return VendorInterface
     */
    public function save(VendorInterface $vendor)
    {
        $vendorModel = $this->vendorDataHelper->getModelFromDTO($vendor);
        $this->vendorResource->save($vendorModel);
        return $this->vendorDataHelper->getDTOFromModel($vendorModel);
    }

    /**
     * @param int $id
     * @return int[]
     */
    public function getAssociatedProductIds($id)
    {
        /** @var \Correction\TP4bis\Model\Vendor $vendorModel */
        $vendorModel = $this->vendorModelFactory->create();
        $this->vendorResource->load($vendorModel, $id);
        if(!$vendorModel->getId())
        {
            throw new NoSuchEntityException(
                __("The vendor doesn't exist.")
            );
        }
        return $vendorModel->getProductIds();
    }
}