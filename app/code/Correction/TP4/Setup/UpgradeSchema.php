<?php

namespace Correction\TP4\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{

    /**
     * Upgrades DB schema for a module
     *
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        if (version_compare($context->getVersion(), '1.0.1', '<')) {

            $conn = $setup->getConnection();
            $table = $conn->newTable($setup->getTable('correctiontp4_vendor'));
            $table->addColumn('vendor_id', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'Identifier'
            );
            $table->addColumn('name', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Series name'
            );
            $table->addIndex(
                $setup->getIdxName(
                    'correctiontp4_vendor',
                    ['name'],
                    \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE
                ),
                ['name'],
                ['type' => \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE]
            );
            $conn->createTable($table);
        }
        if (version_compare($context->getVersion(), '1.0.2', '<')) {

            $conn = $setup->getConnection();
            $table = $conn->newTable($setup->getTable('correctiontp4_catalog_product_vendor'));
            $table->addColumn('vendor_id', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['unsigned' => true, 'nullable' => false],
                'Vendor Identifier'
            );
            $table->addColumn('product_id', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                10,
                ['unsigned' => true, 'nullable' => false],
                'Product Identifier'
            );
            $table->addIndex(
                $setup->getIdxName(
                    'correctiontp4_catalog_product_vendor',
                    ['vendor_id', 'product_id'],
                    \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_PRIMARY
                ),
                ['vendor_id', 'product_id'],
                ['type' => \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_PRIMARY]
            );
            $table->addForeignKey(
                $setup->getFkName('correctiontp4_catalog_product_vendor', 'product_id', 'catalog_product_entity', 'entity_id'),
                'product_id', $setup->getTable('catalog_product_entity'), 'entity_id'
            );
            $table->addForeignKey(
                $setup->getFkName('correctiontp4_catalog_product_vendor', 'vendor_id', 'correctiontp4_vendor', 'vendor_id'),
                'vendor_id', $setup->getTable('correctiontp4_vendor'), 'vendor_id'
            );
            $conn->createTable($table);
        }
    }
}