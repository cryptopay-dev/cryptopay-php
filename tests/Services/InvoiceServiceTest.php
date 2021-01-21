<?php

namespace Tests;

use Cryptopay\AbstractResponse;
use Cryptopay\Constants\CurrenciesConstants;
use Cryptopay\Exceptions\InvoiceException;
use Cryptopay\Exceptions\RequestException;
use Cryptopay\Exceptions\UuidException;
use Cryptopay\Service\InvoiceService;

class InvoiceServiceTest extends BaseTest
{
    public function testCantCreateInvoiceWithDuplicatedId()
    {
        $message = $this->getJsonFile('/data/common/duplicate_custom_id.json');

        $connector = $this->createConnectorWithGuzzleMock($message, AbstractResponse::HTTP_CONFLICT);
        $invoiceService = new InvoiceService($connector);

        $this->expectException(RequestException::class);
        $this->expectExceptionCode(AbstractResponse::HTTP_CONFLICT);
        $this->expectExceptionMessage($message);

        $invoiceService->create($this->generateData());
    }

    public function testShouldCreateInvoiceWithFilledData()
    {
        $message = $this->getJsonFile('/data/invoice/invoice_created.json');
        $connector = $this->createConnectorWithGuzzleMock($message, AbstractResponse::HTTP_OK);
        $invoiceService = new InvoiceService($connector);

        $response = $invoiceService->create($this->generateData());
        $this->assertNotNull($response);
    }

    public function testGetInvoice()
    {
        $message = $this->getJsonFile('/data/invoice/invoice_created.json');
        $connector = $this->createConnectorWithGuzzleMock($message, AbstractResponse::HTTP_OK);
        $invoiceService = new InvoiceService($connector);

        $response = $invoiceService->get("366fcd88-2d90-47b3-bdfb-5d3e3e8d8550");
        $this->assertNotNull($response);
    }

    public function testGetCustomInvoice()
    {
        $message = $this->getJsonFile('/data/invoice/invoice_created.json');
        $connector = $this->createConnectorWithGuzzleMock($message, AbstractResponse::HTTP_OK);
        $invoiceService = new InvoiceService($connector);

        $response = $invoiceService->getCustomInvoice("1");
        $this->assertNotNull($response);
    }

    public function testGetAll()
    {
        $message = $this->getJsonFile('/data/invoice/invoices_list.json');
        $connector = $this->createConnectorWithGuzzleMock($message, AbstractResponse::HTTP_OK);
        $invoiceService = new InvoiceService($connector);

        $response = $invoiceService->getAll();
        $this->assertNotNull($response);
        $this->assertCount(2, $response->data);
    }

    public function testGetAllWillNotWorkWithWrongStartingAfter()
    {
        $invoiceService = new InvoiceService($this->connector);

        $this->expectException(UuidException::class);
        $this->expectExceptionCode(AbstractResponse::HTTP_UNPROCESSABLE_ENTITY);
        $this->expectExceptionMessage('Not valid uuid format');
        $invoiceService->getAll("123");
    }

    /**
     * @return array
     */
    private function generateData(): array
    {
        return [
            'custom_id' => '1',
            'price_amount' => '0.001',
            'pay_currency' => CurrenciesConstants::CURRENCY_BTC,
            'price_currency' => CurrenciesConstants::CURRENCY_BTC
        ];
    }
}
