<?php

namespace Cryptopay\Service;

use Cryptopay\Constants\Methods;
use Cryptopay\Exceptions\RequestException;
use Cryptopay\Constants\ApiMethods;
use Cryptopay\Exceptions\UuidException;

class TransactionService extends AbstractService
{
    /**
     * @param array $data
     * @return object
     * @throws RequestException
     * @throws UuidException
     */
    public function getAll(array $data = []): object
    {
        if (!empty($data['starting_after'])) {
            $this->checkValidUuid($data['starting_after']);
        }
        return $this->connector->request(
            Methods::GET,
            ApiMethods::TRANSACTIONS,
            $data
        );
    }
}
