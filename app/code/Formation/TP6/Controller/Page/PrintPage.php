<?php

namespace Formation\TP6\Controller\Page;

use Magento\Framework\App\Action\Action;
use Magento\Framework\Controller\ResultFactory;

class PrintPage extends Action{


    public function execute()
    {
       return $this->resultFactory->create(ResultFactory::TYPE_PAGE);
    }
}