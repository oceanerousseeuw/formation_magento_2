<?php

namespace Correction\TP9\Helper;

class VendorDataHelper
{
    protected $vendorDataFactory;
    protected $vendorModelFactory;
    protected $vendorResource;

    public function __construct(
        \Correction\TP9\Api\Data\VendorInterfaceFactory $vendorDataFactory,
        \Correction\TP4bis\Model\VendorFactory $vendorModelFactory,
        \Correction\TP4bis\Model\ResourceModel\Vendor $vendorResource
    )
    {
        $this->vendorDataFactory = $vendorDataFactory;
        $this->vendorModelFactory = $vendorModelFactory;
        $this->vendorResource = $vendorResource;
    }

    /**
     * @param \Correction\TP9\Api\Data\VendorInterface $vendorData
     * @return \Correction\TP4bis\Model\Vendor
     */
    public function getModelFromDTO(\Correction\TP9\Api\Data\VendorInterface $vendorData)
    {
        $model = $this->vendorModelFactory->create();
        if($vendorData->getId())
        {
            $this->vendorResource->load($model, $vendorData->getId());
        }
        $model->setName($vendorData->getName());
        return $model;
    }

    /**
     * @param \Correction\TP4bis\Model\Vendor $vendorModel
     * @return \Correction\TP9\Api\Data\VendorInterface
     */
    public function getDTOFromModel(\Correction\TP4bis\Model\Vendor $vendorModel)
    {
        $dto = $this->vendorDataFactory->create();
        $dto->setId($vendorModel->getId())->setName($vendorModel->getName());
        return $dto;
    }
}