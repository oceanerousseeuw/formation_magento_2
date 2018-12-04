<?php

namespace Correction\TP3\Controller\Product;

use Magento\Framework\App\Action\Context;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory as ProductCollectionFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\Raw;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Data\Collection;

class Listing2 extends Action
{
    protected $collectionFactory;
    protected $resultFactory;

    public function __construct(
        Context $context,
        ProductCollectionFactory $collectionFactory,
        ResultFactory $resultFactory
    )
    {
        parent::__construct($context);
        $this->collectionFactory = $collectionFactory;
        $this->resultFactory = $resultFactory;
    }

    /**
     * Execute action based on request and return result
     *
     * Note: Request will be added as operation argument in future
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function execute()
    {
        $type = $this->getRequest()->getParam('type');
        $sort = $this->getRequest()->getParam('sort');
        $order = $this->getRequest()->getParam('order', 'asc');
        $collection = $this->collectionFactory->create();
        $collection->addFieldToFilter('type_id', $type);
        $collection->addAttributeToSelect('name');
        if($sort)
        {
            $collection->addOrder($sort, strtolower($order) == 'desc' ? Collection::SORT_ORDER_DESC : Collection::SORT_ORDER_ASC);
        }

        /** @var Raw $rawResponse */
        $rawResponse = $this->resultFactory->create(ResultFactory::TYPE_RAW);
        $itemXmls = [];
        foreach($collection as $item)
        {
            // Notice: Array to string conversion in /var/www/magento/vendor/magento/framework/DataObject.php on line 288
            $itemXmls[] = $item->toXml(['name', 'sku']);
        }
        $rawResponse->setContents('<items>'."\n".implode("\n", $itemXmls).'</items>');
        return $rawResponse;
    }
}