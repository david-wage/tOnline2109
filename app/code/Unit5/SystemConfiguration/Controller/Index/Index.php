<?php
namespace Unit5\SystemConfiguration\Controller\Index;

class Index extends \Magento\Framework\App\Action\Action
{
    // url: systemconfiguration/index/index
    public function execute()
    {
        echo __METHOD__;
        return $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_PAGE);
    }
}
