<?php


namespace App\Http\Controllers\Api;


class CampaignController extends \App\Http\Controllers\CampaignController
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }
}
