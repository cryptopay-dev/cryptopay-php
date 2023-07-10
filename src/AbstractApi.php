<?php

namespace Cryptopay;

use Cryptopay\Connector\ConnectorInterface;

abstract class AbstractApi
{

    /**
     * @var \Cryptopay\Connector\ConnectorInterface
     */
    private $connector;

    /**
     * @param \Cryptopay\Connector\ConnectorInterface $connector
     */
    public function __construct(ConnectorInterface $connector)
    {
        $this->connector = $connector;
    }

    protected function request(string $method, $string path, array $params = null) {
      return $this->connector->request($method, $path, $params);
    }
}
