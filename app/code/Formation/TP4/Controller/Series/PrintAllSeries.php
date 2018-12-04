<?php

namespace Formation\TP4\Controller\Series;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory as ResultFactory;
use Formation\TP4\Model\SeriesFactory;
use Formation\TP4\Model\ResourceModel\Series\CollectionFactory as CollectionFactory ;

class PrintAllSeries extends Action
{

    protected $_resultFactory;
    protected $_collectionFactory;

    public function __construct(
        Context $context,
        ResultFactory $resultFactory,
        CollectionFactory $collectionFactory
    )
    {
        $this->_resultFactory = $resultFactory;
        $this->_collectionFactory = $collectionFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $jsonObject = $this->_resultFactory->create(ResultFactory::TYPE_JSON);
        $collection = $this->_collectionFactory->create();

        $items = [];

        foreach($collection as $item){
            /** @var $item \Formation\TP4\Model\Series */
            $items[] = $item->getData();
        }

        $jsonObject->setData($items);
            
        return $jsonObject;

    }
}