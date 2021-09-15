<?php

namespace Unit2\Results\Controller\Demo;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\ResultFactory;

class Json extends Action implements HttpGetActionInterface
{
    // {m2domain}/{frontName}/{actionPath}/{actionClass}
    // /results/demo/json
    public function execute()
    {
        // echo __METHOD__;
       $resultJson = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_JSON);
       return $resultJson->setData(['hello!', 'json response']);
    }
}
