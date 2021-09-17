<?php

declare(strict_types=1);

namespace Unit6\ClothingMaterials\Setup\Patch\Data;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

/**
 * Patch is mechanism, that allows to do atomic upgrade data changes
 */
class AddClothingMaterialsAttribute implements DataPatchInterface
{
    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;
    /**
     * @var \Magento\Eav\Setup\EavSetupFactory
     */
    private $eavSetupFactory;
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
     * @var \Magento\Framework\Api\FilterBuilder
     */
    private $filterBuilder;


    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     */
    public function __construct(
        ModuleDataSetupInterface                           $moduleDataSetup,
        \Magento\Eav\Setup\EavSetupFactory                 $eavSetupFactory,
        \Magento\Eav\Api\AttributeManagementInterface      $attributeManagement,
        \Magento\Eav\Api\AttributeSetRepositoryInterface   $attributeSetRepository,
        \Magento\Eav\Api\AttributeGroupRepositoryInterface $attributeGroupRepository,
        \Magento\Framework\Api\SearchCriteriaBuilder       $searchCriteriaBuilder,
        \Magento\Framework\Api\FilterBuilder               $filterBuilder
    )
    {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->eavSetupFactory = $eavSetupFactory;
        $this->attributeManagement = $attributeManagement;
        $this->attributeSetRepository = $attributeSetRepository;
        $this->attributeGroupRepository = $attributeGroupRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->filterBuilder = $filterBuilder;
    }

    /**
     * Do Upgrade
     *
     * @return void
     */
    public function apply()
    {
        $this->addAttribute($this->moduleDataSetup);
        $attributeSetId = $this->getAttributeSetId();
        $attributeGroupId = $this->getAttributeGroupId($attributeSetId);
        $this->attributeManagement->assign(
            \Magento\Catalog\Model\Product::ENTITY,
            $attributeSetId,
            $attributeGroupId,
            'clothing_materials', 100);
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

    protected function getAttributeSetId()
    {
        $searchCriteria = $this->searchCriteriaBuilder
            ->addFilter('entity_type_id', 4)
            ->addFilter('attribute_set_name', 'Top')
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

    protected function addAttribute($setup)
    {
        /** @var \Magento\Eav\Setup\EavSetup $eavSetup */
        $eavSetup = $this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]);

        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'clothing_materials',
            [
                'backend' => \Unit6\ClothingMaterials\Model\Product\Attribute\Backend\ClothingMaterials::class,
                'source' => \Unit6\ClothingMaterials\Model\Product\Attribute\Source\ClothingMaterials::class,
                'type' => 'int',
                'frontend' => '',
                'input' => 'select',
                'label' => 'Clothing Materials',
                'frontend_class' => '',
                'required' => false,
                'user_defined' => true,
                'unique' => false,
                'note' => '',
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
                'input_renderer' => '',
                'searchable' => true,
                'filterable' => true,
                'comparable' => false,
                'visible_on_front' => true,
                'is_html_allowed_on_front' => false,
                'visible_in_advanced_search' => true,
                'used_in_product_listing' => false,
                'used_for_sort_by' => false,
                'apply_to' => '',
                'position' => '50',
                'used_for_promo_rules' => true,
                'is_used_in_grid' => false,
                'is_visible_in_grid' => false,
                'is_filterable_in_grid' => false,
                'group' => 'General',
            ]
        );
    }
}
