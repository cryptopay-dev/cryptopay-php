<?php

namespace Tests;

use Cryptopay\AbstractResponse;
use Cryptopay\Exceptions\RequestException;
use Cryptopay\Exceptions\UuidException;
use Cryptopay\Service\AccountsService;

class AccountServiceTest extends BaseTest
{
    public const ACCOUNT_ID = '130c4b3c-7281-4cf6-852a-76a05b7b5315';
    public const WRONG_ACCOUNT_ID = '1111111c-7281-4cf6-852a-76a05b7b5315';

    public function testGetAccountsIpNotAllowed()
    {
        $message = $this->getJsonFile('/data/common/ip_not_allowed.json');

        $connector = $this->createConnectorWithGuzzleMock(
            $message,
            AbstractResponse::HTTP_UNPROCESSABLE_ENTITY
        );
        $accountService = new AccountsService($connector);

        $this->expectException(RequestException::class);
        $this->expectExceptionCode(AbstractResponse::HTTP_UNPROCESSABLE_ENTITY);
        $this->expectExceptionMessage($message);
        $accountService->getAll();
    }

    public function testGetAccounts()
    {
        $message = $this->getJsonFile('/data/account/list.json');

        $connector = $this->createConnectorWithGuzzleMock($message, AbstractResponse::HTTP_OK);

        $accountService = new AccountsService($connector);
        $response = $accountService->getAll();

        $this->assertNotNull($response);
        $this->assertCount(2, $response->data);
    }

    public function testGetAccountTransactions()
    {
        $message = $this->getJsonFile('/data/account/transactions.json');

        $connector = $this->createConnectorWithGuzzleMock($message, AbstractResponse::HTTP_OK);
        $channelService = new AccountsService($connector);

        $response = $channelService->getAll();
        $this->assertNotNull($response);
        $this->assertCount(4, $response->data);
    }

    public function testGetAccountTransactionThrowExceptionWithWrongFormatStartingAfter()
    {
        $accountService = new AccountsService($this->connector);

        $this->expectException(UuidException::class);
        $this->expectExceptionCode(AbstractResponse::HTTP_UNPROCESSABLE_ENTITY);
        $this->expectExceptionMessage('Not valid uuid format');
        $accountService->getAccountTransactions(self::ACCOUNT_ID, '123');
    }

    public function testGetAccountTransactionsWithWrongAccountId()
    {
        $message = $this->getJsonFile('/data/account/account_id_wrong_format.json');

        $connector = $this->createConnectorWithGuzzleMock(
            $message,
            AbstractResponse::HTTP_UNPROCESSABLE_ENTITY
        );
        $accountService = new AccountsService($connector);

        $this->expectException(RequestException::class);
        $this->expectExceptionCode(AbstractResponse::HTTP_UNPROCESSABLE_ENTITY);
        $this->expectExceptionMessage($message);
        $accountService->getAccountTransactions(self::ACCOUNT_ID);
    }
}
