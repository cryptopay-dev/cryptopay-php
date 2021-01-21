<?php

namespace Cryptopay;

use Cryptopay\Config\ConfigInterface;
use Cryptopay\Connector\Connector;
use Cryptopay\Exceptions\CallbackException;
use Cryptopay\Exceptions\ForbiddenException;
use Cryptopay\Exceptions\UuidException;
use Cryptopay\Service\AccountsService;
use Cryptopay\Service\CallbackService;
use Cryptopay\Service\ChannelService;
use Cryptopay\Service\CoinWithdrawalService;
use Cryptopay\Service\InvoiceService;
use Cryptopay\Service\RateService;
use Cryptopay\Exceptions\RequestException;
use Cryptopay\Service\RiskService;
use Cryptopay\Service\TransactionService;

class Cryptopay
{
    private InvoiceService $invoiceService;
    private ChannelService $channelService;
    private CoinWithdrawalService $coinWithdrawalService;
    private CallbackService $callbackService;
    private TransactionService $transactionService;
    private AccountsService $accountService;
    private RateService $rateService;
    private RiskService $riskService;

    public function __construct(ConfigInterface $config)
    {
        $connector = new Connector($config);

        $this->accountService = new AccountsService($connector);
        $this->callbackService = new CallbackService($config->getCallbackSecret());
        $this->channelService = new ChannelService($connector);
        $this->coinWithdrawalService = new CoinWithdrawalService($connector);
        $this->invoiceService = new InvoiceService($connector);
        $this->rateService = new RateService($connector);
        $this->riskService = new RiskService($connector);
        $this->transactionService = new TransactionService($connector);
    }

    /**
     * @param array $invoiceData
     * @return object
     * @throws RequestException
     */
    public function createInvoice(array $invoiceData): object
    {
        return $this->invoiceService->create($invoiceData);
    }

    /**
     * @param string $staringAfter
     * @return object
     * @throws RequestException
     * @throws UuidException
     */
    public function getInvoices(string $staringAfter = null): object
    {
        return $this->invoiceService->getAll($staringAfter);
    }

    /**
     * @param string $invoiceId
     * @return object
     * @throws RequestException
     * @throws UuidException
     */
    public function getInvoice(string $invoiceId): object
    {
        return $this->invoiceService->get($invoiceId);
    }

    /**
     * @param string $customId
     * @return object
     * @throws RequestException
     */
    public function getCustomInvoice(string $customId): object
    {
        return $this->invoiceService->getCustomInvoice($customId);
    }

    /**
     * @param array $channelData
     * @return mixed
     * @throws Exceptions\ChannelException
     * @throws RequestException
     */
    public function createChannel(array $channelData): object
    {
        return $this->channelService->create($channelData);
    }

    /**
     * @param string $channelId
     * @param array $channelData
     * @return mixed
     * @throws RequestException
     * @throws UuidException
     */
    public function updateChannel(string $channelId, array $channelData): object
    {
        return $this->channelService->update($channelId, $channelData);
    }

    /**
     * @param string $staringAfter
     * @return object
     * @throws RequestException
     * @throws UuidException
     */
    public function getChannels(string $staringAfter = null): object
    {
        return $this->channelService->getAll($staringAfter);
    }

    /**
     * @param string $channelId
     * @return object
     * @throws RequestException
     * @throws UuidException
     */
    public function getChannel(string $channelId): object
    {
        return $this->channelService->get($channelId);
    }

    /**
     * @param string $customId
     * @return object
     * @throws RequestException
     */
    public function getCustomChannel(string $customId): object
    {
        return $this->channelService->getCustomChannel($customId);
    }

    /**
     * @param string $channelId
     * @return object
     * @throws RequestException
     * @throws UuidException
     */
    public function getChannelPayments(string $channelId): object
    {
        return $this->channelService->getChannelPayments($channelId);
    }

    /**
     * @param string $channelId
     * @param string $paymentId
     * @return object
     * @throws RequestException
     * @throws UuidException
     */
    public function getChannelPayment(string $channelId, string $paymentId): object
    {
        return $this->channelService->getChannelPayment($channelId, $paymentId);
    }

    /**
     * @param array $data
     * @return object
     * @throws CoinWithdrawalException
     * @throws RequestException
     */
    public function createCoinWithdrawal(array $data): object
    {
        return $this->coinWithdrawalService->create($data);
    }

    /**
     * @param string $id
     * @return object
     * @throws RequestException
     * @throws UuidException
     */
    public function commitCoinWithdrawal(string $id): object
    {
        return $this->coinWithdrawalService->commit($id);
    }

    /**
     * @param string $staringAfter
     * @return object
     * @throws RequestException
     * @throws UuidException
     */
    public function getCoinWithdrawals(string $staringAfter = null): object
    {
        return $this->coinWithdrawalService->getAll($staringAfter);
    }

    /**
     * @param string $id
     * @return object
     * @throws RequestException
     * @throws UuidException
     */
    public function getCoinWithdrawal(string $id): object
    {
        return $this->coinWithdrawalService->get($id);
    }

    /**
     * @param int $customId
     * @return object
     * @throws RequestException
     */
    public function getCustomCoinWithdrawal(int $customId): object
    {
        return $this->coinWithdrawalService->getCustom($customId);
    }

    /**
     * @param array $data
     * @return object
     * @throws RequestException
     * @throws UuidException
     */
    public function getTransactions(array $data = [])
    {
        return $this->transactionService->getAll($data);
    }

    /**
     * @return object
     * @throws RequestException
     */
    public function getAccounts()
    {
        return $this->accountService->getAll();
    }

    /**
     * @param string $accountId
     * @param string|null $startingAfter
     * @return object
     * @throws RequestException
     * @throws UuidException
     */
    public function getAccountTransactions(string $accountId, ?string $startingAfter = null): object
    {
        return $this->accountService->getAccountTransactions($accountId, $startingAfter);
    }

    /**
     * @param array $request
     * @return object
     * @throws RiskException
     * @throws RequestException
     */
    public function getRisks(array $request): object
    {
        $this->riskService->get($request);
    }

    /**
     * @return object
     * @throws RequestException
     */
    public function getRates(): object
    {
        return $this->rateService->getRates();
    }

    /**
     * @param string $pair
     * @return object
     * @throws RequestException
     */
    public function getRatesPair(string $pair): object
    {
        return $this->rateService->getRatesPair($pair);
    }

    /**
     * @param string $callbackBodyJson
     * @param array $headers
     * @return string
     * @throws ForbiddenException
     * @throws CallbackException
     */
    public function validateCallback(string $callbackBodyJson, array $headers)
    {
        return $this->callbackService->validateCallback($callbackBodyJson, $headers);
    }
}
