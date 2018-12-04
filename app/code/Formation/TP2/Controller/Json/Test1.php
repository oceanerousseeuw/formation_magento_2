<?php

namespace Formation\TP2\Controller\Json;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;

class Test1 extends Action
{

    protected $resultFactory;

    public function __construct(
        Context $context,
        ResultFactory $resultFactory
    )
    {
        $this->resultFactory = $resultFactory;
        parent::__construct($context);
    }

    public function execute(){
        $jsonObject = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        $params = $this->getRequest()->getParams();
        if($params == null){
            $jsonObject->setData(array("test" => "truc"));
        }else {
            $jsonObject->setData(array("test" => $params["test"], "parametre" => $params["parametre"]));
        }
        return $jsonObject;
    }

}