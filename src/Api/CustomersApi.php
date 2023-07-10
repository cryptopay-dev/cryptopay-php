<?php

// Auto-generated file
// DO NOT EDIT

namespace Cryptopay\Api;

use Cryptopay\AbstractApi;

class CustomersApi extends AbstractApi
{
    /**
     * List customers
     *
     * @param null|array $params
     *
     * @throws \Cryptopay\Exceptions\RequestException
     * @return object
     */
    public function all(array $params = null) {
        return $this->request('GET', '/api/customers', $params);
    }

    /**
     * Create a customer
     *
     * @param null|array $params
     *
     * @throws \Cryptopay\Exceptions\RequestException
     * @return object
     */
    public function create(array $params = null) {
        return $this->request('POST', '/api/customers', $params);
    }

    /**
     * Retrieve a customer
     *
     * @param string $customerId
     * @param null|array $params
     *
     * @throws \Cryptopay\Exceptions\RequestException
     * @return object
     */
    public function retrieve(string $customerId, array $params = null) {
        $path = '/api/customers/{customer_id}';
        $path = str_replace('{customer_id}', rawurlencode($customerId), $path);

        return $this->request('GET', $path, $params);
    }

    /**
     * Update a customer
     *
     * @param string $customerId
     * @param null|array $params
     *
     * @throws \Cryptopay\Exceptions\RequestException
     * @return object
     */
    public function update(string $customerId, array $params = null) {
        $path = '/api/customers/{customer_id}';
        $path = str_replace('{customer_id}', rawurlencode($customerId), $path);

        return $this->request('PATCH', $path, $params);
    }

}
