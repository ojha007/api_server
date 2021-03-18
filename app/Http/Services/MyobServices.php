<?php


namespace App\Http\Services;


use Illuminate\Support\Facades\Storage;

class MyobServices
{

    /**
     * @var string
     */
    protected $file;
    /**
     * @var string[]
     */
    protected $header;
    protected $access_token;

    public function __construct()
    {
        $token = Storage::exists(config('myob.token_path')) ? json_decode(Storage::get(config('myob.token_path'))) : null;
        $this->header = array(
            'Authorization: Bearer ' . ($token ? $token->access_token : null),
            'x-myobapi-key: ' . config('myob.api_key'),
            'x-myobapi-version: v2',
            'Accept: application/json',
            'Content-Type: application/json',
        );
    }

    public function refreshAccessToken($refresh_token)
    {

        $params = array(
            'client_id' => config('myob.api_key'),
            'client_secret' => config('myob.api_secret'),
            'refresh_token' => $refresh_token,
            'scope' => config('myob.scope'),
            'grant_type' => 'refresh_token',
            'redirect_uri' => config('myob.redirect_url')
        );

        $params = http_build_query($params);

        return ($this->getToken($params));
    }

    private function getToken($params)
    {

        $response = $this->getURL('https://secure.myob.com/oauth2/v1/authorize', $params);

        $response_json = json_decode($response);

        return ($response_json);
    }

    private function getURL($url, $params)
    {


        $session = curl_init($url);
        curl_setopt($session, CURLOPT_POST, true);
        curl_setopt($session, CURLOPT_POSTFIELDS, $params);
        curl_setopt($session, CURLOPT_HEADER, false);
        curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($session);
        curl_close($session);
        return ($response);
    }

    public function getAccessToken($access_code)
    {

        $params = array(
            'client_id' => config('myob.api_key'),
            'client_secret' => config('myob.api_secret'),
            'scope' => config('myob.api_scope'),
            'code' => $access_code,
            'redirect_uri' => config('myob.redirect_url'),
            'grant_type' => 'authorization_code',
        );
        $params = http_build_query($params);

        return ($this->getToken($params));

    }

    public function saveAccessToken($myob_tokens)
    {
        $disk = Storage::disk('local');
        if ($disk->exists(config('myob.token_path'))) {
            $disk->delete(config('myob.token_path'));
        }
        $disk->put(config('myob.token_path'), json_encode($myob_tokens));

    }


    public function getResponse($url)
    {
        $account = getDefaultAccount();
        if ($account) {
            $baseUrl = $account->Uri.''.$url;
            $session = curl_init($baseUrl);
            curl_setopt($session, CURLOPT_HTTPHEADER, $this->header);
            curl_setopt($session, CURLOPT_HEADER, false);
            curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($session);
            curl_close($session);
            return json_decode($response);
        }
        return null;
    }

    public function getAllMyobAccountRights()
    {
        $file = config('myob.accountRightPath');
        if (!Storage::disk('local')->exists($file)) {
            $session = curl_init(config('myob.account_right'));
            curl_setopt($session, CURLOPT_HTTPHEADER, $this->header);
            curl_setopt($session, CURLOPT_HEADER, false);
            curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($session);
            $data = json_decode($response);
            curl_close($session);
            Storage::disk('local')->put($file, json_encode($data));
        }
        return json_decode(Storage::get($file));
    }

}
