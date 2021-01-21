<?php

namespace Tests;

use Cryptopay\AbstractResponse;
use Cryptopay\Constants\CurrenciesConstants;
use Cryptopay\Exceptions\RequestException;
use Cryptopay\Service\RiskService;

class RiskServiceTest extends BaseTest
{
    public function testRequestRiskAddressInvalid()
    {
        $message = $this->getJsonFile('/data/risk/address_invalid.json');

        $connector = $this->createConnectorWithGuzzleMock(
            $message,
            AbstractResponse::HTTP_UNPROCESSABLE_ENTITY
        );
        $riskService = new RiskService($connector);

        $this->expectException(RequestException::class);
        $this->expectExceptionCode(AbstractResponse::HTTP_UNPROCESSABLE_ENTITY);
        $this->expectExceptionMessage($message);

        $response = $riskService->get($this->generateData());

        $this->assertNotNull($response);
    }

    public function testRequestRiskCurrencyInvalid()
    {
        $message = $this->getJsonFile('/data/risk/currency_invalid.json');

        $connector = $this->createConnectorWithGuzzleMock(
            $message,
            AbstractResponse::HTTP_UNPROCESSABLE_ENTITY
        );
        $riskService = new RiskService($connector);

        $this->expectException(RequestException::class);
        $this->expectExceptionCode(AbstractResponse::HTTP_UNPROCESSABLE_ENTITY);
        $this->expectExceptionMessage($message);

        $riskService->get($this->generateData());
    }

    public function testRisksGetSuccessful()
    {
        $message = $this->getJsonFile('/data/risk/address_risk.json');
        $connector = $this->createConnectorWithGuzzleMock($message, AbstractResponse::HTTP_OK);
        $riskService = new RiskService($connector);

        $response = $riskService->get($this->generateData());

        $this->assertNotEmpty($response->data->score);
        $this->assertNotEmpty($response->data->level);
        $this->assertNotEmpty($response->data->resource_name);
        $this->assertNotEmpty($response->data->resource_category);
    }

    /**
     * @return array
     */
    private function generateData(): array
    {
        return [
            'type' => 'destination_of_funds',
            'address' => '2NDSMEM2dicJDb7xHjcxVGGz2xgzXeWGmRC',
            'currency' => CurrenciesConstants::CURRENCY_BTC,
        ];
    }
}
