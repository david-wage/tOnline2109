<?php
namespace Unit4\Unit4\PetModel\Controller\Json;

use Magento\Framework\Controller\ResultFactory;

class Index extends \Magento\Framework\App\Action\Action
{
    public function execute()
    {
        // TODO: implement getPetCollectionByType
        $petCollection = $this->getPetCollectionByType($petType);
        $resultRaw = $this->resultFactory->create(ResultFactory::TYPE_JSON);
    }
}
