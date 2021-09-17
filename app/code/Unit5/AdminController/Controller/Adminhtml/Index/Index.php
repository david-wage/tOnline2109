<?php

namespace Unit5\AdminController\Controller\Adminhtml\Index;

use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;

class Index extends \Magento\Backend\App\Action
{

    // Specify the ACL rule for this action Class
    const ADMIN_RESOURCE = '';


    public function execute()
    {
        return $this->resultFactory->create(ResultFactory::TYPE_PAGE);
    }
}
