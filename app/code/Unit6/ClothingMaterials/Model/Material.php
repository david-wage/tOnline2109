<?php

namespace Unit6\ClothingMaterials\Model;

use Magento\Framework\Model\AbstractModel;
use Unit6\ClothingMaterials\Model\ResourceModel\Material as ResourceModel;

class Material extends AbstractModel
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'clothing_material_model';

    /**
     * @inheritdoc
     */
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }
}
