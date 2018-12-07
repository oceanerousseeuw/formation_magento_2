<?php

namespace Correction\TP4bis\Model\ResourceModel;

use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Vendor extends AbstractDb
{
    protected $linkTable = '';
    protected $productIds = [];

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('correctiontp4_vendor', 'vendor_id');
        $this->linkTable = $this->getTable('correctiontp4_catalog_product_vendor');
    }

    /**
     * Perform actions after object load
     *
     * @param \Magento\Framework\Model\AbstractModel|\Magento\Framework\DataObject $object
     * @return $this
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    protected function _afterLoad(\Magento\Framework\Model\AbstractModel $object)
    {
        $conn = $this->getConnection();
        $select = $conn->select()->from($this->linkTable, 'product_id')
            ->where($conn->quoteInto('vendor_id = ?', $object->getId()));
        $productIds = [];
        foreach($conn->fetchAll($select) as $row)
        {
            $productIds[] = $row['product_id'];
        }
        $object->setData('product_ids', $productIds);
        return parent::_afterLoad($object);
    }

    /**
     * Perform actions before object save
     *
     * @param \Magento\Framework\Model\AbstractModel|\Magento\Framework\DataObject $object
     * @return $this
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    protected function _beforeSave(\Magento\Framework\Model\AbstractModel $object)
    {
        $productIds = $object->getData('product_ids');
        if(!$productIds)
        {
            $productIds = [];
        }
        $this->productIds = $productIds;
        return parent::_beforeSave($object);
    }

    /**
     * Perform actions after object save
     *
     * @param \Magento\Framework\Model\AbstractModel|\Magento\Framework\DataObject $object
     * @return $this
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    protected function _afterSave(\Magento\Framework\Model\AbstractModel $object)
    {
        $productIds = $this->productIds;

        $conn = $this->getConnection();
        $conn->delete($this->linkTable, $conn->quoteInto('vendor_id = ?', $object->getId()));
        $toInsert = [];
        foreach($productIds as $productId)
        {
            $toInsert[] = ['vendor_id' => $object->getId(), 'product_id' => $productId];
        }
        if($toInsert)
        {
            $conn->insertMultiple($this->linkTable, $toInsert);
        }
        return parent::_afterSave($object);
    }
}