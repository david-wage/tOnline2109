<?php
namespace Unit2\CustomCatalogController\Controller\Product;

use Magento\Framework\App\ResponseInterface;

class View extends \Magento\Framework\App\Action\Action
{
    public function execute()
    {
        echo "From Custom Action Class"; die;
    }
}
