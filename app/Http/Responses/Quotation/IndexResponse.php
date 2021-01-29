<?php


namespace App\Http\Responses\Quotation;


use App\Http\Responses\ErrorResponse;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Collection;

class IndexResponse implements Responsable
{
    /**
     * @var string
     */
    private $viewPath;
    private $enquiry_id;
    /**
     * @var Collection
     */
    protected $quotations;

    /**
     * IndexResponse constructor.
     * @param string $viewPath
     * @param Collection $quotations
     * @param $enquiry_id
     */
    public function __construct(string $viewPath, Collection $quotations, $enquiry_id)
    {
        $this->viewPath = $viewPath;
        $this->enquiry_id = $enquiry_id;
        $this->quotations = $quotations;
    }

    public function toResponse($request)
    {
        try {
            if ($request->wantsJson()) {
            }
            return view($this->viewPath . 'index')
                ->with('enquiry_id', $this->enquiry_id)
                ->with('quotations', $this->quotations);
        } catch (\Exception $exception) {
            return new ErrorResponse($exception);
        }
    }
}
