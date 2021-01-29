<?php


namespace App\Http\Controllers;


use App\Http\Requests\EnquiryRequest;
use App\Http\Requests\SendQuotationsRequest;
use App\Http\Responses\Enquiry\CreateResponse;
use App\Http\Responses\Enquiry\DeleteResponse;
use App\Http\Responses\Enquiry\IndexResponse;
use App\Http\Responses\Enquiry\ShowResponse;
use App\Http\Responses\Enquiry\StoreResponse;
use App\Http\Responses\ErrorResponse;
use App\Http\Responses\SuccessResponse;
use App\Models\Enquiry;
use App\Models\Quotation;
use App\Models\User;
use App\Notifications\EnquiryReceived;
use App\Notifications\SendQuotation;
use App\Repositories\EnquiryRepository;
use App\Repositories\QuotationRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

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

    public function store(EnquiryRequest $request)
    {
        try {
            DB::beginTransaction();
            $attributes = $request->validated();
            $this->repository->create($attributes);
            $user = User::find($attributes['user_id']);
            DB::commit();
            Notification::send($user, new EnquiryReceived());
            return new StoreResponse($this->baseRoute);
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage() . '-' . $exception->getTraceAsString());
            return new ErrorResponse($exception);
        }

    }

    public function show($id): ShowResponse
    {
        $enquiry = $this->repository->getById($id);
        return new ShowResponse($enquiry, $this->viewPath);
    }

    public function create(): CreateResponse
    {
        return new CreateResponse($this->viewPath);
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
            DB::commit();
            return new SuccessResponse(null);
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage() . '-' . $exception->getTraceAsString());
            return new ErrorResponse($exception);
        }
    }

    public function sendQuotations(SendQuotationsRequest $request)
    {
        try {
            $enquiry = $this->repository->getByIdWith($request->get('enquiry_id'), 'user');
            $quotations = (new QuotationRepository(new Quotation()))->getById($request->get('quotation_id'));
            Notification::send($enquiry->user, new SendQuotation($quotations, $enquiry));
            return new SuccessResponse(null);
        } catch (Exception $exception) {
            return new ErrorResponse($exception);
        }
    }

    public function confirmed($id)
    {
        try {

            dd($id);
        } catch (Exception $exception) {
            return new ErrorResponse($exception);
        }
    }
}
