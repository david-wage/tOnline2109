<?php

namespace Unit6\NetWorth\Observer;

use Magento\Framework\Event\ObserverInterface;
use Unit6\NetWorth\Api\CategoryNetWorthManagementInterface;

class UpdateProductCategories implements ObserverInterface
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
        $this->netWorthManagement->updateAll();
    }
}
