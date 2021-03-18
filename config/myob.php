<?php

return [
    'api_key' => env('MYOB_API_KEY'),
    'api_secret' => env('MYOB_API_SECRET'),
    'redirect_url' => env('MYOB_REDIRECT_URL'),
    'api_url' => env('MYOB_API_URL'),
    'api_scope' => 'CompanyFile la.global',
    'account_right' => 'https://api.myob.com/accountright',
    'credentials' => env('MYOB_USERNAME') . ':' . env("MYOB_PASSWORD"),
    'token_path' => 'myob/tokens.json',
    'accountRightPath' => 'myob/accountRight.json',
    'companyInfo' => 'myob/companyInfo.json',
    'defaultAccount' => 'myob/defaultAccount.json'

];
