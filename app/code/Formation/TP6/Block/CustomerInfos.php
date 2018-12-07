<?php

namespace Formation\TP6\Block;

use Magento\Framework\View\Element\Template as Template;
use Magento\Customer\Model\Session as CustomerSession;
use Magento\Framework\View\Element\Template\Context as Context;
use Magento\Customer\Model\CustomerFactory as CustomerFactory;

class CustomerInfos extends Template{

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

    public function getCustomerInfos(){
        $customer = $this->getCustomer();
        $data = [
            'Last Name' => $customer->getLastname(),
            'First Name' => $customer->getFirstname(),
            'Email' => $customer->getEmail(),
        ];
        return $data;
    }
}
