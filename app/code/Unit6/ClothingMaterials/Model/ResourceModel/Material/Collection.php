<?php

namespace Unit6\ClothingMaterials\Model\ResourceModel\Material;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Unit6\ClothingMaterials\Model\Material as Model;
use Unit6\ClothingMaterials\Model\ResourceModel\Material as ResourceModel;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'clothing_material_collection';

    /**
     * @inheritdoc
     */
    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}
