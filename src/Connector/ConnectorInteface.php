<?php

namespace Cryptopay\Connector;

use Cryptopay\Exceptions\RequestException;
use Psr\Http\Message\ResponseInterface;

interface ConnectorInteface
{
    /**
     * @param string $method
     * @param string $path
     * @param array $params
     * @return object
     * @throws RequestException
     */
    public function request(string $method, string $path, array $params = []): object;

    /**
     * @param ResponseInterface $response
     * @return object
     */
    public function parseResponse(ResponseInterface $response): object;

    /**
     * @param string $method
     * @param string $path
     * @param string $body
     * @return array
     */
    public function signRequest(string $method, string $path, ?string $body): array;
}
