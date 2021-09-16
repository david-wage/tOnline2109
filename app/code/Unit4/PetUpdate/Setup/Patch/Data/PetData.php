<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Unit4\PetUpdate\Setup\Patch\Data;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

/**
* Patch is mechanism, that allows to do atomic upgrade data changes
*/
class PetData implements DataPatchInterface
{
    /**
     * @var ModuleDataSetupInterface $moduleDataSetup
     */
    private $moduleDataSetup;

    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     */
    public function __construct(ModuleDataSetupInterface $moduleDataSetup)
    {
        $this->moduleDataSetup = $moduleDataSetup;
    }

    /**
     * Do Upgrade
     *
     * @return void
     */
    public function apply()
    {
        $setup = $this->moduleDataSetup->getConnection();
        $binds = [
            ['customer_id' => 1, 'pet_name'=> 'Didi', 'pet_type' => 'Cat'],
            ['customer_id' => 1, 'pet_name'=> 'Lala', 'pet_type' => 'Dog'],
            ['customer_id' => 1, 'pet_name'=> 'Nene'],
            ['pet_name'=> 'Dodo'],
        ];
        $petTbl = $setup->getTableName('pet');
        foreach ($binds as $bind){
            $setup->insertForce($petTbl,$bind);
        }
    }

    /**
     * @inheritdoc
     */
    public function getAliases()
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    public static function getDependencies()
    {
        return [];
    }
}
