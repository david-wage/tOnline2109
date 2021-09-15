<?php

namespace Unit1\Footer\Block\Html;

class Footer extends \Magento\Theme\Block\Html\Footer
{
    public function getCopyright()
    {
        return "Hello World " . parent::getCopyright();
    }

}
