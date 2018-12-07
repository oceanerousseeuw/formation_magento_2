<?php

namespace Correction\TP5\Setup;

use Correction\TP5\Model\Entity\Attribute\Source\Series;
use Magento\Catalog\Model\Product;
use Magento\Eav\Setup\EavSetup;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
    protected $eavSetup;

    public function __construct(
        EavSetup $eavSetup
    )
    {
        $this->eavSetup = $eavSetup;
    }

    /**
     * Installs data for a module
     *
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        $this->eavSetup->addAttribute(Product::ENTITY, 'series', [
            'input' => 'select',
            'type' => 'int',
            'label' => 'Series',
            'source' => Series::class,
            'visible' => true,
            'visible_on_front' => true,
            'is_html_allowed_on_front' => true,
            'is_used_in_grid' => true,
            'is_visible_in_grid' => true,
            'is_filterable_in_grid' => true,
            'group' => 'Product Details'
        ]);
        $setup->endSetup();
    }
}