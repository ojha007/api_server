<?php


namespace App\Http\Controllers;


use App\Http\Responses\Campaign\CreateResponse;
use App\Http\Responses\Campaign\IndexResponse;

class CampaignController extends Controller
{

    protected $routerPrefix = 'campaigns.';

    protected $viewPath = 'campaign.';

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(): IndexResponse
    {
        return new IndexResponse($this->viewPath);
    }

    public function create(): CreateResponse
    {
        return new CreateResponse($this->viewPath);
    }
}

