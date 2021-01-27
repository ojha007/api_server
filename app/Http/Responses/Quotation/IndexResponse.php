<?php


namespace App\Http\Responses\Quotation;


use App\Http\Responses\ErrorResponse;
use Illuminate\Contracts\Support\Responsable;

class IndexResponse implements Responsable
{
    /**
     * @var string
     */
    private $viewPath;
    private $enquiry_id;

    /**
     * IndexResponse constructor.
     * @param string $viewPath
     * @param $enquiry_id
     */
    public function __construct(string $viewPath, $enquiry_id)
    {
        $this->viewPath = $viewPath;
        $this->enquiry_id = $enquiry_id;
    }

    public function toResponse($request)
    {
        try {
            if ($request->wantsJson()) {
            }
            return view($this->viewPath . 'index')
                ->with('enquiry_id', $this->enquiry_id);
        } catch (\Exception $exception) {
            return new ErrorResponse($exception);
        }
    }
}
