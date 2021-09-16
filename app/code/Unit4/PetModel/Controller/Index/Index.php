<?php
namespace Unit4\PetModel\Controller\Index;

class Index  extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Unit4\PetModel\Model\PetFactory
     */
    private $petFactory;
    /**
     * @var \Unit4\PetModel\Model\ResourceModel\Pet
     */
    private $petResource;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Unit4\PetModel\Model\PetFactory $petFactory,
        \Unit4\PetModel\Model\ResourceModel\Pet $petResource
    )
    {
        parent::__construct($context);
        $this->petFactory = $petFactory;
        $this->petResource = $petResource;
    }

    // petmodel/
    public function execute()
    {
        // TODO: load pet, update name and save
        /** @var \Unit4\PetModel\Model\Pet $petModel */
        $petModel = $this->petFactory->create();
        $this->petResource->load($petModel, 1);
        // laod model information based in custom column/field
        // $this->petResource->load($petModel, 'Lala', 'pet_name');

        // Print values
        echo "<pre>";
        var_export($petModel->getData());
        echo "</pre>";

        // Update Value for Name and Type
        $petModel->setData('pet_name', 'Didi2');
        // pet_type
        $petModel->setPetType('Dog');
        // Save changes
        $this->petResource->save($petModel);

        // Print values
        echo "<pre>";
        var_export($petModel->getData());
        echo "</pre>";
    }
}
