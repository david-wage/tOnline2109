<?php
namespace Unit3\LayoutTemplate\Controller\Index;
use Magento\Framework\Controller\ResultFactory;
class Index extends \Magento\Framework\App\Action\Action
{
    // urlpath: layouttemplate
    public function execute()
    {
        echo __METHOD__;
        return $this->resultFactory->create(ResultFactory::TYPE_PAGE);
    }
}
