<?php


namespace App\Http\Controllers\Api;


use App\Http\Collection\EnquiryCollection;
use App\Http\Controllers\Controller;
use App\Http\Requests\EnquiryRequest;
use App\Http\Responses\ErrorResponse;
use App\Http\Responses\SuccessResponse;
use App\Models\Enquiry;
use App\Repositories\EnquiryRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EnquiryController extends Controller
{

    /**
     * @var Enquiry
     */
    protected $model;
    /**
     * @var EnquiryRepository
     */
    protected $repository;

    /**
     * EnquiryController constructor.
     */

    public function __construct()
    {
        $this->model = new Enquiry();
        $this->repository = new EnquiryRepository($this->model);
    }

    /**
     * @return SuccessResponse
     */
    public function index(): SuccessResponse
    {
        try {
            $enquiries = $this->repository->getAll();
            return new SuccessResponse($enquiries);
        } catch (\Exception $exception) {
            dd($exception);
            Log::error($exception->getMessage() . '-' . $exception->getTraceAsString());
            return new ErrorResponse($exception);
        }

    }

    public function store(EnquiryRequest $request)
    {
        try {
            DB::beginTransaction();
            $attributes['enquiry'] = $request->except('pickup_address', 'delivery_address');
            $enquiry = $this->repository->create($attributes['enquiry']);
            $a = ['enquiry_id' => $enquiry->id];
            $pickup_address = array_merge($request->get('pickup_address'), $a);
            $delivery_address = array_merge($request->get('delivery_address'), $a);
            $this->repository->setAddress($pickup_address, Enquiry::PICKUP);
            $this->repository->setAddress($delivery_address, Enquiry::DELIVERY);
            DB::commit();
            return new SuccessResponse();
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage() . '-' . $exception->getTraceAsString());
            return new ErrorResponse($exception);
        }
    }
}
