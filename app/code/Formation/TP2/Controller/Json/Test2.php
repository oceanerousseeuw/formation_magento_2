<?php

namespace Formation\TP2\Controller\Json;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;

class Test2 extends Action
{

    protected $resultFactory;

    public function __construct(Context $context, ResultFactory $resultFactory)
    {
        $this->resultFactory = $resultFactory;
        parent::__construct($context);
    }

    public function execute(){
        $jsonObject = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        $action = $this->getRequest()->getParam("action");
        if($action == "forward"){
            $redirect = $this->resultFactory->create(ResultFactory::TYPE_FORWARD);
            $redirect->forward("test1");
        }elseif($action == "redirect"){
            $redirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
            $redirect->setPath("*/*/test1");
        }else{
            $jsonObject->setData(array("action" => $action));
            return $jsonObject;
        }
        return $redirect;
    }

}