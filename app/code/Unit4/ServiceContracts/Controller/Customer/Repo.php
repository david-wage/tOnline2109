<?php
namespace Unit4\ServiceContracts\Controller\Customer;

class Repo extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Customer\Api\CustomerRepositoryInterface
     */
    private $customerRepository;

    public function __construct(
        \Magento\Framework\App\Action\Context$context,
        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepository
    )
    {
        parent::__construct($context);
        $this->customerRepository = $customerRepository;
    }

    public function execute()
    {
        // TODO: load and modify customer
    }
}
