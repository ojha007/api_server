<?php


namespace App\Http\Controllers;


use App\Http\Services\MyobServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InvoiceController extends Controller
{
    protected $basePath = 'invoices.';

    public function index()
    {
        $url = null;
        $invoices = null;
        $accountRights = null;
        if (!Storage::exists(config('myob.token_path'))) {
            $url = 'https://secure.myob.com/oauth2/account/authorize';
            $url .= '?client_id=' . config('myob.api_key');
            $url .= '&redirect_uri=' . urlencode(config('myob.redirect_url'));
            $url .= '&response_type=code';
            $url .= '&client_secret=' . config('myob.api_secret');
            $url .= '&scope=' . config('myob.api_scope');
        } else {
            $accountRights = $this->getAllCompanyInfo();
        }
        if (request()->has('selected') && !Storage::disk('local')->exists(config('myob.defaultAccount'))) {
            $selected = request()->get('selected');
            $this->setSelectAccountRights($selected);
        }
        $invoices = (new MyobServices())->getResponse('/Sale/Invoice');
        return view($this->basePath . 'index', compact('url', 'accountRights', 'invoices'));
    }

    protected function getAllCompanyInfo()
    {
        $myobServices = new MyobServices();
        return $myobServices->getAllMyobAccountRights();

    }

    public function setSelectAccountRights($selected): void
    {
        $acc = json_decode(Storage::get(config('myob.accountRightPath')));
        if ($acc[$selected]) {
            Storage::disk('local')->put(config('myob.defaultAccount'), json_encode($acc[$selected]));
        }
    }

    public function setTokenAfterCallback(Request $request): \Illuminate\Http\RedirectResponse
    {

        $myobServices = new MyobServices();
        $success = 'Your account is successfully linked with MYOB account';
        if ($request->get('code')) {
            $oauth_tokens = $myobServices->getAccessToken($request->get('code'));
            if (isset($oauth_tokens) && !isset($oauth_tokens->error)) {
                $myobServices->saveAccessToken($oauth_tokens);
                session()->flash('success', $success);
            } else
                session()->flash('error', 'Sorry Your key is not valid');
        }
        return redirect()
            ->route('invoices.index');
    }

    public function refreshToken()
    {
        $success = 'Your account is successfully linked with MYOB account';

        $myobServices = new MyobServices();
        if (Storage::disk('local')->exists(config('myob.token_path'))) {
            $expiry_time = time();
            $old_tokens = json_decode(Storage::get(config_path('myob.token_paths')));
            if ($expiry_time > $old_tokens->expires_in) {
                $oauth_tokens = $myobServices->refreshAccessToken($old_tokens->refresh_token);
                if (isset($oauth_tokens) && !isset($oauth_tokens->error)) {
                    $myobServices->saveAccessToken($oauth_tokens);
                    session()->flash('success', $success);
                } else
                    session()->flash('error', 'sorry. Your key is not valid');

            }
        }
    }


}
