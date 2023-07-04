<?php

namespace Tests;

use Cryptopay\AbstractResponse;
use Cryptopay\Connector\Connector;
use Cryptopay\Constants\CurrenciesConstants;
use Cryptopay\Exceptions\RequestException;
use Cryptopay\Service\RateService;

class RateServiceTest extends BaseTest
{
    private int $totalRates = 231;

    public function testServiceUnavailableShouldReturnRequestException()
    {
        $this->config->withBaseUrl('url_not_exists.ccc');
        $connector = new Connector($this->config);
        $rateService = new RateService($connector);

        $this->expectException(RequestException::class);
        $rateService->getRates();
    }

    public function testGetRates()
    {
        $message = $this->getJsonFile('/data/rates/list.json');
        $connector = $this->createConnectorWithGuzzleMock($message, AbstractResponse::HTTP_OK);
        $rateService = new RateService($connector);

        $response = $rateService->getRates();
        $this->assertNotNull($response->data->BTCUSD);
        $this->assertNotNull($response->data->BTCEUR);
        $this->assertCount($this->totalRates, (array)$response->data);
    }

    public function testGetRatesPair()
    {
        $message = $this->getJsonFile('/data/rates/pair.json');
        $connector = $this->createConnectorWithGuzzleMock($message, AbstractResponse::HTTP_OK);
        $rateService = new RateService($connector);

        $response = $rateService->getRatesPair(
            CurrenciesConstants::CURRENCY_BTC . CurrenciesConstants::CURRENCY_USD
        );
        $this->assertNotNull($response->data);
    }

    public function testGetRatesWrongPairShouldReturnNotFound()
    {
        $message = $this->getJsonFile('/data/common/not_found.json');

        $connector = $this->createConnectorWithGuzzleMock(
            $message,
            AbstractResponse::HTTP_NOT_FOUND
        );

        $this->expectException(RequestException::class);
        $this->expectExceptionCode(AbstractResponse::HTTP_NOT_FOUND);
        $this->expectExceptionMessage($message);
        (new RateService($connector))->getRatesPair(
            CurrenciesConstants::CURRENCY_BTC . CurrenciesConstants::CURRENCY_BTC
        );
    }
}
