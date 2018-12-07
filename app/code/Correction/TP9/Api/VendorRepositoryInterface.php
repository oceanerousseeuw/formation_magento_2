<?php

namespace Correction\TP9\Api;

use Correction\TP9\Api\Data\VendorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * @api
 */
interface VendorRepositoryInterface
{
    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return \Correction\TP9\Api\Data\VendorSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria);

    /**
     * @param int $id
     * @return \Correction\TP9\Api\Data\VendorInterface
     * @throws NoSuchEntityException
     */
    public function load($id);

    /**
     * @param \Correction\TP9\Api\Data\VendorInterface $vendor
     * @return \Correction\TP9\Api\Data\VendorInterface
     */
    public function save(VendorInterface $vendor);

    /**
     * @param int $id
     * @return int[]
     */
    public function getAssociatedProductIds($id);
}