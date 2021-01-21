<?php

namespace Cryptopay\Service;

use Cryptopay\Constants\Methods;
use Cryptopay\Exceptions\RequestException;
use Cryptopay\Constants\ApiMethods;
use Cryptopay\Exceptions\UuidException;

class AccountsService extends AbstractService
{
    /**
     * @return object
     * @throws RequestException
     */
    public function getAll(): object
    {
        return $this->connector->request(
            Methods::GET,
            ApiMethods::ACCOUNTS,
        );
    }

    /**
     * @param string $accountId
     * @param string|null $startingAfter
     * @return object
     * @throws RequestException
     * @throws UuidException
     */
    public function getAccountTransactions(string $accountId, string $startingAfter = null): object
    {
        $this->checkValidUuidOrNull($startingAfter);
        return $this->connector->request(
            Methods::GET,
            sprintf(ApiMethods::ACCOUNT_TRANSACTIONS, $accountId),
            $startingAfter ? ['starting_after' => $startingAfter] : []
        );
    }
}
