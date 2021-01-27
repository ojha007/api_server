<?php


namespace App\Http\Responses\Enquiry;


use App\Http\Responses\ErrorResponse;
use App\Http\Responses\SuccessResponse;
use App\Models\Enquiry;
use App\Repositories\EnquiryRepository;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class StoreResponse implements Responsable
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
     * @var string
     */
    protected $baseRoute;

    /**
     * IndexResponse constructor.
     * @param string $baseRoute
     */
    public function __construct(string $baseRoute)
    {
        $this->model = new Enquiry();
        $this->repository = new EnquiryRepository($this->model);
        $this->baseRoute = $baseRoute;
    }

    public function toResponse($request)
    {
        try {
            DB::beginTransaction();
            $attributes['enquiry'] = $request->except('pickup_address', 'delivery_address');
            $enquiry = $this->repository->create($attributes['enquiry']);
            $a = ['enquiry_id' => $enquiry->id];
            $pickup_address = array_merge($request->get('pickup_address'), $a);
            $delivery_address = array_merge($request->get('delivery_address'), $a);
//            $this->repository->setOrUpdateAddress($pickup_address, Enquiry::PICKUP);
//            $this->repository->setOrUpdateAddress($delivery_address, Enquiry::DELIVERY);
            DB::commit();
            if ($request->wantsJson()) {
                return new SuccessResponse(null);
            } else {
                return redirect()->route($this->baseRoute . '.index')
                    ->with('success', 'Enquiry Added Successfully');
            }
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage() . '-' . $exception->getTraceAsString());
            return new ErrorResponse($exception);
        }

    }
}
