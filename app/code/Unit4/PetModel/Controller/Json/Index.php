<?php
namespace Unit4\PetModel\Controller\Json;
use Magento\Framework\Controller\ResultFactory;
class Index extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Unit4\PetModel\Model\ResourceModel\Pet\CollectionFactory
     */
    private $collectionFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Unit4\PetModel\Model\ResourceModel\Pet\CollectionFactory $collectionFactory
    )
    {
        parent::__construct($context);
        $this->collectionFactory = $collectionFactory;
    }

    // petmodel/json/index
    public function execute()
    {
        $petType = $this->getRequest()->getParam('pet_type');
        var_dump($petType);
        // TODO: implement getPetCollectionByType
        $petCollection = $this->getPetCollectionByType($petType);
        $resultJson = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        return $resultJson->setData($petCollection);
    }

    private function getPetCollectionByType($petType)
    {
        /** @var \Unit4\PetModel\Model\ResourceModel\Pet\Collection $petCollection */
        $petCollection = $this->collectionFactory->create();
        return $petCollection->getData();
    }
}
