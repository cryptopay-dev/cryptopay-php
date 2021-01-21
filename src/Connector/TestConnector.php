<?php

namespace Cryptopay\Connector;

use Cryptopay\Config\ConfigInterface;
use GuzzleHttp\Client as GuzzleClient;

class TestConnector extends AbstractConnector
{
    /**
     * Connector constructor.
     * @param ConfigInterface $config
     * @param GuzzleClient|null $client
     */
    public function __construct(ConfigInterface $config, GuzzleClient $client)
    {
        $this->config = $config;
        $this->client = $client;
    }
}
