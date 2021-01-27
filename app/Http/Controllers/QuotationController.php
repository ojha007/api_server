<?php


namespace App\Http\Controllers;


use App\Http\Responses\Quotation\CreateResponse;
use App\Http\Responses\Quotation\IndexResponse;

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

    public function index($enquiry_id = null): IndexResponse
    {

        return new IndexResponse($this->viewPath, $enquiry_id);
    }

    public function create(): CreateResponse
    {
        return new CreateResponse($this->viewPath);
    }


}
