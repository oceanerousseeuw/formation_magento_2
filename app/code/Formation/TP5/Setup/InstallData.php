<?php

namespace Formation\TP5\Setup;

use Magento\Eav\Model\Entity;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Eav\Setup\EavSetup;
use Magento\Catalog\Model\Product;

use Formation\TP5\Model\Entity\Attribute\Source\Series;

class InstallData implements InstallDataInterface{

    private $productSetup;
    private $eavConfig;
    private $attributeResource;

    public function __construct(EavSetup $productSetup,
                                \Magento\Eav\Model\Config $eavConfig,
                                \Magento\Customer\Model\ResourceModel\Attribute $attributeResource)
    {
        $this->attributeResource = $attributeResource;
        $this->eavConfig = $eavConfig;
        $this->productSetup = $productSetup;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        $this->productSetup->addAttribute(
            Product::ENTITY,
            "series",
            [
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
            ]
        );

        /*$attribute = $this->eavConfig->getAttribute(Product::ENTITY, 'series');
        $attribute->setData('used_in_forms', ['adminhtml_customer']);
        $this->attributeResource->save($attribute);*/

        $setup->endSetup();
    }
}