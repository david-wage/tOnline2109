<?php

namespace Unit6\ClothingMaterials\Model\Product\Attribute\Source;

class ClothingMaterials extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{
    /**
     * @var \Unit6\ClothingMaterials\Model\ResourceModel\Material\CollectionFactory
     */
    private $collectionFactory;

    protected $options = [];

    public function __construct(
        \Unit6\ClothingMaterials\Model\ResourceModel\Material\CollectionFactory $collectionFactory
    )
    {
        $this->collectionFactory = $collectionFactory;
    }

    public function getAllOptions()
    {
        if (!$this->options) {
            $collection = $this->collectionFactory->create();
            foreach ($collection as $item) {
                $this->options[] = [
                    'value' => $item->getMaterialId(),
                    'label' => $item->getMaterial()
                ];
            }
        }
        return $this->options;
    }

    public function getOptionText($value)
    {
        foreach ($this->getAllOptions() as $option) {
            if ($option['value'] == $value) {
                return $option['label'];
            }
        }
        return null;
    }
}
