<?php

namespace Unit3\ViewModelDemo\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;

class HelloVM implements ArgumentInterface
{
    public function hello() {
        return "Hello from View Model php class";
    }
}
