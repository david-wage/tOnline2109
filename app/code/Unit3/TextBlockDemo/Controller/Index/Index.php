<?php
namespace Unit3\TextBlockDemo\Controller\Index;
use Magento\Framework\Controller\ResultFactory;
class Index extends \Magento\Framework\App\Action\Action
{
    /*
     * Base Router Url structure/anatomy: {domain}/{frontName}/{actionPath}/{actionClass}
     * This action class will be executed by following urls:
     * {domain}/textblock/index/index
     * {domain}/textblock/index
     * {domain}/textblock
     * because magento internally replaces the missing values with "index"
     */
    public function execute()
    {
        $resultRaw = $this->resultFactory->create(ResultFactory::TYPE_RAW);
        $layout = $this->_view->getLayout();
        // createBlock will act as object manager, it means that it will create an instance of that class
        $textBlock = $layout->createBlock(\Magento\Framework\View\Element\Text::class);
        // We need to inject the block in our actionClass's constructor, so the object manager will create an instances
        // if not it will automatically create an instance fro the namespace
        // Additonally it will add the block to the layout structure
        //$textBlock = $layout->addBlock(\Magento\Framework\View\Element\Text::class);

        $textBlock->setText('TextBlock: Hello World...!');
        $text = $textBlock->toHtml();
        return $resultRaw->setContents($text);
    }
}
