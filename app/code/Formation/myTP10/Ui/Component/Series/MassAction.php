<?php

namespace Formation\TP10\Ui\Component\Series;

use Magento\Framework\AuthorizationInterface;
use Magento\Framework\View\Element\UiComponentInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Ui\Component\AbstractComponent;

/**
 * Provide validation of allowed massaction for user.
 */
class MassAction extends AbstractComponent
{
    const NAME = 'massaction';

    /**
     * @var AuthorizationInterface
     */
    private $authorization;

    /**
     * @param AuthorizationInterface $authorization
     * @param ContextInterface $context
     * @param UiComponentInterface[] $components
     * @param array $data
     */
    public function __construct(
        AuthorizationInterface $authorization,
        ContextInterface $context,
        array $components = [],
        array $data = []
    ) {
        $this->authorization = $authorization;
        parent::__construct($context, $components, $data);
    }

    /**
     * @inheritdoc
     */
    public function prepare()
    {
        $config = $this->getConfiguration();

        foreach ($this->getChildComponents() as $actionComponent) {
            $actionType = $actionComponent->getConfiguration()['type'];
            if ($this->isActionAllowed($actionType)) {
                $config['actions'][] = $actionComponent->getConfiguration();
            }
        }
        $origConfig = $this->getConfiguration();
        if ($origConfig !== $config) {
            $config = array_replace_recursive($config, $origConfig);
        }

        $this->setData('config', $config);
        $this->components = [];

        parent::prepare();
    }

    /**
     * @inheritdoc
     */
    public function getComponentName()
    {
        return static::NAME;
    }

    /**
     * Check if the given type of action is allowed.
     *
     * @param string $actionType
     * @return bool
     */
    public function isActionAllowed($actionType)
    {
        $isAllowed = true;

        return $isAllowed;
    }
}
