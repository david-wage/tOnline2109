<?php

namespace Unit5\SystemConfiguration\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;

class ConfigVM implements ArgumentInterface
{
    const XML_YESNO_CONFIG_PATH ='unit5section/unit5group/yesno';
    const XML_PDFFILE_CONFIG_PATH ='unit5section/unit5group/pdf_file';
    const XML_PASSWORD_CONFIG_PATH ='unit5section/unit5group/password';

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
        return $this->scopeConfig->getValue(self::XML_YESNO_CONFIG_PATH);
    }

    public function getPdfFilePath() {
        return $this->scopeConfig->getValue(self::XML_PDFFILE_CONFIG_PATH);
    }

    public function getDecryptedPassword() {
        $encryptedPassword = $this->scopeConfig->getValue(self::XML_PASSWORD_CONFIG_PATH);
        return $this->encryptor->decrypt($encryptedPassword);
    }
}
