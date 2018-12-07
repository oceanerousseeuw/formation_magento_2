<?php

namespace Correction\TP7\Helper;

use Magento\Framework\App\Helper\AbstractHelper;

class Trigramme extends AbstractHelper
{
    public function getTrigramme($firstName,  $lastName)
    {
        return strtoupper(
            (strlen($firstName) > 0 ? substr($firstName, 0, 1) : '').
            (strlen($lastName) > 1 ? substr($lastName, 0, 2) : ''));
    }
}