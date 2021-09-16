<?php

namespace Unit4\PetModel\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Pet extends AbstractDb
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'pet_resource_model';

    /**
     * @inheritdoc
     */
    protected function _construct()
    {
        $this->_init('pet', 'pet_id');
        $this->_useIsObjectNew = true;
    }
}
