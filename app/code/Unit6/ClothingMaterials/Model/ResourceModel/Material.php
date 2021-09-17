<?php

namespace Unit6\ClothingMaterials\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Material extends AbstractDb
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'clothing_material_resource_model';

    /**
     * @inheritdoc
     */
    protected function _construct()
    {
        $this->_init('clothing_material', 'material_id');
        $this->_useIsObjectNew = true;
    }
}
