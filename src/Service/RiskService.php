<?php

namespace Cryptopay\Service;

use Cryptopay\Constants\Methods;
use Cryptopay\Exceptions\RequestException;
use Cryptopay\Constants\ApiMethods;
use Cryptopay\Exceptions\RiskException;

class RiskService extends AbstractService
{
    /**
     * @param array $riskRequest
     * @return object
     * @throws RequestException
     */
    public function get(array $riskRequest): object
    {
        return $this->connector->request(
            Methods::POST,
            ApiMethods::RISKS,
            $riskRequest
        );
    }
}
