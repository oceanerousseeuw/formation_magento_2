<?php

namespace Formation\TP10\Model\ResourceModel\Grid\Vendor;


class Collection extends \Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult
{

    public function __construct(
        \Magento\Framework\Data\Collection\EntityFactoryInterface $entityFactory,
        \Psr\Log\LoggerInterface $logger,
        \Magento\Framework\Data\Collection\Db\FetchStrategyInterface $fetchStrategy,
        \Magento\Framework\Event\ManagerInterface $eventManager,
        $mainTable = 'tp4_vendor',
        $resourceModel = \Formation\TP4bis\Model\ResourceModel\Vendor::class
    ) {
        parent::__construct(
            $entityFactory,
            $logger,
            $fetchStrategy,
            $eventManager,
            $mainTable,
            $resourceModel
        );
    }
}
