<?php

namespace Cryptopay\Config;

interface ConfigInterface
{
    /**
     * @param string $baseUrl
     * @return ConfigInterface
     */
    public function withBaseUrl(string $baseUrl): self;

    /**
     * @return string
     */
    public function getBaseUrl(): string;

    /**
     * @return string
     */
    public function getApiKey(): string;

    /**
     * @param string $apiKey
     * @return ConfigInterface
     */
    public function withApiKey(?string $apiKey): self;

    /**
     * @return string
     */
    public function getApiSecret();

    /**
     * @param string $apiSecret
     * @return ConfigInterface
     */
    public function withApiSecret(?string $apiSecret): self;

    /**
     * @return int
     */
    public function getTimeout(): int;

    /**
     * @param int $timeout
     * @return ConfigInterface
     */
    public function withTimeout(int $timeout): self;

    /**
     * @param string|null $callbackSecret
     * @return ConfigInterface
     */
    public function withCallbackSecret(string $callbackSecret): self;

    /**
     * @return string|null
     */
    public function getCallbackSecret(): ?string;
}
