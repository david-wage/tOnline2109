<?php

namespace Unit2\Results\Controller\Demo;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\HttpGetActionInterface;

class Raw extends Action implements HttpGetActionInterface
{
    // {m2domain}/{frontName}/{actionPath}/{actionClass}
    // /results/demo/raw
    public function execute()
    {
        // echo __METHOD__;
       $resultRaw = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_RAW);
       return $resultRaw->setContents("Hello from raw result object");
    }
}
