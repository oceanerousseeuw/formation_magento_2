<?php

namespace Correction\TP7\Plugin;

class LogReinit
{
    protected $logger;

    public function __construct(
        \Psr\Log\LoggerInterface $logger
    )
    {
        $this->logger = $logger;
    }

    public function beforeRegenerateId(
        \Magento\Customer\Model\Session $subject
    )
    {
        $this->logger->critical('Session restarted!!!');
        return [];
    }
}