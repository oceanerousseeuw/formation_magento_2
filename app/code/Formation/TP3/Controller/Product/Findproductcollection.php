<?php

namespace Formation\TP2\Controller\Json;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory as ResultFactory;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory as CollectionFactory ;

class Findproductcollection extends Action
{

    protected $_collectionFactory;
    protected $_resultFactory;

    public function __construct(
        Context $context,
        CollectionFactory $collectionFactory,
        ResultFactory $resultFactory
    )
    {
        $this->_collectionFactory = $collectionFactory;
        $this->_resultFactory = $resultFactory;
        parent::__construct($context);
    }

    public function execute(){

        $type = $this->getRequest()->getParam('type');
        if($type == null){
            return "Error ! No parameter !";
        }else{
            $collection = $this->_collectionFactory->create();
            $collection->addAttributeToFilter('type_id', $type);
            $collection->addAttributeToSelect('name');

            $jsonObject = $this->_resultFactory->create(ResultFactory::TYPE_JSON);

            $items = [];

            foreach($collection as $item){
                $items[] = $item->toJson('name','sku');
            }

            $jsonObject->setData($items);
        }
        return $jsonObject;
    }

}