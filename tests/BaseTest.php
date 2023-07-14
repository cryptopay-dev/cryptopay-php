<?php

namespace Tests;

use Cryptopay\Config\Config;
use Cryptopay\Connector\Connector;
use Cryptopay\Connector\TestConnector;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;

abstract class BaseTest extends TestCase
{
    private string $baseUrl = 'https://business-sandbox.cryptopay.me';
    private int $timeout = 10;

    public Config $config;

    public Connector $connector;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        $this->config = (new Config())
            ->withApiKey(getenv('CRYPTOPAY_API_KEY'))
            ->withApiSecret(getenv('CRYPTOPAY_API_SECRET'))
            ->withBaseUrl($this->baseUrl)
            ->withTimeout($this->timeout);

        $this->connector = new Connector($this->config, 'Cryptopay-PHP/Test');

        parent::__construct($name, $data, $dataName);
    }

    public function getJsonFile(string $path)
    {
        return file_get_contents(__DIR__ . $path);
    }

    /**
     * @param string $message
     * @param int $code
     * @return TestConnector
     */
    public function createConnectorWithGuzzleMock(string $message, int $code)
    {
        $mock = new MockHandler([
            new Response($code, [], $message),
        ]);

        $handlerStack = HandlerStack::create($mock);
        $client = new Client(['handler' => $handlerStack]);

        return new TestConnector($this->config, $client);
    }
}
