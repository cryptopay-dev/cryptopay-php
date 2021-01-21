<?php

namespace Tests;

use Cryptopay\AbstractResponse;
use Cryptopay\Constants\CurrenciesConstants;
use Cryptopay\Exceptions\RequestException;
use Cryptopay\Exceptions\UuidException;
use Cryptopay\Service\CoinWithdrawalService;

class CoinWithdrawalServiceTest extends BaseTest
{

    public function testCantCreateCoinWithdrawalWithDuplicatedCustomId()
    {
        $message = $this->getJsonFile('/data/common/duplicate_custom_id.json');
        $connector = $this->createConnectorWithGuzzleMock($message, AbstractResponse::HTTP_CONFLICT);

        $this->expectException(RequestException::class);
        $this->expectExceptionMessage($message);
        $coinWithdrawalService = new CoinWithdrawalService($connector);
        $coinWithdrawalService->create($this->generateData());
    }

    public function testShouldCreateCoinWithdrawal()
    {
        $message = $this->getJsonFile('/data/invoice/invoice_created.json');
        $connector = $this->createConnectorWithGuzzleMock($message, AbstractResponse::HTTP_OK);
        $coinWithdrawalService = new CoinWithdrawalService($connector);
        $response = $coinWithdrawalService->create($this->generateData());
        $this->assertNotNull($response);
    }

    public function testCantCommitAlreadyCommitedCoinWithdrawal()
    {
        $message = $this->getJsonFile('/data/withdrawal/already_commited.json');

        $connector = $this->createConnectorWithGuzzleMock($message, AbstractResponse::HTTP_CONFLICT);
        $coinWithdrawalService = new CoinWithdrawalService($connector);

        $this->expectException(RequestException::class);
        $this->expectExceptionCode(AbstractResponse::HTTP_CONFLICT);
        $this->expectExceptionMessage($message);

        $coinWithdrawalService->create($this->generateData());
    }

    public function testCanCommitWithdrawal()
    {
        $message = $this->getJsonFile('/data/withdrawal/created.json');
        $connector = $this->createConnectorWithGuzzleMock($message, AbstractResponse::HTTP_OK);
        $coinWithdrawalService = new CoinWithdrawalService($connector);

        $response = $coinWithdrawalService->create($this->generateData());

        $this->assertNotNull($response);
    }

    public function testGetCoinWithdrawal()
    {
        $message = $this->getJsonFile('/data/withdrawal/view.json');
        $connector = $this->createConnectorWithGuzzleMock($message, AbstractResponse::HTTP_OK);
        $coinWithdrawalService = new CoinWithdrawalService($connector);

        $response = $coinWithdrawalService->get("366fcd88-2d90-47b3-bdfb-5d3e3e8d8550");
        $this->assertNotNull($response);
    }

    public function testGetCustomCoinWithdrawal()
    {
        $message = $this->getJsonFile('/data/withdrawal/view.json');
        $connector = $this->createConnectorWithGuzzleMock($message, AbstractResponse::HTTP_OK);
        $coinWithdrawalService = new CoinWithdrawalService($connector);

        $response = $coinWithdrawalService->getCustom("1");
        $this->assertNotNull($response);
    }

    public function testGetAll()
    {
        $message = $this->getJsonFile('/data/withdrawal/list.json');
        $connector = $this->createConnectorWithGuzzleMock($message, AbstractResponse::HTTP_OK);
        $coinWithdrawalService = new CoinWithdrawalService($connector);

        $response = $coinWithdrawalService->getAll();
        $this->assertNotNull($response);
        $this->assertCount(3, $response->data);
    }

    public function testGetAllWillThrowExceptionWithWrongStartingAfter()
    {
        $coinWithdrawalService = new CoinWithdrawalService($this->connector);

        $this->expectException(UuidException::class);
        $this->expectExceptionCode(AbstractResponse::HTTP_UNPROCESSABLE_ENTITY);
        $this->expectExceptionMessage('Not valid uuid format');
        $coinWithdrawalService->getAll("123");
    }

    /**
     * @return array
     */
    private function generateData(): array
    {
        return [
            'received_amount' => "0.00011",
            'address' => '2MxD4zPNgjpe2BWUJTiCJMVGzrWsmMRsRqv',
            'custom_id' => '1',
            'charged_currency' => CurrenciesConstants::CURRENCY_BTC,
            'received_currency' => CurrenciesConstants::CURRENCY_BTC
        ];
    }
}
