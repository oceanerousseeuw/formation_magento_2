<?php

namespace Formation\TP5\Model\Entity\Attribute\Source;

use Formation\TP4\Model\ResourceModel\Series\CollectionFactory;

class Series extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{
    protected $collectionFactory;
    protected $options;

    public function __construct(
        CollectionFactory $collectionFactory
    )
    {
        $this->collectionFactory = $collectionFactory;
        $this->options = null;
    }

    /**
     * Retrieve All options
     *
     * @return array
     */
    public function getAllOptions()
    {
        if(is_null($this->options))
        {
            $this->options = [['value' => '', 'label' => ' ']];
            $collection = $this->collectionFactory->create();
            foreach($collection as $series)
            {
                $this->options[] = ['value' => $series->getId(), 'label' => $series->getName()];
            }
        }
        return $this->options;
    }
}