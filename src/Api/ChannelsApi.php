<?php

// Auto-generated file
// DO NOT EDIT

namespace Cryptopay\Api;

use Cryptopay\AbstractApi;

class ChannelsApi extends AbstractApi
{
   /**
    * List channels
    *
    * @param null|array $params
    *
    * @throws \Cryptopay\Exceptions\RequestException
    * @return object
    */
    public function all(array $params = null)
    {
        return $this->request('GET', '/api/channels', $params);
    }

   /**
    * Create a channel
    *
    * @param null|array $params
    *
    * @throws \Cryptopay\Exceptions\RequestException
    * @return object
    */
    public function create(array $params = null)
    {
        return $this->request('POST', '/api/channels', $params);
    }

   /**
    * List channel payments
    *
    * @param string $channelId
    * @param null|array $params
    *
    * @throws \Cryptopay\Exceptions\RequestException
    * @return object
    */
    public function allPayments(string $channelId, array $params = null)
    {
        $path = '/api/channels/{channel_id}/payments';
        $path = str_replace('{channel_id}', rawurlencode($channelId), $path);

        return $this->request('GET', $path, $params);
    }

   /**
    * Retrieve a channel
    *
    * @param string $channelId
    * @param null|array $params
    *
    * @throws \Cryptopay\Exceptions\RequestException
    * @return object
    */
    public function retrieve(string $channelId, array $params = null)
    {
        $path = '/api/channels/{channel_id}';
        $path = str_replace('{channel_id}', rawurlencode($channelId), $path);

        return $this->request('GET', $path, $params);
    }

   /**
    * Retrieve a channel by custom id
    *
    * @param string $customId
    * @param null|array $params
    *
    * @throws \Cryptopay\Exceptions\RequestException
    * @return object
    */
    public function retrieveByCustomId(string $customId, array $params = null)
    {
        $path = '/api/channels/custom_id/{custom_id}';
        $path = str_replace('{custom_id}', rawurlencode($customId), $path);

        return $this->request('GET', $path, $params);
    }

   /**
    * Retrieve a channel payment
    *
    * @param string $channelId
    * @param string $channelPaymentId
    * @param null|array $params
    *
    * @throws \Cryptopay\Exceptions\RequestException
    * @return object
    */
    public function retrievePayment(string $channelId, string $channelPaymentId, array $params = null)
    {
        $path = '/api/channels/{channel_id}/payments/{channel_payment_id}';
        $path = str_replace('{channel_id}', rawurlencode($channelId), $path);
        $path = str_replace('{channel_payment_id}', rawurlencode($channelPaymentId), $path);

        return $this->request('GET', $path, $params);
    }

   /**
    * Update a channel
    *
    * @param string $channelId
    * @param null|array $params
    *
    * @throws \Cryptopay\Exceptions\RequestException
    * @return object
    */
    public function update(string $channelId, array $params = null)
    {
        $path = '/api/channels/{channel_id}';
        $path = str_replace('{channel_id}', rawurlencode($channelId), $path);

        return $this->request('PATCH', $path, $params);
    }
}
