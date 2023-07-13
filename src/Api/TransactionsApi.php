<?php

// Auto-generated file
// DO NOT EDIT

namespace Cryptopay\Api;

use Cryptopay\AbstractApi;

class TransactionsApi extends AbstractApi
{
   /**
    * List transactions
    *
    * @param null|array $params
    *
    * @throws \Cryptopay\Exceptions\RequestException
    * @return object
    */
    public function all(array $params = null)
    {
        return $this->request('GET', '/api/transactions', $params);
    }
}
