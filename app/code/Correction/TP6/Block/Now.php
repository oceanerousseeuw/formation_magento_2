<?php

namespace Correction\TP6\Block;

class Now extends \Magento\Framework\View\Element\AbstractBlock
{
    /**
     * Override this method in descendants to produce html
     *
     * @return string
     */
    protected function _toHtml()
    {
        return '<div>'.date('r').'</div>';
    }
}