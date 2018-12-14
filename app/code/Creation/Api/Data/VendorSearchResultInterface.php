<?php

namespace Correction\TP9\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface VendorSearchResultInterface extends SearchResultsInterface
{
    /**
     * Get items list.
     *
     * @return \Correction\TP9\Api\Data\VendorInterface[]
     */
    public function getItems();

    /**
     * Set items list.
     *
     * @param \Correction\TP9\Api\Data\VendorInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}