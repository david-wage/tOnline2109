<?php

namespace Unit6\LoyalCustomer\Observer;

use Magento\Framework\Event\ObserverInterface;

use Magento\Customer\Model\CustomerFactory;
use Magento\Sales\Api\OrderRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;

class UpdateLoyalCustomerFlag implements ObserverInterface
{

    public function __construct(
        CustomerFactory          $customerFactory,
        OrderRepositoryInterface $orderRepository,
        SearchCriteriaBuilder    $searchCriteriaBuilder
    )
    {
        $this->customerFactory = $customerFactory;
        $this->orderRepository = $orderRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $order = $observer->getEvent()->getOrder();
        if ($customerId = $order->getCustomerId()) {
            $searchCriteria = $this->searchCriteriaBuilder->addFilter('customer_id', $customerId)
                ->create();
            $orders = $this->orderRepository->getList($searchCriteria);
            $count = count($orders->getItems());
            if ($count > 1) {
                $customer = $this->customerFactory->create()->load($customerId);
                $customer->setAttributeSetId(1)
                    ->setIsLoyal(1)
                    ->save();
            }
        }
    }
}
