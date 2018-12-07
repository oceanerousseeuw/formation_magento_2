<?php

namespace Formation\TP6\Block;

use Magento\Framework\View\Element\Template as Template;
use Magento\Customer\Model\Session as CustomerSession;
use Magento\Framework\View\Element\Template\Context as Context;
use Magento\Customer\Model\CustomerFactory as CustomerFactory;

class CustomerAddress extends Template{

    private $customerSession;
    private $customerFactory;

    public function __construct(
        CustomerSession $customerSession, Context $context, CustomerFactory $customerFactory, array $data = []
    ) {
        $this->customerSession = $customerSession;
        $this->customerFactory = $customerFactory;
        parent::__construct($context, $data);
    }

    protected function getCustomer()
    {
        if($this->customerSession->isLoggedIn())
        {
            return $this->customerSession->getCustomer();
        }
        else
        {
            return $this->customerFactory->create();
        }
    }

    public function getCustomerAddress(){
        if(!$this->customerSession->isLoggedIn())
        {
            return [];
        }
        $addressesData = [];
        $customer = $this->getCustomer();
        foreach($customer->getAddressesCollection() as $address)
        {
            /** @var $address \Magento\Customer\Model\Address */
            $addressesData[] = [
                'Street' => $address->getStreetFull(),
                'City' => $address->getCity(),
                'Postcode' => $address->getPostcode(),
                'Country' => $address->getCountryModel()->getName(),
            ];
        }
        return $addressesData;
    }
}
