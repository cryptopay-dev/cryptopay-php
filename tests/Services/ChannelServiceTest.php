<?php

namespace Tests;

use Cryptopay\AbstractResponse;
use Cryptopay\Constants\CurrenciesConstants;
use Cryptopay\Exceptions\ChannelException;
use Cryptopay\Exceptions\RequestException;
use Cryptopay\Exceptions\UuidException;
use Cryptopay\Service\ChannelService;

class ChannelServiceTest extends BaseTest
{
    public const CHANNEL_ID = '130c4b3c-7281-4cf6-852a-76a05b7b5315';
    public const WRONG_CHANNEL_ID = '130c4b3c-7281-4cf6-852a-76a05b7b5311';
    public const PAYMENT_ID = '97aef8f1-4948-43ef-b0be-c59cd62ad4ca';
    public const WRONG_PAYMENT_ID = '131c4b3c-7281-4cf6-852a-76a05b7b5311';

    public function testCantCreateChannelWithDuplicatedCustomId()
    {
        $message = $this->getJsonFile('/data/common/duplicate_custom_id.json');

        $connector = $this->createConnectorWithGuzzleMock($message, AbstractResponse::HTTP_CONFLICT);

        $this->expectException(RequestException::class);
        $this->expectExceptionCode(AbstractResponse::HTTP_CONFLICT);
        $this->expectExceptionMessage($message);

        (new ChannelService($connector))->create($this->generateData());
    }

    public function testShouldCreateChannelWithFilledData()
    {
        $message = $this->getJsonFile('/data/channel/channel_created.json');
        $connector = $this->createConnectorWithGuzzleMock($message, AbstractResponse::HTTP_OK);

        $channelService = new ChannelService($connector);
        $response = $channelService->create($this->generateData());
        $this->assertNotNull($response);
    }

    public function testUpdateChannel()
    {
        $message = $this->getJsonFile('/data/channel/channel_created.json');
        $connector = $this->createConnectorWithGuzzleMock($message, AbstractResponse::HTTP_OK);

        $channelService = new ChannelService($connector);
        $response = $channelService->update(self::CHANNEL_ID, ['name' => 123]);
        $this->assertNotNull($response);
    }

    public function testUpdateChannelWithWrongChannelId()
    {
        $message = $this->getJsonFile('/data/common/not_found.json');
        $connector = $this->createConnectorWithGuzzleMock($message, AbstractResponse::HTTP_NOT_FOUND);
        $channelService = new ChannelService($connector);

        $this->expectException(RequestException::class);
        $this->expectExceptionCode(AbstractResponse::HTTP_NOT_FOUND);
        $this->expectExceptionMessage($message);
        $channelService->update(self::WRONG_CHANNEL_ID, ['name' => 123]);
    }

    public function testGetChannel()
    {
        $message = $this->getJsonFile('/data/channel/channel_created.json');
        $connector = $this->createConnectorWithGuzzleMock($message, AbstractResponse::HTTP_OK);

        $channelService = new ChannelService($connector);
        $response = $channelService->get(self::CHANNEL_ID);
        $this->assertNotNull($response);
    }

    public function testGetCustomChannel()
    {
        $message = $this->getJsonFile('/data/channel/channel_created.json');
        $connector = $this->createConnectorWithGuzzleMock($message, AbstractResponse::HTTP_OK);

        $channelService = new ChannelService($connector);
        $response = $channelService->getCustomChannel("1");
        $this->assertNotNull($response);
    }

    public function testGetAll()
    {
        $message = $this->getJsonFile('/data/channel/channels_list.json');
        $connector = $this->createConnectorWithGuzzleMock($message, AbstractResponse::HTTP_OK);
        $channelService = new ChannelService($connector);

        $response = $channelService->getAll();
        $this->assertNotNull($response);
        $this->assertCount(2, $response->data);
    }

    public function testGetAllWillThrowExceptionWithWrongStartingAfter()
    {
        $channelService = new ChannelService($this->connector);

        $this->expectException(UuidException::class);
        $this->expectExceptionCode(AbstractResponse::HTTP_UNPROCESSABLE_ENTITY);
        $this->expectExceptionMessage('Not valid uuid format');
        $channelService->getAll("123");
    }

    public function testGetChannelPayments()
    {
        $message = $this->getJsonFile('/data/channel/channel_payments_list.json');
        $connector = $this->createConnectorWithGuzzleMock($message, AbstractResponse::HTTP_OK);

        $channelService = new ChannelService($connector);
        $response = $channelService->getChannelPayments(self::CHANNEL_ID);
        $this->assertNotNull($response);
        $this->assertCount(3, $response->data);
    }

    public function testGetChannelPaymentsWithWrongChannelId()
    {
        $message = $this->getJsonFile('/data/channel/channel_id_wrong_format.json');
        $connector = $this->createConnectorWithGuzzleMock($message, AbstractResponse::HTTP_CONFLICT);

        $channelService = new ChannelService($connector);
        $this->expectException(RequestException::class);
        $this->expectExceptionCode(AbstractResponse::HTTP_CONFLICT);
        $this->expectExceptionMessage($message);

        $channelService->getChannelPayments(self::WRONG_CHANNEL_ID);
    }

    public function testGetChannelPaymentsWithWrongStartingAfter()
    {
        $channelService = new ChannelService($this->connector);

        $this->expectException(UuidException::class);
        $this->expectExceptionCode(AbstractResponse::HTTP_UNPROCESSABLE_ENTITY);
        $this->expectExceptionMessage('Not valid uuid format');
        $channelService->getChannelPayments(self::CHANNEL_ID, "123");
    }

    public function testGetChannelPayment()
    {
        $message = $this->getJsonFile('/data/channel/channel_payment.json');
        $connector = $this->createConnectorWithGuzzleMock($message, AbstractResponse::HTTP_OK);
        $channelService = new ChannelService($connector);

        $response = $channelService
            ->getChannelPayment(self::CHANNEL_ID, self::PAYMENT_ID);
        $this->assertNotNull($response);
    }

    public function testGetChannelPaymentWithWrongChannelId()
    {
        $message = $this->getJsonFile('/data/common/not_found.json');

        $connector = $this->createConnectorWithGuzzleMock($message, AbstractResponse::HTTP_NOT_FOUND);

        $this->expectException(RequestException::class);
        $this->expectExceptionCode(AbstractResponse::HTTP_NOT_FOUND);
        $this->expectExceptionMessage($message);
        (new ChannelService($connector))
            ->getChannelPayment(self::WRONG_CHANNEL_ID, self::PAYMENT_ID);
    }

    public function testGetChannelPaymentWithWrongPaymentId()
    {
        $message = $this->getJsonFile('/data/common/not_found.json');

        $connector = $this->createConnectorWithGuzzleMock($message, AbstractResponse::HTTP_NOT_FOUND);

        $this->expectException(RequestException::class);
        $this->expectExceptionCode(AbstractResponse::HTTP_NOT_FOUND);
        $this->expectExceptionMessage($message);
        (new ChannelService($connector))
            ->getChannelPayment(self::CHANNEL_ID, self::WRONG_PAYMENT_ID);
    }

    /**
     * @return array
     */
    private function generateData(): array
    {
        return [
            'pay_currency' => CurrenciesConstants::CURRENCY_BTC,
            'receiver_currency' => CurrenciesConstants::CURRENCY_BTC,
            'custom_id' => '2',
            'name' => 'TestChannel',
            'description' => '#2Channel'
        ];
    }
}
