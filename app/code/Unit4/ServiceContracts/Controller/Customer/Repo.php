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

    // servicecontracts/customer/repo
    public function execute()
    {
        echo __METHOD__;
        $randString = str_shuffle('qwertyuiop');
        // TODO: load and modify customer
        $customerDataModel = $this->customerRepository->getById(1);
        $customerDataModel->setFirstname("Vero{$randString}");
        $this->customerRepository->save($customerDataModel);
    }
}
