<?php

namespace Unit6\ConfigurableLineItem\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;

class ViewModel implements ArgumentInterface
{
    public function getOtherOptions($product)
    {
        return $product->getTypeInstance()->getUsedProducts($product);
    }
}
