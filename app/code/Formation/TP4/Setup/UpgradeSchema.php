<?php

namespace Formation\TP4\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UpgradeSchemaInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{

    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();

        if (version_compare($context->getVersion(), '2.0.0') < 0) {
            $conn = $setup->getConnection();
            $table = $conn->newTable($setup->getTable('tp4_vendor'));
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
                    'tp4_vendor',
                    ['name'],
                    \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE
                ),
                ['name'],
                ['type' => \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE]
            );
            $conn->createTable($table);

            $conn = $setup->getConnection();
            $table = $conn->newTable($setup->getTable('tp4_catalog_product_vendor'));
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
                    'tp4_catalog_product_vendor',
                    ['vendor_id', 'product_id'],
                    \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_PRIMARY
                ),
                ['vendor_id', 'product_id'],
                ['type' => \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_PRIMARY]
            );
            $table->addForeignKey(
                $setup->getFkName('tp4_catalog_product_vendor', 'product_id', 'catalog_product_entity', 'entity_id'),
                'product_id', $setup->getTable('catalog_product_entity'), 'entity_id'
            );
            $table->addForeignKey(
                $setup->getFkName('tp4_catalog_product_vendor', 'vendor_id', 'tp4_vendor', 'vendor_id'),
                'vendor_id', $setup->getTable('tp4_vendor'), 'vendor_id'
            );
            $conn->createTable($table);
        }
    }
}