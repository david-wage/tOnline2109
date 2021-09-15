<?php

namespace Unit1\Plugin\Plugin;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\ResponseInterface;

class ControllerDispatch
{
    /**
     * @var \Psr\Log\LoggerInterface
     */
    private $logger;

    public function __construct(
        \Psr\Log\LoggerInterface $logger
    )
    {
        $this->logger = $logger;
    }

    public function afterDispatch(Action $subject, $result, $request)
    {
        $fullAction =  $request->getFullActionName();
        /** @var \Magento\Framework\App\Request\Http $request */
        echo "<pre>". $fullAction . "</pre>";
        $this->logger->critical( $fullAction);
        return $result;
    }
}
