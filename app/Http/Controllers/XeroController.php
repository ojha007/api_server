<?php


namespace App\Http\Controllers;


use App\Http\Responses\ErrorResponse;
use App\Http\Responses\SuccessResponse;
use Illuminate\Http\Request;
use League\OAuth2\Client\Token\AccessToken;
use Webfox\Xero\OauthCredentialManager;
use XeroAPI\XeroPHP\Models\Accounting\CurrencyCode;
use XeroAPI\XeroPHP\Models\Accounting\Invoice;
use XeroAPI\XeroPHP\Models\Accounting\Invoices;
use XeroAPI\XeroPHP\Models\Accounting\LineItem;


class XeroController extends Controller
{

    public $xeroClass;
    public $xeroAuth;

    public function __construct(OauthCredentialManager $xeroCredentials)
    {
        $this->xeroAuth = $xeroCredentials;
        $this->xeroClass = resolve(\XeroAPI\XeroPHP\Api\AccountingApi::class);
    }

    public function logout(OauthCredentialManager $xeroCredentials)
    {
        $a = $xeroCredentials->getAccessToken();
        dd($a);
    }

    protected $basePath = 'xero.';

    public function index(Request $request)
    {
        try {
            if ($this->xeroAuth->exists()) {
                $organisationName = $this->xeroClass->getOrganisations($this->xeroAuth->getTenantId())->getOrganisations()[0]->getName();
                $user = $this->xeroAuth->getUser();
                $username = "{$user['given_name']} {$user['family_name']} ({$user['username']})";
                $tokens = [
                    'refresh_token' => $this->xeroAuth->getRefreshToken(),
                    'access_token' => $this->xeroAuth->getAccessToken(),
                    'id_token' => $this->xeroAuth->getData()['id_token'],
                    'expires' => $this->xeroAuth->getExpires(),
                    'tenant_id' => $this->xeroAuth->getTenantId()
                ];
                $token = new AccessToken($tokens);
                $this->xeroAuth->store($token);
            }
        } catch (\throwable $e) {
            $error = $e->getMessage();
        }
        return view($this->basePath . '.index', [
            'connected' => $this->xeroAuth->exists(),
            'error' => $error ?? null,
            'organisationName' => $organisationName ?? null,
            'username' => $username ?? null
        ]);
    }

    public function invoices(Request $request)
    {
        try {
            if ($this->xeroAuth->exists()) {
                $page = $request->get('page') ?? 1;
                $order = $request->get('order') ?? 'InvoiceNumber DESC';
                $status = $request->get('invoiceStatus');
                $invoices = $this->xeroClass->getInvoices($this->xeroAuth->getTenantId(), null, null, $order, null, null, null, $status, $page, null, null, null, false);
                return new SuccessResponse($invoices);
            }
        } catch (\throwable $e) {
            return new ErrorResponse($e);
        }
    }

    public function show($invoiceId)
    {
        try {
            if ($this->xeroAuth->exists()) {
                $invoices = $this->xeroClass->getInvoice($this->xeroAuth->getTenantId(), $invoiceId);
                return view($this->basePath . 'show', compact('invoices'));
            }
        } catch (\Exception $e) {
            return new ErrorResponse($e);
        }

    }

    public function getInvoice(Request $request)
    {
        try {
            if ($this->xeroAuth->exists()) {
                $invoice = $this->xeroClass->getInvoice($this->xeroAuth->getTenantId(), $request->get('invoiceId'));

                return new SuccessResponse($invoice);
            }
        } catch (\throwable $e) {
            return new ErrorResponse($e);
        }
    }

    public function create()
    {
        return view($this->basePath . 'create');
    }


