<?php

namespace Unit6\NetWorth\Model;

use Unit6\NetWorth\Api\CategoryNetWorthManagementInterface;
use Magento\Framework\App\ResourceConnection;
use Magento\Eav\Model\Config as EavConfig;
use Magento\Catalog\Model\Category;
use Magento\Catalog\Api\CategoryLinkManagementInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;

class CategoryNetWorthManagement implements CategoryNetWorthManagementInterface
{

    /**
     * @var \Magento\Framework\DB\Adapter\AdapterInterface
     */
    protected $connection;


    public function __construct(
        ResourceConnection $resource,
        EavConfig $eavConfig,
        CategoryLinkManagementInterface $categoryLinkManagement,
        ProductRepositoryInterface $productRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder
    ) {
        $this->connection = $resource->getConnection();
        $this->eavConfig  = $eavConfig;

        $this->categoryLinkManagement = $categoryLinkManagement;
        $this->productRepository      = $productRepository;
        $this->searchCriteriaBuilder  = $searchCriteriaBuilder;
    }

    public function updateAll()
    {
        $attribute   = $this->eavConfig->getAttribute(Category::ENTITY, self::NET_WORTH_ATTRIBUTE);
        $attributeId = $attribute->getAttributeId();

        /**
         * This is a rare example when it could be better to use direct SQL queries
         * Please note this method only works well on a small catalogs (like sample data)
         */
        $this->connection->query("DELETE FROM catalog_category_entity_decimal WHERE attribute_id=?", [$attributeId]);
        $this->connection->query("INSERT INTO catalog_category_entity_decimal (row_id, store_id, attribute_id, value)
          SELECT
             category_id, 0, $attributeId, SUM(final_price)
          FROM
             catalog_category_product cp
          INNER JOIN
             catalog_product_index_price p ON p.entity_id=cp.product_id  AND p.customer_group_id=0
          GROUP BY
             category_id"
        );
    }

    public function updateCategory($categoryId)
    {
        $links = $this->categoryLinkManagement->getAssignedProducts($categoryId);
        $skus = [];
        foreach ($links as $link) {
            $skus[] = $link->getSku();
        }
        $searchCriteria = $this->searchCriteriaBuilder
            ->addFilter('sku', $skus, 'in')
            ->create();

        $products = $this->productRepository->getList($searchCriteria)
            ->getItems();

        $netWorth = 0;
        foreach ($products as $product) {
            $netWorth += $product->getFinalPrice();
        }

        $attribute   = $this->eavConfig->getAttribute(Category::ENTITY, self::NET_WORTH_ATTRIBUTE);
        $attributeId = $attribute->getAttributeId();
        $this->connection->query("UPDATE catalog_category_entity_decimal SET value=? WHERE attribute_id=? AND row_id=?", [$netWorth, $attributeId, $categoryId]);
    }
}
