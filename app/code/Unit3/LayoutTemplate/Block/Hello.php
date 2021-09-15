<?php

namespace Unit3\LayoutTemplate\Block;

use Magento\Framework\View\Element\Template;

class Hello extends Template
{
    protected $_template = "Unit3_LayoutTemplate::block/hello.phtml";

    public function sayHello() {
        return "Hello using layout";
    }
}
