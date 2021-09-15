<?php
namespace Unit3\BlockTemplate\Controller\Index;
class Index extends \Magento\Framework\App\Action\Action
{
    // {m2Domain} / {frontName} / {actionPath} / {actionClass}
    //  blocktemplate or blocktemplate/index/ or blocktemplate/index/index
    public function execute()
    {
        $resultPage = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_PAGE);
        $layout = $resultPage->getLayout();
        $helloBlock = $layout->createBlock(\Unit3\BlockTemplate\Block\Hello::class);
        $helloBlock->setTemplate("Unit3_BlockTemplate::custom/hello.phtml");
        $out = $helloBlock->toHtml();
        $resultRaw = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_RAW);
        return $resultRaw->setContents($out);
    }
}
