<?php

namespace Cryptopay;

use Cryptopay\Connector\ConnectorInteface;

abstract class AbstractApi
{

    /**
     * @var \Cryptopay\Connector\ConnectorInteface
     */
    private $connector;

    /**
     * @param \Cryptopay\Connector\ConnectorInteface $connector
     */
    public function __construct(ConnectorInteface $connector)
    {
        $this->connector = $connector;
    }

    protected function request(string $method, $string path, array $params = null) {
      return $this->connector->request($method, $path, $params);
    }
}
