<?php

namespace Unit1\FireEvent\Logger;

use Monolog\Logger;

class Custom extends \Magento\Framework\Logger\Handler\Base
{
    protected $fileName = '/var/log/custom.log';
}
