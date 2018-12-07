<?php
namespace Formation\TP10\Controller\Adminhtml;

use Magento\Backend\App\Action;

abstract class Vendor extends \Magento\Backend\App\Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Formation_TP10::vendor';

    /**
     * @param Action\Context $context
     * @param Product\Builder $productBuilder
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context
    ) {
        parent::__construct($context);
    }
}
