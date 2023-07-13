<?php

// Auto-generated file
// DO NOT EDIT

namespace Cryptopay\Api;

use Cryptopay\AbstractApi;

class ExchangeTransfersApi extends AbstractApi
{
   /**
    * Commit an exchange transfer
    *
    * @param string $exchangeTransferId
    * @param null|array $params
    *
    * @throws \Cryptopay\Exceptions\RequestException
    * @return object
    */
    public function commit(string $exchangeTransferId, array $params = null)
    {
        $path = '/api/exchange_transfers/{exchange_transfer_id}/commit';
        $path = str_replace('{exchange_transfer_id}', rawurlencode($exchangeTransferId), $path);

        return $this->request('POST', $path, $params);
    }

   /**
    * Create an exchange transfer
    *
    * @param null|array $params
    *
    * @throws \Cryptopay\Exceptions\RequestException
    * @return object
    */
    public function create(array $params = null)
    {
        return $this->request('POST', '/api/exchange_transfers', $params);
    }

   /**
    * Retrieve an exchange transfer
    *
    * @param string $exchangeTransferId
    * @param null|array $params
    *
    * @throws \Cryptopay\Exceptions\RequestException
    * @return object
    */
    public function retrieve(string $exchangeTransferId, array $params = null)
    {
        $path = '/api/exchange_transfers/{exchange_transfer_id}';
        $path = str_replace('{exchange_transfer_id}', rawurlencode($exchangeTransferId), $path);

        return $this->request('GET', $path, $params);
    }
}
