<?php

namespace Correction\TP9\Controller\Product;

class RepositoryClient4 extends RepositoryClient1
{
    protected function prepareSearchCriteriaBuilder()
    {
        parent::prepareSearchCriteriaBuilder();
        $page = $this->getRequest()->getParam('page');
        if($page)
        {
            $this->searchCriteriaBuilder->setCurrentPage($page);
        }
    }
}