<?php

// Auto-generated file
// DO NOT EDIT

namespace Cryptopay\Api;

use Cryptopay\AbstractApi;

class RisksApi extends AbstractApi
{
   /**
    * Score a coin address
    *
    * @param null|array $params
    *
    * @throws \Cryptopay\Exceptions\RequestException
    * @return object
    */
    public function score(array $params = null)
    {
        return $this->request('POST', '/api/risks/score', $params);
    }
}
