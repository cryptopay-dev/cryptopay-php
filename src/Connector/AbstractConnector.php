<?php

namespace Cryptopay\Connector;

use Cryptopay\Config\ConfigInterface;
use Exception;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\ResponseInterface;
use Cryptopay\Exceptions\RequestException;

abstract class AbstractConnector implements ConnectorInteface
{
    protected ConfigInterface $config;

    protected GuzzleClient $client;

    /**
     * @param string $method
     * @param string $path
     * @param array $params
     * @return object
     * @throws RequestException
     */
    public function request(string $method, string $path, array $params = []): object
    {
        $body = $params ? json_encode($params) : '';

        try {
            $headers = $this->signRequest($method, $path, $body);
            $request = new Request($method, $path, $headers, $body);
            $response = $this->client->send($request);
            return $this->parseResponse($response);
        } catch (ClientException $e) {
            throw new RequestException($e->getResponse()->getBody()->getContents(), $e->getCode());
        } catch (GuzzleException $guzzleException) {
            throw new RequestException($guzzleException->getMessage(), $guzzleException->getCode());
        } catch (Exception $e) {
            throw new RequestException($e->getMessage(), $e->getCode());
        }
    }

    /**
     * @param ResponseInterface $response
     * @return object
     */
    public function parseResponse(ResponseInterface $response): object
    {
        return json_decode($response->getBody()->getContents(), false);
    }

    /**
     * @param string $method
     * @param string $path
     * @param string $body
     * @return array
     */
    public function signRequest(string $method, string $path, ?string $body): array
    {
        $date = gmdate(DATE_RFC2822);
        $contentType = 'application/json';
        $bodyHash = $body ? md5($body) : '';

        $sigString = implode("\n", [$method, $bodyHash, $contentType, $date, $path]);
        $signature = base64_encode(
            hash_hmac(
                'sha1',
                $sigString,
                $this->config->getApiSecret(),
                true
            )
        );

        return [
            'Content-Type' => $contentType,
            'date' => $date,
            'Authorization' => 'HMAC ' . $this->config->getApiKey() . ':' . $signature
        ];
    }
}
