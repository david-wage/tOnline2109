<?php
namespace Unit2\Results\Controller\Index;

class CustomIndex extends \Magento\Framework\App\Action\Action
{
    public function execute()
    {
        echo "Hello from custom action class for contact view, using preference in di.xml file";
    }
}
