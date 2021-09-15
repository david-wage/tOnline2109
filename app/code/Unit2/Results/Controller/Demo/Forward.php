<?php

namespace Unit2\Results\Controller\Demo;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\ResultFactory;

class Forward extends Action implements HttpGetActionInterface
{
    // {m2domain}/{frontName}/{actionPath}/{actionClass}
    // /results/demo/forward
    public function execute()
    {
        // echo __METHOD__;
       $resultForward = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_FORWARD);

       // When action class is in the same controller folder only set new classname
       return $resultForward->forward("json");

       /* Example to forward to different FrontName, ControllerName, ActionClassName
        // https://adobe-commerce-2-4-2-mdoq-io-12786.24.mdoq.io/contact/
        $resultForward->setModule('contact')
            ->setController('index')
            ->forward('index');

        return $resultForward;
       */
    }
}
