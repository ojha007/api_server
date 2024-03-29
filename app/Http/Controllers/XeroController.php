<?php


namespace App\Http\Controllers;


use App\Http\Responses\ErrorResponse;
use App\Http\Responses\SuccessResponse;
use App\Repositories\XeroRepository;
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
    /**
     * @var XeroRepository
     */
    protected $repository;

    public function __construct(OauthCredentialManager $xeroCredentials)
    {
        $this->xeroAuth = $xeroCredentials;
        $this->xeroClass = resolve(\XeroAPI\XeroPHP\Api\AccountingApi::class);
        $this->repository = new XeroRepository($xeroCredentials);
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
                $invoices = $this->repository->getAllInvoices($order, $status, $page);
                return new SuccessResponse($invoices);
            }
        } catch (\throwable $e) {
            return new ErrorResponse($e);
        }
        return redirect()->back()->with('failed', 'Oops! Something went wrong');
    }

    public function show($invoiceId)
    {
        try {
            if ($this->xeroAuth->exists()) {
                $invoices = $this->repository->getInvoiceById($invoiceId);
                return view($this->basePath . 'show', compact('invoices'));
            }
        } catch (\Exception $e) {
            return new ErrorResponse($e);
        }
        return redirect()->back()->with('failed', 'Oops! Something went wrong');

    }

    public function getInvoice(Request $request)
    {
        try {
            if ($this->xeroAuth->exists()) {
                $invoice = $this->repository->getInvoiceById($request->get('invoiceId'));
                return new SuccessResponse($invoice);
            }
        } catch (\throwable $e) {
            return new ErrorResponse($e);
        }
        return redirect()->back()->with('failed', 'Oops! Something went wrong');
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
                $contacts = $this->repository->getContacts($where, $order, $page);
                return new SuccessResponse($contacts);
            }
        } catch (\throwable $e) {
            return new ErrorResponse($e);
        }
        return redirect()->back()->with('failed', 'Oops! Something went wrong');
    }

    public function TaxRates(Request $request)
    {
        try {
            if ($this->xeroAuth->exists()) {
                $order = $request->get('order');
                $where = $request->get('where');
                $taxRates = $this->repository->getAllTaxRates($where, $order);
                return new SuccessResponse($taxRates);
            }
        } catch (\throwable $e) {
            return new ErrorResponse($e);
        }
        return redirect()->back()->with('failed', 'Oops! Something went wrong');
    }

    public function getAccounts(Request $request)
    {
        try {
            if ($this->xeroAuth->exists()) {
                $order = $request->get('order');
                $where = $request->get('where');
                $accounts = $this->repository->getAccounts($where, $order);
                return new SuccessResponse($accounts);
            }
        } catch (\throwable $e) {
            return new ErrorResponse($e);
        }
        return redirect()->back()->with('failed', 'Oops! Something went wrong');
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
        return redirect()->back()->with('failed', 'Oops! Something went wrong');
    }

    public function downloadPdf($invoiceId)
    {
        try {
            if ($this->xeroAuth->exists()) {
                $pdf = $this->xeroClass->getInvoiceAsPdf($this->xeroAuth->getTenantId(), $invoiceId);
                $myFile = $invoiceId . ".pdf";
                return response()->download($pdf, $myFile, ['Content-Type: application/pdf']);
            }
        } catch (\Exception $exception) {
            return new ErrorResponse($exception);
        }
        return redirect()->back()->with('failed', 'Oops! Something went wrong');
    }

    public function emailInvoice($invoiceId)
    {
        $status = \request()->get('status');
        try {
            if ($this->xeroAuth->exists()) {
                $this->xeroClass->emailInvoice($this->xeroAuth->getTenantId(), $invoiceId, $status);
                return new SuccessResponse([], 'Email Send successfully');
            }
        } catch (\Exception $exception) {
            return new ErrorResponse($exception);
        }
        return redirect()->back()->with('failed', 'Oops! Something went wrong');
    }


    public function payment($invoiceId)
    {

        $accounts = [];
        $data = $this->repository->getAccounts(null, null);
        if ($data && $data->getAccounts()) {
            $allAccounts = $data->getAccounts();
            for ($i = 0; $i <= count($allAccounts) - 1; $i++) {
                $accounts[$allAccounts[$i]['account_id']] = $allAccounts[$i]['name'];
            }
        }
        return view($this->basePath . 'payment', compact('invoiceId', 'accounts'));
    }

    public function invoicePayment(Request $request, $invoiceId)
    {
        try {
            if ($this->xeroAuth->exists()) {
                $this->repository->createPayment($invoiceId, $request->all());
                return new SuccessResponse([], 'Payment successfully completed');
            }
        } catch (\Exception $exception) {
            return new ErrorResponse($exception);
        }
        return redirect()->back()->with('failed', 'Oops! Something went wrong');
    }
}
