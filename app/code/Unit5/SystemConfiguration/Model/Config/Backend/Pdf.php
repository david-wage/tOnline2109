<?php

namespace Unit5\SystemConfiguration\Model\Config\Backend;

class Pdf extends \Magento\Config\Model\Config\Backend\File
{
    protected function _getAllowedExtensions()
    {
        return ['pdf'];
    }

}
