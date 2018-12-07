<?php

namespace Correction\TP4bis\Model\ResourceModel\Vendor;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $linkTable = '';

    protected function _construct()
    {
        $this->_init(\Correction\TP4bis\Model\Vendor::class, \Correction\TP4bis\Model\ResourceModel\Vendor::class);
        $this->linkTable = $this->getTable('correctiontp4_catalog_product_vendor');
    }

    /**
     * @return \Correction\TP4bis\Model\ResourceModel\Vendor\Collection
     */
    public function addProductFilter($productId)
    {
        $this->getSelect()
            ->join(['l' => $this->linkTable], 'l.vendor_id = main_table.vendor_id', [])
            ->where('product_id = ?', $productId);
        return $this;
    }
}