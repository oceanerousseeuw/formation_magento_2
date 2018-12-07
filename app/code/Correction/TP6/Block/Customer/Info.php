<?php

namespace Correction\TP6\Block\Customer;

use Magento\Framework\View\Element\Template;

class Info extends Template
{
    protected $customerSession;
    protected $customerFactory;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Customer\Model\CustomerFactory $customerFactory,
        array $data = []
    )
    {
        $this->customerSession = $customerSession;
        $this->customerFactory = $customerFactory;
        parent::__construct($context, $data);
    }

    /**
     * @return \Magento\Customer\Model\Customer
     */
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

    /**
     * @return array
     */
    public function getCustomerData()
    {
        $customer = $this->getCustomer();
        $data = [
            'Last Name' => $customer->getLastname(),
            'First Name' => $customer->getFirstname(),
            'Email' => $customer->getEmail(),
        ];
        return $data;
    }

    /**
     * @return array
     */
    public function getCustomerAddressesData()
    {
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