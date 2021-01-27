<?php


namespace App\Http\Controllers;


use App\Http\Responses\Quotation\CreateResponse;

class QuotationController extends Controller
{

    /**
     * @var string
     */
    protected $baseRoute = 'quotations.';

    protected $viewPath = 'quotations.';

    public function __construct()
    {
    }

    public function index()
    {

    }

    public function create(): CreateResponse
    {
        return new CreateResponse($this->viewPath);
    }


}
