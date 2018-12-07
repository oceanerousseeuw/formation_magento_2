<?php

namespace Correction\TP7\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class AddTrigramme implements ObserverInterface
{
    protected $trigrammeHelper;

    public function __construct(
        \Correction\TP7\Helper\Trigramme $trigrammeHelper
    )
    {
        $this->trigrammeHelper = $trigrammeHelper;
    }

    /**
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
        /** @var \Magento\Customer\Model\Customer $customer */
        $customer = $observer->getEvent()->getCustomer();

        $customer->setData('trigramme', $this->trigrammeHelper->getTrigramme(
            $customer->getFirstname(), $customer->getLastname()
        ));
    }
}