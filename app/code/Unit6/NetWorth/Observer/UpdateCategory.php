<?php

namespace Unit6\NetWorth\Observer;

use Magento\Framework\Event\ObserverInterface;
use Unit6\NetWorth\Api\CategoryNetWorthManagementInterface;

class UpdateCategory implements ObserverInterface
{
    /**
     * @var \Unit6\NetWorth\Api\CategoryNetWorthManagementInterface
     */
    protected $netWorthManagement;

    /**
     * @param \Unit6\NetWorth\Api\CategoryNetWorthManagementInterface $netWorthManagement
     */
    public function __construct (CategoryNetWorthManagementInterface $netWorthManagement) {
        $this->netWorthManagement = $netWorthManagement;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $category = $observer->getEvent()->getCategory();
        $this->netWorthManagement->updateCategory($category->getId());
    }
}
