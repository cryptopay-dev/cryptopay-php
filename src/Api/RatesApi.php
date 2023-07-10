<?php

// Auto-generated file
// DO NOT EDIT

namespace Cryptopay\Api;

use Cryptopay\AbstractApi;

class RatesApi extends AbstractApi
{
   /**
    * Retrieve all rates
    *
    * @param null|array $params
    *
    * @throws \Cryptopay\Exceptions\RequestException
    * @return object
    */
    public function all(array $params = null)
    {
        return $this->request('GET', '/api/rates', $params);
    }

   /**
    * Retrieve a pair rate
    *
    * @param string $baseCurrency
    * @param string $quoteCurrency
    * @param null|array $params
    *
    * @throws \Cryptopay\Exceptions\RequestException
    * @return object
    */
    public function retrieve(string $baseCurrency, string $quoteCurrency, array $params = null)
    {
        $path = '/api/rates/{base_currency}/{quote_currency}';
        $path = str_replace('{base_currency}', rawurlencode($baseCurrency), $path);
        $path = str_replace('{quote_currency}', rawurlencode($quoteCurrency), $path);

        return $this->request('GET', $path, $params);
    }
}
