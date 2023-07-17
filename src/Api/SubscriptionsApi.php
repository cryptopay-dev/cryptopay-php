<?php

// Auto-generated file
// DO NOT EDIT

namespace Cryptopay\Api;

use Cryptopay\AbstractApi;

class SubscriptionsApi extends AbstractApi
{
   /**
    * List subscriptions
    *
    * @param null|array $params
    *
    * @throws \Cryptopay\Exceptions\RequestException
    * @return object
    */
    public function all(array $params = null)
    {
        return $this->request('GET', '/api/subscriptions', $params);
    }

   /**
    * Cancel a subscription
    *
    * @param string $subscriptionId
    * @param null|array $params
    *
    * @throws \Cryptopay\Exceptions\RequestException
    * @return object
    */
    public function cancel(string $subscriptionId, array $params = null)
    {
        $path = '/api/subscriptions/{subscription_id}/cancel';
        $path = str_replace('{subscription_id}', rawurlencode($subscriptionId), $path);

        return $this->request('POST', $path, $params);
    }

   /**
    * Create a subscription
    *
    * @param null|array $params
    *
    * @throws \Cryptopay\Exceptions\RequestException
    * @return object
    */
    public function create(array $params = null)
    {
        return $this->request('POST', '/api/subscriptions', $params);
    }

   /**
    * Retrieve a subscription
    *
    * @param string $subscriptionId
    * @param null|array $params
    *
    * @throws \Cryptopay\Exceptions\RequestException
    * @return object
    */
    public function retrieve(string $subscriptionId, array $params = null)
    {
        $path = '/api/subscriptions/{subscription_id}';
        $path = str_replace('{subscription_id}', rawurlencode($subscriptionId), $path);

        return $this->request('GET', $path, $params);
    }

   /**
    * Retrieve a subscription by custom_id
    *
    * @param string $customId
    * @param null|array $params
    *
    * @throws \Cryptopay\Exceptions\RequestException
    * @return object
    */
    public function retrieveByCustomId(string $customId, array $params = null)
    {
        $path = '/api/subscriptions/custom_id/{custom_id}';
        $path = str_replace('{custom_id}', rawurlencode($customId), $path);

        return $this->request('GET', $path, $params);
    }
}
