<?php

namespace Cryptopay\Connector;

use Cryptopay\Exceptions\RequestException;
use Psr\Http\Message\ResponseInterface;

interface ConnectorInterface
{
    /**
     * @param string $method
     * @param string $path
     * @param null|array $params
     * @return object
     * @throws RequestException
     */
    public function request(string $method, string $path, array $params = null): object;

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
