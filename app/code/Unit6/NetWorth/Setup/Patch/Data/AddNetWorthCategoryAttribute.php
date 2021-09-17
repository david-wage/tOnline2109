<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Unit6\NetWorth\Setup\Patch\Data;

use Magento\Catalog\Model\Category;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Eav\Setup\EavSetup;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Unit6\NetWorth\Api\CategoryNetWorthManagementInterface;

/**
* Patch is mechanism, that allows to do atomic upgrade data changes
*/
class AddNetWorthCategoryAttribute implements DataPatchInterface
{
    /**
     * @var ModuleDataSetupInterface $moduleDataSetup
     */
    private $moduleDataSetup;
    /**
     * @var \Magento\Eav\Setup\EavSetupFactory
     */
    private $eavSetupFactory;
    /**
     * @var \Magento\Eav\Model\Config
     */
    private $eavConfig;
    /**
     * @var \TrainingEssentialsUnit6\NetWorth\Api\CategoryNetWorthManagementInterface
     */
    private $netWorthManagement;

    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        \Magento\Eav\Setup\EavSetupFactory $eavSetupFactory,
        \Magento\Eav\Model\Config $eavConfig,
        \Unit6\NetWorth\Api\CategoryNetWorthManagementInterface $netWorthManagement
    )
    {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->eavSetupFactory = $eavSetupFactory;
        $this->eavConfig = $eavConfig;
        $this->netWorthManagement = $netWorthManagement;
    }

    /**
     * Do Upgrade
     *
     * @return void
     */
    public function apply()
    {
        /** @var EavSetup $eavSetup */
        $eavSetup = $this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]);

        $eavSetup->addAttribute(
            Category::ENTITY,
            CategoryNetWorthManagementInterface::NET_WORTH_ATTRIBUTE,
            [
                'type' => 'decimal',
                'input' => 'text',
                'label' => 'Net Worth',
                'required' => false,
                'user_defined' => true,
                'unique' => false,
                'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
                'group' => 'General Information',
            ]
        );

        $this->eavConfig->clear();
        $this->netWorthManagement->updateAll();
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
