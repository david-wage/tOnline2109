<?php
namespace Unit4\ServiceContracts\Controller\Product;

class Repo extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Catalog\Api\ProductRepositoryInterface
     */
    private $productRepository;
    /**
     * @var \Magento\Framework\Api\SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;
    /**
     * @var \Magento\Framework\Api\FilterBuilder
     */
    private $filterBuilder;
    /**
     * @var \Magento\Framework\Api\SortOrderBuilder
     */
    private $sortOrderBuilder;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder,
        \Magento\Framework\Api\FilterBuilder $filterBuilder,
        \Magento\Framework\Api\SortOrderBuilder $sortOrderBuilder
    )
    {
        parent::__construct($context);
        $this->productRepository = $productRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->filterBuilder = $filterBuilder;
        $this->sortOrderBuilder = $sortOrderBuilder;
    }

    public function execute()
    {
        $filter = $this->filterBuilder
            // Todo: apply filter rules
            ->create();

        $sortOrder = $this->sortOrderBuilder
            // TODO: add sortOrder rules
            ->create();

        $searchCriteria = $this->searchCriteriaBuilder
            ->addFilters([$filter])
            ->addSortOrder($sortOrder)
            // TODO: test other options like setPageSize, setCurPage
            //->setPageSize(10)
            //->setCurrentPage(2)
            ->create();

        $productList = $this->productRepository->getList($searchCriteria)
            ->getItems();

        // Print id and name on front
        foreach ($productList as $product) {
            var_dump($product->getId() . ": ". $product->getName());
        }
    }
}
