<?php

namespace Correction\TP6ter\Block\Product\View;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\View\Element\Template;

class Vendors extends Template
{
    protected $request;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        RequestInterface $request,
        \Magento\Catalog\Model\ProductFactory $productFactory,
        \Magento\Catalog\Model\ResourceModel\Product $productResource,
        \Correction\TP4bis\Model\ResourceModel\Vendor\CollectionFactory $collectionFactory,
        array $data = []
    )
    {
        parent::__construct($context, $data);
        $this->request = $request;
        $this->productFactory = $productFactory;
        $this->productResource = $productResource;
        $this->collectionFactory = $collectionFactory;
    }

    public function getVendorsData()
    {
        $id = $this->request->getParam('id');
        if($id)
        {
            $product = $this->productFactory->create();
            $this->productResource->load($product, $id);
            if($product->getId())
            {
                /** @var \Correction\TP4bis\Model\ResourceModel\Vendor\Collection $vendors */
                $vendors = $this->collectionFactory->create();
                $vendors->addProductFilter($product->getId());
                $vendorsData = [];
                foreach($vendors as $vendor)
                {
                    $vendorsData[] = ['Number' => '#'.$vendor->getId(), 'Name' => $vendor->getName()];
                }
                return $vendorsData;
            }
        }
        return [];
    }
}