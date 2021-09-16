<?php

namespace Unit4\PetModel\Model;

use Magento\Framework\Model\AbstractModel;
use Unit4\PetModel\Model\ResourceModel\Pet as ResourceModel;

class Pet extends AbstractModel
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'pet_model';

    /**
     * @inheritdoc
     */
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }
}
