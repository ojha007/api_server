<?php


namespace App\Repositories;


use App\Abstracts\Repository;
use Webfox\Xero\OauthCredentialManager;
use XeroAPI\XeroPHP\Models\Accounting\Payment;


class XeroRepository extends Repository
{
    /**
     * @var OauthCredentialManager
     */
    protected $xeroAuth;

    protected $xeroClass;

    public function __construct(OauthCredentialManager $xeroCredentials)
    {
        $this->xeroAuth = $xeroCredentials;
        $this->xeroClass = resolve(\XeroAPI\XeroPHP\Api\AccountingApi::class);
    }

    public function getAccounts($where, $order)
    {
        return $this->xeroClass->getAccounts($this->xeroAuth->getTenantId(), null, $where, $order);
    }

    public function createPayment($invoiceId, array $attributes)
    {
        $payment = new Payment();
        $payment->setDate($attributes['date']);
        $payment->setAmount($attributes['amount']);
        $payment->setAccount($attributes['account']);
        $payment->setInvoiceNumber($attributes['invoice_no']);
        $payment->setBankAccountNumber($attributes['account_no']);
        $payment->setReference($attributes['reference']);
        $this->xeroClass->createPaymentRequest($this->xeroAuth->getTenantId(), $invoiceId, $payment);
    }
}
