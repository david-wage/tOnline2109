<?php

declare(strict_types=1);

namespace Unit6\LoyalCustomer\Setup\Patch\Data;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

/**
 * Patch is mechanism, that allows to do atomic upgrade data changes
 */
class AddLoyalCustomerAttribute implements DataPatchInterface
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
     * @var \Magento\Eav\Api\AttributeManagementInterface
     */
    private $attributeManagement;
    /**
     * @var \Magento\Eav\Api\AttributeSetRepositoryInterface
     */
    private $attributeSetRepository;
    /**
     * @var \Magento\Eav\Api\AttributeGroupRepositoryInterface
     */
    private $attributeGroupRepository;
    /**
     * @var \Magento\Framework\Api\SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     */
    public function __construct(
        ModuleDataSetupInterface                           $moduleDataSetup,
        \Magento\Eav\Setup\EavSetupFactory                 $eavSetupFactory,
        \Magento\Eav\Model\Config                          $eavConfig,
        \Magento\Eav\Api\AttributeManagementInterface      $attributeManagement,
        \Magento\Eav\Api\AttributeSetRepositoryInterface   $attributeSetRepository,
        \Magento\Eav\Api\AttributeGroupRepositoryInterface $attributeGroupRepository,
        \Magento\Framework\Api\SearchCriteriaBuilder       $searchCriteriaBuilder
    )
    {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->eavSetupFactory = $eavSetupFactory;
        $this->eavConfig = $eavConfig;
        $this->attributeManagement = $attributeManagement;
        $this->attributeSetRepository = $attributeSetRepository;
        $this->attributeGroupRepository = $attributeGroupRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    /**
     * Do Upgrade
     *
     * @return void
     */
    public function apply()
    {
        /** @var \Magento\Eav\Setup\EavSetup $eavSetup */
        $eavSetup = $this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]);

        $eavSetup->addAttribute(
            \Magento\Customer\Model\Customer::ENTITY,
            'is_loyal',
            [
                'type' => 'int',
                'input' => 'select',
                'source' => 'Magento\Eav\Model\Entity\Attribute\Source\Boolean',
                'label' => 'Is Loyal',
                'required' => false,
                'user_defined' => true,
                'unique' => false,
                'default' => false
            ]
        );

        $entityTypeId = $this->eavConfig->getEntityType(\Magento\Customer\Model\Customer::ENTITY)->getEntityTypeId();
        $attributeSetId = $this->getAttributeSetId($entityTypeId);
        $attributeGroupId = $this->getAttributeGroupId($attributeSetId);
        $this->attributeManagement->assign(\Magento\Customer\Model\Customer::ENTITY, $attributeSetId, $attributeGroupId, 'is_loyal', 100);
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

    protected function getAttributeSetId($entityTypeId)
    {
        $searchCriteria = $this->searchCriteriaBuilder
            ->addFilter('entity_type_id', $entityTypeId)
            ->addFilter('attribute_set_name', 'Default')
            ->create();
        $items = $this->attributeSetRepository->getList($searchCriteria)
            ->getItems();
        foreach ($items as $item) {
            return $item->getAttributeSetId();
        }
    }

    protected function getAttributeGroupId($attributeSetId)
    {
        $searchCriteria = $this->searchCriteriaBuilder->addFilter('attribute_set_id', $attributeSetId)
            ->addFilter('default_id', 1)
            ->create();
        $items = $this->attributeGroupRepository->getList($searchCriteria)
            ->getItems();
        foreach ($items as $item) {
            return $item->getAttributeGroupId();
        }
    }
}
