<?php

namespace Cryptopay\Connector;

use Cryptopay\Config\ConfigInterface;
use GuzzleHttp\Client as GuzzleClient;

class Connector extends AbstractConnector
{
    /**
     * Connector constructor.
     * @param ConfigInterface $config
     */
    public function __construct(ConfigInterface $config, string $userAgent)
    {
        $this->config = $config;

        $this->userAgent = $userAgent;

        $this->client = new GuzzleClient([
            'base_uri' => $this->config->getBaseUrl(),
            'timeout' => $this->config->getTimeout()
        ]);
    }
}
