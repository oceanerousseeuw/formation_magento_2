<?php

namespace Formation\TP10\Block\Adminhtml;

/**
 * @api
 * @since 100.0.2
 */
class Series extends \Magento\Backend\Block\Widget\Container
{
    protected $_seriesFactory;

    /**
     * @param \Magento\Backend\Block\Widget\Context $context
     * @param \Magento\Catalog\Model\Product\TypeFactory $typeFactory
     * @param \Magento\Catalog\Model\ProductFactory $productFactory
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Formation\TP4\Model\SeriesFactory $seriesFactory,
        array $data = []
    ) {
        $this->_seriesFactory = $seriesFactory;

        parent::__construct($context, $data);
    }

    /**
     * Prepare button and grid
     *
     * @return \Magento\Catalog\Block\Adminhtml\Product
     */
    protected function _prepareLayout()
    {
        $addButtonProps = [
            'id' => 'add_new_series',
            'label' => __('Add Series'),
            'class' => 'add',
            'button_class' => '',
            'onclick' => "setLocation('" . $this->getUrl('formationtp10/*/new') . "')"
        ];
        $this->buttonList->add('add_new', $addButtonProps);

        return parent::_prepareLayout();
    }

}
