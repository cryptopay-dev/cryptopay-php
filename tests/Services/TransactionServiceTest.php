<?php

namespace Tests;

use Cryptopay\AbstractResponse;
use Cryptopay\Exceptions\UuidException;
use Cryptopay\Service\TransactionService;

class TransactionServiceTest extends BaseTest
{
    public function testGetAll()
    {
        $message = $this->getJsonFile('/data/transaction/list.json');
        $connector = $this->createConnectorWithGuzzleMock($message, AbstractResponse::HTTP_OK);
        $transactionService = new TransactionService($connector);

        $response = $transactionService->getAll();
        $this->assertNotNull($response);
        $this->assertCount(3, $response->data);
    }

    public function testGetAllWillThrowExceptionWithWrongStartingAfter()
    {
        $coinWithdrawalService = new TransactionService($this->connector);

        $this->expectException(UuidException::class);
        $this->expectExceptionCode(AbstractResponse::HTTP_UNPROCESSABLE_ENTITY);
        $this->expectExceptionMessage('Not valid uuid format');
        $coinWithdrawalService->getAll(['starting_after' => '123']);
    }
}
