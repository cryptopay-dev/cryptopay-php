<?php

namespace Cryptopay\Service;

use Cryptopay\AbstractResponse;
use Cryptopay\Exceptions\CallbackException;
use Cryptopay\Exceptions\ForbiddenException;

class CallbackService
{
    private string $callbackSecret;

    public function __construct(string $callbackSecret)
    {
        $this->callbackSecret = $callbackSecret;
    }

    /**
     * @param string $callbackBodyJson
     * @param array $headers
     * @return string
     * @throws ForbiddenException
     * @throws CallbackException
     */
    public function validateCallback(string $callbackBodyJson, array $headers): string
    {
        json_decode($callbackBodyJson, true);

        if ($errorNumber = json_last_error()) {
            throw new CallbackException(
                sprintf('Invalid JSON. Code: %s. Data: %s', $errorNumber, $callbackBodyJson),
                AbstractResponse::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        if (
            empty($headers['x-cryptopay-signature'])
            || !($this->verifySignature($callbackBodyJson, $headers['x-cryptopay-signature']))
        ) {
            throw new ForbiddenException("Forbidden", AbstractResponse::HTTP_FORBIDDEN);
        }

        return $callbackBodyJson;
    }

    private function verifySignature(string $callbackBodyJson, string $headerSignature)
    {
        return $headerSignature == $this->buildSignature($callbackBodyJson);
    }

    /**
     * @param string $callbackBodyJson
     * @return string
     */
    private function buildSignature(string $callbackBodyJson)
    {
        return hash_hmac(
            'sha256',
            $callbackBodyJson,
            $this->callbackSecret
        );
    }
}
