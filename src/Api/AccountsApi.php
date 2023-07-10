<?php

// Auto-generated file
// DO NOT EDIT

namespace Cryptopay\Api;

use Cryptopay\AbstractApi;

class AccountsApi extends AbstractApi
{
    /**
     * List accounts
     *
     * @param null|array $params
     *
     * @throws \Cryptopay\Exceptions\RequestException
     * @return object
     */
    public function all(array $params = null) {
        return $this->request('GET', '/api/accounts', $params);
    }

    /**
     * List account transactions
     *
     * @param string $accountId
     * @param null|array $params
     *
     * @throws \Cryptopay\Exceptions\RequestException
     * @return object
     */
    public function allTransactions(string $accountId, array $params = null) {
        $path = '/api/accounts/{account_id}/transactions';
        $path = str_replace('{account_id}', rawurlencode($accountId), $path);

        return $this->request('GET', $path, $params);
    }

}
