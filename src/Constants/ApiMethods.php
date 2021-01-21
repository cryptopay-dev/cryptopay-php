<?php

namespace Cryptopay\Constants;

class ApiMethods
{
    public const INVOICES = '/api/invoices';
    public const INVOICE_DETAILS = '/api/invoices/%s';
    public const INVOICE_CUSTOM = '/api/invoices/custom_id/%s';

    public const CHANNELS = '/api/channels';
    public const CHANNEL_DETAILS = '/api/channels/%s';
    public const CHANNEL_CUSTOM = '/api/channels/custom_id/%s';

    public const CHANNEL_PAYMENTS = '/api/channels/%s/payments';
    public const CHANNEL_PAYMENT_DETAILS = '/api/channels/%s/payments/%s';

    public const WITHDRAWALS = '/api/coin_withdrawals';
    public const WITHDRAWAL_COMMIT = '/api/coin_withdrawals/%s/commit';
    public const WITHDRAWAL_DETAILS = '/api/coin_withdrawals/%s';
    public const WITHDRAWAL_CUSTOM = '/api/coin_withdrawals/custom_id/%s';

    public const TRANSACTIONS = '/api/transactions';

    public const RATES = '/api/rates';

    public const ACCOUNTS = '/api/accounts';
    public const ACCOUNT_TRANSACTIONS = '/api/accounts/%s/transactions';

    public const RISKS = '/api/risks/score';
}
