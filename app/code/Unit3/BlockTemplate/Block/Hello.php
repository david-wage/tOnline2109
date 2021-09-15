<?php
namespace Unit3\BlockTemplate\Block;
class Hello extends \Magento\Framework\View\Element\Template
{
    protected $_template = "Unit3_BlockTemplate::hello.phtml";
    public function sayHello() {
        return "Hello!";
    }
}
