<?php

namespace Unit2\Results\Controller\Demo;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\ResultFactory;

class Redirect extends Action implements HttpGetActionInterface
{
    // {m2domain}/{frontName}/{actionPath}/{actionClass}
    // /results/demo/redirect
    public function execute()
    {
        // echo __METHOD__;
        // https://adobe-commerce-2-4-2-mdoq-io-12786.24.mdoq.io/resultstwo/demo/redirect
       $resultRedirect = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_REDIRECT);
       // return $resultRedirect->setPath("results/demo/raw");
        // https://adobe-commerce-2-4-2-mdoq-io-12786.24.mdoq.io/results/demo/raw/
       // https://adobe-commerce-2-4-2-mdoq-io-12786.24.mdoq.io/results/demo2/raw/
       return $resultRedirect->setPath("*/*/raw");
    }
}
