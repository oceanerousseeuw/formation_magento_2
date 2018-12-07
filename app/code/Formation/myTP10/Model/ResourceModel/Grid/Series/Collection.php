<?php

namespace Formation\TP10\Model\ResourceModel\Grid\Series;


class Collection extends \Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult
{

    public function __construct(
        \Magento\Framework\Data\Collection\EntityFactoryInterface $entityFactory,
        \Psr\Log\LoggerInterface $logger,
        \Magento\Framework\Data\Collection\Db\FetchStrategyInterface $fetchStrategy,
        \Magento\Framework\Event\ManagerInterface $eventManager,
        $mainTable = 'tp4_series',
        $resourceModel = \Formation\TP4bis\Model\ResourceModel\Series::class
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
