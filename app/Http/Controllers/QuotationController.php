<?php


namespace App\Http\Controllers;


use App\Http\Requests\QuotationRequest;
use App\Http\Responses\ErrorResponse;
use App\Http\Responses\Quotation\CreateResponse;
use App\Http\Responses\Quotation\IndexResponse;
use App\Http\Responses\Quotation\StoreResponse;
use App\Models\Quotation;
use App\Repositories\QuotationRepository;
use Illuminate\Support\Facades\DB;

class QuotationController extends Controller
{

    /**
     * @var string
     */
    protected $baseRoute = 'quotations.';

    protected $viewPath = 'quotations.';
    /**
     * @var QuotationRepository
     */
    protected $repository;

    public function __construct()
    {
        $this->repository = new QuotationRepository(new Quotation());
    }

    public function index($enquiry_id = null): IndexResponse
    {
        $quotations = $this->repository->getAll();
        return new IndexResponse($this->viewPath, $quotations,$enquiry_id);
    }

    public function create(): CreateResponse
    {
        return new CreateResponse($this->viewPath);
    }

    public function store(QuotationRequest $request)
    {
        try {
            DB::beginTransaction();
            $attributes = $request->validated();
            $this->repository->create($attributes);
            DB::commit();
            return new StoreResponse($this->baseRoute);
        } catch (\Exception $exception) {
            dd($exception);
            DB::rollBack();
            return new ErrorResponse($exception);
        }
    }


}
