<?php

namespace Cryptopay\Service;

use Cryptopay\Constants\ApiMethods;
use Cryptopay\Constants\Methods;
use Cryptopay\Exceptions\RequestException;

class RateService extends AbstractService
{
    /**
     * @return object
     * @throws RequestException
     */
    public function getRates(): object
    {
        return $this->connector->request(
            Methods::GET,
            ApiMethods::RATES,
        );
    }

    /**
     * @param string $pair
     * @return object
     * @throws RequestException
     */
    public function getRatesPair(string $pair): object
    {
        return $this->connector->request(
            Methods::GET,
            ApiMethods::RATES . '/' . $pair
        );
    }
}
