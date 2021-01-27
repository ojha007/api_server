<?php


namespace App\Http\Controllers;


use App\Http\Requests\EnquiryRequest;
use App\Http\Responses\Enquiry\DeleteResponse;
use App\Http\Responses\Enquiry\IndexResponse;
use App\Http\Responses\Enquiry\ShowResponse;
use App\Http\Responses\Enquiry\StoreResponse;
use App\Http\Responses\ErrorResponse;
use App\Http\Responses\SuccessResponse;
use App\Models\Enquiry;
use App\Repositories\EnquiryRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EnquiryController extends Controller
{

    /**
     * @var string
     */
    protected $baseRoute = 'enquiries.';
    /**
     * @var string
     */
    protected $viewPath = 'enquiry.';
    /**
     * @var Enquiry
     */
    protected $model;
    /**
     * @var EnquiryRepository
     */
    protected $repository;

    public function __construct()
    {
        $this->model = new Enquiry();
        $this->repository = new EnquiryRepository($this->model);
        $this->middleware('auth');
    }

    public function index(): IndexResponse
    {
        return new IndexResponse($this->viewPath);
    }

    public function store(EnquiryRequest $request): StoreResponse
    {
        return new StoreResponse($this->baseRoute);
    }

    public function show(Enquiry $enquiry): ShowResponse
    {
        return new ShowResponse($enquiry, $this->viewPath);
    }

    public function destroy(Enquiry $enquiry): DeleteResponse
    {
        return new DeleteResponse($enquiry, $this->baseRoute);
    }

    public function update($id, EnquiryRequest $request)
    {
        try {
            DB::beginTransaction();
            $attributes['enquiry'] = $request->except('pickup_address', 'delivery_address');
            $enquiry = $this->repository->update($id, $attributes['enquiry']);
            $a = ['enquiry_id' => $enquiry->id];
            $pickup_address = array_merge($request->get('pickup_address'), $a);
            $delivery_address = array_merge($request->get('delivery_address'), $a);
//            $this->repository->setOrUpdateAddress($pickup_address, Enquiry::PICKUP);
//            $this->repository->setOrUpdateAddress($delivery_address, Enquiry::DELIVERY);
            DB::commit();
            return new SuccessResponse(null);
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage() . '-' . $exception->getTraceAsString());
            return new ErrorResponse($exception);
        }
    }

    public function sendQuotations($id)
    {
        try {
            $enquiry = $this->repository->getById($id);
            return view($this->viewPath . 'quotations.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage() . '-' . $exception->getTraceAsString());
            return new ErrorResponse($exception);
        }

    }
}
