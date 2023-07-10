<?php

namespace Cryptopay\Service;

use Cryptopay\AbstractResponse;
use Cryptopay\Connector\ConnectorInterface;
use Cryptopay\Exceptions\UuidException;

abstract class AbstractService
{
    protected ConnectorInterface $connector;

    public function __construct(ConnectorInterface $connector)
    {
        $this->connector = $connector;
    }

    /**
     * @param string $value
     * @throws UuidException
     */
    public function checkValidUuid(string $value)
    {
        $UUIDv4 = '/^[0-9A-F]{8}-[0-9A-F]{4}-4[0-9A-F]{3}-[89AB][0-9A-F]{3}-[0-9A-F]{12}$/i';
        if (!preg_match($UUIDv4, $value)) {
            throw new UuidException('Not valid uuid format', AbstractResponse::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    /**
     * @param string $value
     * @return bool
     * @throws UuidException
     */
    public function checkValidUuidOrNull(?string $value = null)
    {
        if (empty($value)) {
            return true;
        }
        $UUIDv4 = '/^[0-9A-F]{8}-[0-9A-F]{4}-4[0-9A-F]{3}-[89AB][0-9A-F]{3}-[0-9A-F]{12}$/i';
        if (!preg_match($UUIDv4, $value)) {
            throw new UuidException('Not valid uuid format', AbstractResponse::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
}
