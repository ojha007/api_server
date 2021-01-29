<?php


namespace App\Http\Responses\Enquiry;


use App\Http\Resources\EnquiryResource;
use App\Http\Responses\ErrorResponse;
use App\Http\Responses\SuccessResponse;
use App\Models\Enquiry;
use App\Models\Quotation;
use App\Repositories\QuotationRepository;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\Log;

class ShowResponse implements Responsable
{

    /**
     * @var Enquiry
     */
    protected $enquiry;
    /**
     * @var string
     */
    protected $viewPath;

    /**
     * ShowResponse constructor.
     * @param Enquiry $enquiry
     * @param string $viewPath
     */
    public function __construct(Enquiry $enquiry, string $viewPath)
    {
        $this->enquiry = $enquiry;
        $this->viewPath = $viewPath;
    }

    public function toResponse($request)
    {
        try {
            if ($request->wantsJson()) {
                return new EnquiryResource($this->enquiry);
            } else {
                $selectQuotations = (new QuotationRepository(new Quotation()))->getSelectItems('title');
                return view($this->viewPath . 'show',compact('selectQuotations'))
                    ->with('enquiry', $this->enquiry);
            }
        } catch (\Exception $exception) {
            Log::error($exception->getMessage() . '-' . $exception->getTraceAsString());
            return new ErrorResponse($exception);
        }
    }
}
