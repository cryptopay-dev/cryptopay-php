<?php

namespace Cryptopay\Service;

use Cryptopay\Constants\Methods;
use Cryptopay\Exceptions\RequestException;
use Cryptopay\Constants\ApiMethods;
use Cryptopay\Exceptions\UuidException;

class ChannelService extends AbstractService
{
    /**
     * @param array $channelData
     * @return object
     * @throws RequestException
     */
    public function create(array $channelData): object
    {
        return $this->connector->request(
            Methods::POST,
            ApiMethods::CHANNELS,
            $channelData
        );
    }

    /**
     * @param string $channelId
     * @return object
     * @throws RequestException
     * @throws UuidException
     */
    public function get(string $channelId): object
    {
        $this->checkValidUuid($channelId);
        return $this->connector->request(
            Methods::GET,
            sprintf(ApiMethods::CHANNEL_DETAILS, $channelId),
        );
    }

    /**
     * @param string $customId
     * @return object
     * @throws RequestException
     */
    public function getCustomChannel(string $customId): object
    {
        return $this->connector->request(
            Methods::GET,
            sprintf(ApiMethods::CHANNEL_CUSTOM, $customId)
        );
    }

    /**
     * @param string $channelId
     * @param array $channelData
     * @return object
     * @throws RequestException
     * @throws UuidException
     */
    public function update(string $channelId, array $channelData): object
    {
        $this->checkValidUuid($channelId);
        return $this->connector->request(
            Methods::PATCH,
            sprintf(ApiMethods::CHANNEL_DETAILS, $channelId),
            $channelData
        );
    }

    /**
     * @param string $startingAfter
     * @return object
     * @throws RequestException
     * @throws UuidException
     */
    public function getAll(string $startingAfter = null): object
    {
        $this->checkValidUuidOrNull($startingAfter);
        return $this->connector->request(
            Methods::GET,
            ApiMethods::CHANNELS,
            $startingAfter ? ['starting_after' => $startingAfter] : []
        );
    }

    /**
     * @param string $channelId
     * @param string $startingAfter
     * @return object
     * @throws RequestException
     * @throws UuidException
     */
    public function getChannelPayments(string $channelId, string $startingAfter = null): object
    {
        $this->checkValidUuid($channelId);
        $this->checkValidUuidOrNull($startingAfter);
        return $this->connector->request(
            Methods::GET,
            sprintf(ApiMethods::CHANNEL_PAYMENTS, $channelId),
            $startingAfter ? ['starting_after' => $startingAfter] : []
        );
    }

    /**
     * @param string $channelId
     * @param string $paymentId
     * @return object
     * @throws RequestException
     * @throws UuidException
     */
    public function getChannelPayment(string $channelId, string $paymentId): object
    {
        $this->checkValidUuid($channelId);
        $this->checkValidUuid($paymentId);
        return $this->connector->request(
            Methods::GET,
            sprintf(ApiMethods::CHANNEL_PAYMENT_DETAILS, $channelId, $paymentId),
        );
    }
}
