<?php

namespace Formation\TP4\Controller\Series;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory as ResultFactory;
use Formation\TP4\Model\SeriesFactory;
use Formation\TP4\Model\ResourceModel\Series as SeriesResource;

class PrintSerie extends Action{

    protected $_resultFactory;
    protected $_seriesFactory;
    protected $_seriesResource;

    public function __construct(
        Context $context,
        ResultFactory $resultFactory,
        SeriesFactory $seriesFactory,
        SeriesResource $seriesResource
    )
    {
        $this->_resultFactory = $resultFactory;
        $this->_seriesFactory = $seriesFactory;
        $this->_seriesResource = $seriesResource;
        parent::__construct($context);
    }

    public function execute()
    {
        $params = $this->getRequest()->getParams();
        $jsonObject = $this->_resultFactory->create(ResultFactory::TYPE_JSON);
        if(empty($params['id'])){
            $jsonObject->setData(array("success" => 0));
        }else{
            $model = $this->_seriesFactory->create();
            $resource = $this->_seriesResource;
            $resource->load($model, $params['id']);

            $jsonObject->setData(array("success" => 1,
                "id" => $params['id'],
                "name" => $model->getData("name"),
                "color" => "#" . $model->getData("color")));
        }
        return $jsonObject;
    }
}