<?php

namespace Cryptopay\Config;

use Cryptopay\AbstractResponse;
use Cryptopay\Exceptions\ConfigException;
use Cryptopay\Exceptions\DirectoryException;
use Dotenv\Dotenv;
use Cryptopay\Utils\DirectoryUtils;
use Exception;

class ConfigEnv extends AbstractConfig
{
    private string $configFileName = 'cryptopay.env';
    private string $vendorDirectory = 'vendor';
    /**
     * @return Config
     * @throws ConfigException
     */
    public function init()
    {
        $configPath = self::getConfigPath();

        try {
            Dotenv::createUnsafeImmutable($configPath, $this->getConfigFileName())->load();
        } catch (Exception $e) {
            throw new ConfigException(
                sprintf('Configuration file %s not found', $this->getConfigFileName())
            );
        }

        $config = (new ConfigEnv())
            ->withApiSecret(getenv('CRYPTOPAY_API_SECRET'))
            ->withApiKey(getenv('CRYPTOPAY_API_KEY'))
            ->withBaseUrl(getenv('CRYPTOPAY_BASE_URL'))
            ->withTimeout(getenv('CRYPTOPAY_TIMEOUT'))
            ->withCallbackSecret(getenv('CRYPTOPAY_CALLBACK_SECRET'));

        $config->validateConfig();

        return $config;
    }

    /**
     * @return string
     * @throws ConfigException
     */
    private function getConfigPath(): string
    {
        try {
            $appRootFolder = DirectoryUtils::searchParentFolder(__DIR__, $this->getVendorDirectory());
        } catch (DirectoryException $e) {
            throw new ConfigException($e->getMessage(), AbstractResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

        $configFolder = $appRootFolder . '/config/';

        if (!file_exists($configFolder . $this->getConfigFileName())) {
            throw new ConfigException(
                sprintf('Please create %s in config folder', $this->getConfigFileName()),
                AbstractResponse::HTTP_UNPROCESSABLE_ENTITY
            );
        }
        return $configFolder;
    }

    /**
     * @return string
     */
    public function getConfigFileName(): string
    {
        return $this->configFileName;
    }

    /**
     * @param string $configFileName
     * @return string
     */
    public function setConfigFileName(string $configFileName)
    {
        $this->configFileName = $configFileName;
    }

    /**
     * @return string
     */
    public function getVendorDirectory(): string
    {
        return $this->vendorDirectory;
    }

    /**
     * @param string $vendorDirectory
     * @return string
     */
    public function setVendorDirectory(string $vendorDirectory)
    {
        $this->vendorDirectory = $vendorDirectory;
    }
}
