<?php

namespace Unit3\ViewModelDemo\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;

class ByeVM implements ArgumentInterface
{

    public function bye() {
        return "Bye from VM";
    }
}
