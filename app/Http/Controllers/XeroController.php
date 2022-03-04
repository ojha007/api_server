<?php


namespace App\Http\Controllers;


use App\Http\Responses\ErrorResponse;
use App\Http\Responses\SuccessResponse;
use Illuminate\Http\Request;
use League\OAuth2\Client\Token\AccessToken;
use Webfox\Xero\OauthCredentialManager;


class XeroController extends Controller
{

    public function logout(OauthCredentialManager $xeroCredentials)
    {
        $a = $xeroCredentials->getAccessToken();
        dd($a);
    }

    protected $basePath = 'xero.';

    public function index(Request $request, OauthCredentialManager $xeroCredentials)
    {
        try {
            if ($xeroCredentials->exists()) {
                $xero = resolve(\XeroAPI\XeroPHP\Api\AccountingApi::class);
                $organisationName = $xero->getOrganisations($xeroCredentials->getTenantId())->getOrganisations()[0]->getName();
                $user = $xeroCredentials->getUser();
                $username = "{$user['given_name']} {$user['family_name']} ({$user['username']})";
                $tokens = [
                    'refresh_token' => $xeroCredentials->getRefreshToken(),
                    'access_token' => $xeroCredentials->getAccessToken(),
                    'id_token' => $xeroCredentials->getData()['id_token'],
                    'expires' => $xeroCredentials->getExpires(),
                    'tenant_id' => $xeroCredentials->getTenantId()
                ];
                $token = new AccessToken($tokens);
                $xeroCredentials->store($token);
            }
        } catch (\throwable $e) {
            $error = $e->getMessage();
        }
        return view($this->basePath . '.index', [
            'connected' => $xeroCredentials->exists(),
            'error' => $error ?? null,
            'organisationName' => $organisationName ?? null,
            'username' => $username ?? null
        ]);
    }

    public function invoices(Request $request, OauthCredentialManager $xeroCredentials)
    {
        try {
            if ($xeroCredentials->exists()) {
                $page = $request->get('page') ?? 1;
                $order = $request->get('order');
                $xero = resolve(\XeroAPI\XeroPHP\Api\AccountingApi::class);
                $invoices = $xero->getInvoices($xeroCredentials->getTenantId(), null, null, $order, null, null, null, null, $page);
                return new SuccessResponse($invoices);
            }
        } catch (\throwable $e) {
            return new ErrorResponse($e);
        }
    }

    public function show($invoiceId)
    {
        return view($this->basePath . 'show', compact('invoiceId'));
    }

    public function getInvoice(Request $request, OauthCredentialManager $xeroCredentials)
    {
        try {
            if ($xeroCredentials->exists()) {
                $xero = resolve(\XeroAPI\XeroPHP\Api\AccountingApi::class);
                $invoice = $xero->getInvoice($xeroCredentials->getTenantId(), $request->get('invoiceId'));
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


    public function getContacts(Request $request, OauthCredentialManager $xeroCredentials)
    {
        try {
            if ($xeroCredentials->exists()) {
                $page = $request->get('page') ?? 1;
                $order = $request->get('order') ?? 'Name DESC';
                $where = $request->get('where');
                $xero = resolve(\XeroAPI\XeroPHP\Api\AccountingApi::class);
                $contacts = $xero->getContacts($xeroCredentials->getTenantId(), null, null, $order,null,$page);
                return new SuccessResponse($contacts);
            }
        } catch (\throwable $e) {

            return new ErrorResponse($e);
        }
    }

    public function TaxRates(Request $request, OauthCredentialManager $xeroCredentials)
    {
        try {
            if ($xeroCredentials->exists()) {
                $order = $request->get('order') ?? 'Name DESC';
                $where = $request->get('where');
                $xero = resolve(\XeroAPI\XeroPHP\Api\AccountingApi::class);
                $contacts = $xero->getTaxRates($xeroCredentials->getTenantId(), $where, $order);
                return new SuccessResponse($contacts);
            }
        } catch (\throwable $e) {

            return new ErrorResponse($e);
        }
    }

    public function getAccounts(Request $request, OauthCredentialManager $xeroCredentials)
    {
        try {
            if ($xeroCredentials->exists()) {
                $order = $request->get('order') ;
                $where = $request->get('where');
                $xero = resolve(\XeroAPI\XeroPHP\Api\AccountingApi::class);
                $accounts = $xero->getAccounts($xeroCredentials->getTenantId(), $where, $order);
                return new SuccessResponse($accounts);
            }
        } catch (\throwable $e) {
            return new ErrorResponse($e);
        }
    }
}
