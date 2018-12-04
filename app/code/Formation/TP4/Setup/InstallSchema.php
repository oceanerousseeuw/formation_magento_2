<?php

namespace Formation\TP4\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface{

    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();

        $table = $installer->getConnection()->newTable(
            $installer->getTable("tp4_series")
        )->addColumn(
            'series_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true, 'auto_increment' => true ],
            'series id'
        )->addColumn(
                'name',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['unsigned' => true, 'nullable' => false],
                'name'
        )->addColumn(
            'color',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            ['unsigned' => true, 'nullable' => false],
            'color in heximal code'
        )
        ;
        $installer->getConnection()->createTable($table);
    }
}