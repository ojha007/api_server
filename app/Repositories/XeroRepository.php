<?php


namespace App\Repositories;


use App\Abstracts\Repository;
use Illuminate\Support\Facades\Cache;
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


    public function getAllTaxRates($where, $order)
    {
        return Cache::remember('_allTaxRates', 18000, function () use ($where, $order) {
            return $this->xeroClass->getTaxRates($this->xeroAuth->getTenantId(), $where, $order);
        });
    }

    public function getAccounts($where, $order)
    {
        return Cache::remember('_allAccounts', 18000, function () use ($where, $order) {
            return $this->xeroClass->getAccounts($this->xeroAuth->getTenantId(), null, $where, $order);
        });
    }


    public function getAllInvoices($order, $status, $page)
    {
        return Cache::remember('_allInvoices', 1800, function () use ($order, $status, $page) {
            return $this->xeroClass->getInvoices($this->xeroAuth->getTenantId(), null, null, $order, null, null, null, $status, $page, null, null, null, false);

        });
    }

    public function getInvoiceById($invoiceId)
    {
        return Cache::remember('_invoiceById-' . $invoiceId, 18000, function () use ($invoiceId) {
            return $this->xeroClass->getInvoice($this->xeroAuth->getTenantId(), $invoiceId);
        });
    }

    public function getContacts($where, $order, $page)
    {
        return Cache::remember('_allContacts', 18000, function () use ($where, $order, $page) {
            return $this->xeroClass->getContacts($this->xeroAuth->getTenantId(), null, $where, $order, null, $page, null, true);

        });
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
