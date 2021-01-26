<?php


namespace App\Http\Controllers\Api;


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

    public function __construct()
    {
        $this->model = new Enquiry();
        $this->repository = new EnquiryRepository($this->model);
    }


    public function index()
    {
        try {
            $enquiries = $this->repository->getAll();
            return new SuccessResponse($enquiries);
        } catch (\Exception $exception) {
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
            $this->repository->setOrUpdateAddress($pickup_address, Enquiry::PICKUP);
            $this->repository->setOrUpdateAddress($delivery_address, Enquiry::DELIVERY);
            DB::commit();
            return new SuccessResponse();
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage() . '-' . $exception->getTraceAsString());
            return new ErrorResponse($exception);
        }
    }

    public function show($id)
    {

        try {
            $enquiries = $this->repository->findById($id);
            return new SuccessResponse($enquiries);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage() . '-' . $exception->getTraceAsString());
            return new ErrorResponse($exception);
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            DB::table('enquiry_address')
                ->where('enquiry_id', '=', $id)
                ->delete();
            DB::table('enquiries')
                ->where('id', '=', $id)
                ->delete();
            DB::commit();
            return new SuccessResponse(null);
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage() . '-' . $exception->getTraceAsString());
            return new ErrorResponse($exception);
        }
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
            $this->repository->setOrUpdateAddress($pickup_address, Enquiry::PICKUP);
            $this->repository->setOrUpdateAddress($delivery_address, Enquiry::DELIVERY);
            DB::commit();
            return new SuccessResponse(null);
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage() . '-' . $exception->getTraceAsString());
            return new ErrorResponse($exception);
        }
    }
}
