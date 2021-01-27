<?php


namespace App\Http\Responses\Enquiry;


use App\Http\Responses\ErrorResponse;
use App\Http\Responses\SuccessResponse;
use App\Models\Enquiry;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DeleteResponse implements Responsable
{
    /**
     * @var Enquiry
     */
    protected $enquiry;
    /**
     * @var string
     */
    protected $routePath;

    /**
     * DeleteResponse constructor.
     * @param Enquiry $enquiry
     * @param string $routePath
     */
    public function __construct(Enquiry $enquiry, string $routePath)
    {

        $this->enquiry = $enquiry;
        $this->routePath = $routePath;
    }

    public function toResponse($request)
    {
        try {
            DB::beginTransaction();
            $this->enquiry->pickUpAddress()->forceDelete();
            $this->enquiry->deliveryAddress()->forceDelete();
            $this->enquiry->delete();
            DB::commit();
            if ($request->wantsJson()) {
                return new SuccessResponse(null);
            } else {
                return redirect()->route($this->routePath . 'index')
                    ->with('success', 'Enquiry Deleted Successfully .');
            }
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage() . '-' . $exception->getTraceAsString());
            return new ErrorResponse($exception);
        }
    }
}
