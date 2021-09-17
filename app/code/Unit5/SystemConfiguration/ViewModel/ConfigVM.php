<?php

namespace Unit5\SystemConfiguration\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;

class ConfigVM implements ArgumentInterface
{
    const XML_YESNO_CONFIG_PATH ='';
    const XML_PDFFILE_CONFIG_PATH ='';
    const XML_PASSWORD_CONFIG_PATH ='';
    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    private $scopeConfig;
    /**
     * @var \Magento\Framework\Encryption\EncryptorInterface
     */
    private $encryptor;

    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Framework\Encryption\EncryptorInterface $encryptor
    )
    {
        $this->scopeConfig = $scopeConfig;
        $this->encryptor = $encryptor;
    }

    public function getYesNoConfig() {
        return $this->scopeConfig->getValue('');
    }

    public function getPdfFilePath() {
        return $this->scopeConfig->getValue('');
    }

    public function getDecryptedPassword() {
        $encryptedPassword = $this->scopeConfig->getValue('');
        return $this->encryptor->decrypt($encryptedPassword);
    }
}
