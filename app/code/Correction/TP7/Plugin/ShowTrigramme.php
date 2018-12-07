<?php

namespace Correction\TP7\Plugin;

class ShowTrigramme
{
    public function afterGetCustomerData(
        \Correction\TP6\Block\Customer\Info $subject,
        $result
    )
    {
        return array_merge($result, ['Trigramme' => $subject->getCustomer()->getTrigramme()]);
    }
}