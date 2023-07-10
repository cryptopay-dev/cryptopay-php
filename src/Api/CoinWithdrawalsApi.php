<?php

// Auto-generated file
// DO NOT EDIT

namespace Cryptopay\Api;

use Cryptopay\AbstractApi;

class CoinWithdrawalsApi extends AbstractApi
{
    /**
     * List withdrawals
     *
     * @param null|array $params
     *
     * @throws \Cryptopay\Exceptions\RequestException
     * @return object
     */
    public function all(array $params = null) {
        return $this->request('GET', '/api/coin_withdrawals', $params);
    }

    /**
     * Commit a withdrawal
     *
     * @param string $coinWithdrawalId
     * @param null|array $params
     *
     * @throws \Cryptopay\Exceptions\RequestException
     * @return object
     */
    public function commit(string $coinWithdrawalId, array $params = null) {
        $path = '/api/coin_withdrawals/{coin_withdrawal_id}/commit';
        $path = str_replace('{coin_withdrawal_id}', rawurlencode($coinWithdrawalId), $path);

        return $this->request('POST', $path, $params);
    }

    /**
     * Create a withdrawal
     *
     * @param null|array $params
     *
     * @throws \Cryptopay\Exceptions\RequestException
     * @return object
     */
    public function create(array $params = null) {
        return $this->request('POST', '/api/coin_withdrawals', $params);
    }

    /**
     * List network fees
     *
     * @param null|array $params
     *
     * @throws \Cryptopay\Exceptions\RequestException
     * @return object
     */
    public function allNetworkFees(array $params = null) {
        return $this->request('GET', '/api/coin_withdrawals/network_fees', $params);
    }

    /**
     * Retrieve a withdrawal
     *
     * @param string $coinWithdrawalId
     * @param null|array $params
     *
     * @throws \Cryptopay\Exceptions\RequestException
     * @return object
     */
    public function retrieve(string $coinWithdrawalId, array $params = null) {
        $path = '/api/coin_withdrawals/{coin_withdrawal_id}';
        $path = str_replace('{coin_withdrawal_id}', rawurlencode($coinWithdrawalId), $path);

        return $this->request('GET', $path, $params);
    }

    /**
     * Retrieve a withdrawal by custom id
     *
     * @param string $customId
     * @param null|array $params
     *
     * @throws \Cryptopay\Exceptions\RequestException
     * @return object
     */
    public function retrieveByCustomId(string $customId, array $params = null) {
        $path = '/api/coin_withdrawals/custom_id/{custom_id}';
        $path = str_replace('{custom_id}', rawurlencode($customId), $path);

        return $this->request('GET', $path, $params);
    }

}
