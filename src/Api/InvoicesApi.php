<?php

// Auto-generated file
// DO NOT EDIT

namespace Cryptopay\Api;

use Cryptopay\AbstractApi;

class InvoicesApi extends AbstractApi
{
    /**
     * List invoices
     *
     * @param null|array $params
     *
     * @throws \Cryptopay\Exceptions\RequestException
     * @return object
     */
    public function all(array $params = null) {
        return $this->request('GET', '/api/invoices', $params);
    }

    /**
     * Commit invoice recalculation
     *
     * @param string $invoiceId
     * @param string $recalculationId
     * @param null|array $params
     *
     * @throws \Cryptopay\Exceptions\RequestException
     * @return object
     */
    public function commitRecalculation(string $invoiceId, string $recalculationId, array $params = null) {
        $path = '/api/invoices/{invoice_id}/recalculations/{recalculation_id}/commit';
        $path = str_replace('{invoice_id}', rawurlencode($invoiceId), $path);
        $path = str_replace('{recalculation_id}', rawurlencode($recalculationId), $path);

        return $this->request('POST', $path, $params);
    }

    /**
     * Create an invoice
     *
     * @param null|array $params
     *
     * @throws \Cryptopay\Exceptions\RequestException
     * @return object
     */
    public function create(array $params = null) {
        return $this->request('POST', '/api/invoices', $params);
    }

    /**
     * Create invoice recalculation
     *
     * @param string $invoiceId
     * @param null|array $params
     *
     * @throws \Cryptopay\Exceptions\RequestException
     * @return object
     */
    public function createRecalculation(string $invoiceId, array $params = null) {
        $path = '/api/invoices/{invoice_id}/recalculations';
        $path = str_replace('{invoice_id}', rawurlencode($invoiceId), $path);

        return $this->request('POST', $path, $params);
    }

    /**
     * Create invoice refund
     *
     * @param string $invoiceId
     * @param null|array $params
     *
     * @throws \Cryptopay\Exceptions\RequestException
     * @return object
     */
    public function createRefund(string $invoiceId, array $params = null) {
        $path = '/api/invoices/{invoice_id}/refunds';
        $path = str_replace('{invoice_id}', rawurlencode($invoiceId), $path);

        return $this->request('POST', $path, $params);
    }

    /**
     * List invoice refunds
     *
     * @param string $invoiceId
     * @param null|array $params
     *
     * @throws \Cryptopay\Exceptions\RequestException
     * @return object
     */
    public function allRefunds(string $invoiceId, array $params = null) {
        $path = '/api/invoices/{invoice_id}/refunds';
        $path = str_replace('{invoice_id}', rawurlencode($invoiceId), $path);

        return $this->request('GET', $path, $params);
    }

    /**
     * Retrieve an invoice
     *
     * @param string $invoiceId
     * @param null|array $params
     *
     * @throws \Cryptopay\Exceptions\RequestException
     * @return object
     */
    public function retrieve(string $invoiceId, array $params = null) {
        $path = '/api/invoices/{invoice_id}';
        $path = str_replace('{invoice_id}', rawurlencode($invoiceId), $path);

        return $this->request('GET', $path, $params);
    }

    /**
     * Retrieve an invoice by custom_id
     *
     * @param string $customId
     * @param null|array $params
     *
     * @throws \Cryptopay\Exceptions\RequestException
     * @return object
     */
    public function retrieveByCustomId(string $customId, array $params = null) {
        $path = '/api/invoices/custom_id/{custom_id}';
        $path = str_replace('{custom_id}', rawurlencode($customId), $path);

        return $this->request('GET', $path, $params);
    }

}