    public function getContacts(Request $request)
    {
        try {
            if ($this->xeroAuth->exists()) {
                $page = $request->get('page');
                $order = $request->get('order');
                $where = $request->get('where');
                $contacts = $this->xeroClass->getContacts($this->xeroAuth->getTenantId(), null, $where, $order, null, $page, null, true);
                return new SuccessResponse($contacts);
            }
        } catch (\throwable $e) {
            return new ErrorResponse($e);
        }
    }

    public function TaxRates(Request $request)
    {
        try {
            if ($this->xeroAuth->exists()) {
                $order = $request->get('order');
                $where = $request->get('where');
                $contacts = $this->xeroClass->getTaxRates($this->xeroAuth->getTenantId(), $where, $order);
                return new SuccessResponse($contacts);
            }
        } catch (\throwable $e) {
            return new ErrorResponse($e);
        }
    }

    public function getAccounts(Request $request)
    {
        try {
            if ($this->xeroAuth->exists()) {
                $order = $request->get('order');
                $where = $request->get('where');
                $accounts = $this->xeroClass->getAccounts($this->xeroAuth->getTenantId(), null, $where, $order);
                return new SuccessResponse($accounts);
            }
        } catch (\throwable $e) {
            return new ErrorResponse($e);
        }
    }

    public function saveInvoice(Request $request)
    {
        try {
            if ($this->xeroAuth->exists()) {
                $attributes = $request->toArray();
                $invoices = [];
                for ($i = 0; $i < count($attributes); $i++) {
                    $lineItems = [];
                    $LineItems = $attributes['Invoices']['LineItems'] ?? [];
                    for ($j = 0; $j < count($LineItems); $j++) {
                        $lineItem = new LineItem();
                        $lineItem->setQuantity($LineItems[$j]['Quantity']);
                        $lineItem->setUnitAmount($LineItems[$j]['UnitAmount']);
                        $lineItem->setDescription($LineItems[$j]['Description']);
                        $lineItem->setTaxType($LineItems[$j]['TaxType']);
                        $lineItem->setAccountCode($LineItems[$j]['AccountCode']);
                        $lineItems[$j] = $lineItem;
                    }
                    $xeroInvoice = new Invoice();
                    $xeroInvoice->setType(Invoice::TYPE_ACCREC);
                    $xeroInvoice->setContact($attributes['Invoices']['Contact']);
                    $xeroInvoice->setReference($attributes['Invoices']['Reference']);
                    $xeroInvoice->setLineItems($lineItems);
                    $xeroInvoice->setCurrencyCode(CurrencyCode::AUD);
                    $xeroInvoice->setDueDate(date('Y-m-d', strtotime($attributes['Invoices']['DueDate'])));
                    $xeroInvoice->setDate(date('Y-m-d', strtotime($attributes['Invoices']['Date'])));
                    $invoices[$i] = $xeroInvoice;
                }
                $invoice = $this->xeroClass->createInvoices($this->xeroAuth->getTenantId(), new Invoices(['invoices' => $invoices]));
                $message = "New Invoice Created Successfully";
                return new SuccessResponse($invoice, $message);
            }
        } catch (\throwable $e) {
            return new ErrorResponse($e);
        }
    }

    public function downloadPdf($invoiceId)
    {
        try {
            if ($this->xeroAuth->exists()) {
                $pdf = $this->xeroClass->getInvoiceAsPdf($this->xeroAuth->getTenantId(), $invoiceId);
                $myFile = $invoiceId . ".pdf";
                response()->download($pdf, $myFile, ['Content-Type: application/pdf']);
                return new SuccessResponse([], 'Pdf downloaded.');
            }
        } catch (\Exception $exception) {
            return new ErrorResponse($exception);
        }
    }

    public function emailInvoice($invoiceId)
    {
        try {
            if ($this->xeroAuth->exists()) {
                $email = $this->xeroClass->emailInvoice($this->xeroAuth->getTenantId(), $invoiceId,['ACTIVE']);
            }
            return new SuccessResponse([], 'Email Send successfully');
        } catch (\Exception $exception) {

        }
    }
}
