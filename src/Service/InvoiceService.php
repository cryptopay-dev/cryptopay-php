<?php

namespace Cryptopay\Service;

use Cryptopay\Constants\Methods;
use Cryptopay\Exceptions\RequestException;
use Cryptopay\Constants\ApiMethods;
use Cryptopay\Exceptions\UuidException;

class InvoiceService extends AbstractService
{
    /**
     * @param array $invoiceData
     * @return object
     * @throws RequestException
     */
    public function create(array $invoiceData): object
    {
        return $this->connector->request(
            Methods::POST,
            ApiMethods::INVOICES,
            $invoiceData
        );
    }

    /**
     * @param string $invoiceNumber
     * @return object
     * @throws RequestException
     * @throws UuidException
     */
    public function get(string $invoiceNumber)
    {
        $this->checkValidUuid($invoiceNumber);
        return $this->connector->request(
            Methods::GET,
            sprintf(ApiMethods::INVOICE_DETAILS, $invoiceNumber)
        );
    }

    /**
     * @param string $customId
     * @return object
     * @throws RequestException
     */
    public function getCustomInvoice(string $customId): object
    {
        return $this->connector->request(
            Methods::GET,
            sprintf(ApiMethods::INVOICE_CUSTOM, $customId),
        );
    }

    /**
     * @param string $startingAfter
     * @return object
     * @throws RequestException
     * @throws UuidException
     */
    public function getAll(string $startingAfter = null): object
    {
        $this->checkValidUuidOrNull($startingAfter);
        return $this->connector->request(
            Methods::GET,
            ApiMethods::INVOICES,
            $startingAfter ? ['starting_after' => $startingAfter] : []
        );
    }
}
