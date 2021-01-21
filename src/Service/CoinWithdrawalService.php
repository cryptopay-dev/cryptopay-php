<?php

namespace Cryptopay\Service;

use Cryptopay\Constants\Methods;
use Cryptopay\Exceptions\RequestException;
use Cryptopay\Constants\ApiMethods;
use Cryptopay\Exceptions\UuidException;

class CoinWithdrawalService extends AbstractService
{
    /**
     * @param array $withdrawalData
     * @return object
     * @throws RequestException
     */
    public function create(array $withdrawalData): object
    {
        return $this->connector->request(
            Methods::POST,
            ApiMethods::WITHDRAWALS,
            $withdrawalData
        );
    }

    /**
     * @param string $id
     * @return object
     * @throws RequestException
     * @throws UuidException
     */
    public function commit(string $id): object
    {
        $this->checkValidUuid($id);
        return $this->connector->request(
            Methods::POST,
            sprintf(ApiMethods::WITHDRAWAL_COMMIT, $id)
        );
    }

    /**
     * @param string $id
     * @return object
     * @throws RequestException
     * @throws UuidException
     */
    public function get(string $id): object
    {
        $this->checkValidUuid($id);
        return $this->connector->request(
            Methods::GET,
            sprintf(ApiMethods::WITHDRAWAL_DETAILS, $id),
        );
    }

    /**
     * @param string $customId
     * @return object
     * @throws RequestException
     */
    public function getCustom(string $customId): object
    {
        return $this->connector->request(
            Methods::GET,
            sprintf(ApiMethods::WITHDRAWAL_CUSTOM, $customId),
        );
    }

    /**
     * @param string $startingAfter
     * @return object
     * @throws RequestException
     * @throws UuidException
     */
    public function getAll(string $startingAfter = null): object
    {
        $this->checkValidUuidOrNull($startingAfter);

        return $this->connector->request(
            Methods::GET,
            ApiMethods::WITHDRAWALS,
            $startingAfter ? ['starting_after' => $startingAfter] : []
        );
    }
}
