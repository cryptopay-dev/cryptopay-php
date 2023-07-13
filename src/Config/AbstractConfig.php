<?php

namespace Cryptopay\Config;

use Cryptopay\AbstractResponse;
use Cryptopay\Exceptions\ConfigException;
use Exception;

class AbstractConfig implements ConfigInterface
{
    protected string $apiKey;

    protected string $apiSecret;

    protected string $baseUrl = 'https://business.cryptopay.me';

    protected int $timeout = 10;

    protected string $callbackSecret = '';

    /**
     * @param string $baseUrl
     * @return Config
     */
    public function withBaseUrl(string $baseUrl): self
    {
        $this->baseUrl = $baseUrl;

        return $this;
    }

    /**
     * @return string
     */
    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }

    /**
     * @return string
     */
    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    /**
     * @param string $apiKey
     * @return Config
     */
    public function withApiKey(?string $apiKey): self
    {
        $this->apiKey = $apiKey;

        return $this;
    }

    /**
     * @return string
     */
    public function getApiSecret()
    {
        return $this->apiSecret;
    }

    /**
     * @param string $apiSecret
     * @return Config
     */
    public function withApiSecret(?string $apiSecret): self
    {
        $this->apiSecret = $apiSecret;

        return $this;
    }

    /**
     * @return int
     */
    public function getTimeout(): int
    {
        return $this->timeout;
    }

    /**
     * @param int $timeout
     * @return Config
     */
    public function withTimeout(int $timeout): self
    {
        $this->timeout = $timeout;

        return $this;
    }

    /**
     * @param string|null $callbackSecret
     * @return Config
     */
    public function withCallbackSecret(string $callbackSecret): self
    {
        $this->callbackSecret = $callbackSecret;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCallbackSecret(): ?string
    {
        return $this->callbackSecret;
    }

    /**
     * @throws ConfigException
     */
    public function validateConfig()
    {
        try {
            if (
                empty($this->getApiKey())
                || empty($this->getApiSecret())
                || empty($this->getBaseUrl())) {
                throw new ConfigException(
                    'Required configuration params not found',
                    AbstractResponse::HTTP_UNPROCESSABLE_ENTITY
                );
            }
        } catch (Exception $e) {
            throw new ConfigException($e->getMessage(), AbstractResponse::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
}
