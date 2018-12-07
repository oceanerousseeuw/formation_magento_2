<?php

namespace Formation\TP6\Block;

use Magento\Framework\View\Element\Template as Template;

class FreeMessage extends Template{

    public function getFreeMessage(){
        echo 'free message';
    }
}