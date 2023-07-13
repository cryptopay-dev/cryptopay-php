<?php

// Auto-generated file
// DO NOT EDIT

namespace Cryptopay\Api;

use Cryptopay\AbstractApi;

class CoinsApi extends AbstractApi
{
   /**
    * List supported coins
    *
    * @param null|array $params
    *
    * @throws \Cryptopay\Exceptions\RequestException
    * @return object
    */
    public function all(array $params = null)
    {
        return $this->request('GET', '/api/coins', $params);
    }
}
