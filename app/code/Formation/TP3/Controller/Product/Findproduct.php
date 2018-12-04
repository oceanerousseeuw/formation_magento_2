<?php

namespace Formation\TP3\Controller\Product;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory as ResultFactory;
use Magento\Catalog\Model\ProductFactory as ProductFactory;
use Magento\Catalog\Model\ResourceModel\Product as ProductResource;

class Findproduct extends Action
{

    protected $_productFactory;
    protected $_resultFactory;
    protected $_productResource;

    public function __construct(
        Context $context,
        ProductFactory $productFactory,
        ResultFactory $resultFactory,
        ProductResource $productResource
    )
    {
        $this->_productFactory = $productFactory;
        $this->_resultFactory = $resultFactory;
        $this->_productResource = $productResource;
        parent::__construct($context);
    }

    public function execute(){

        $id = $this->getRequest()->getParam('id');
        if($id == null){
            return null;
        }else{
            /**
             * on va demander a la resource de load le produit qui correspond a l'id et le remettre dans le model
             */
            $model = $this->_productFactory->create();
            $resource = $this->_productResource;

            $jsonObject = $this->_resultFactory->create(ResultFactory::TYPE_JSON);
            $jsonObject->setData(array("id" => $id,
                "name" => $model->getData("name"),
                "type_id" => $model->getData("type_id"),
                "sku" => $model->getData("sku")));
        }
        return $jsonObject;
    }
}