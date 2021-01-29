<?php


namespace App\Http\Responses;


use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class ErrorResponse implements Responsable
{

    /**
     * @var \Exception
     */
    protected $exception;

    public function __construct(\Exception $exception)
    {
        $this->exception = $exception;
    }

    public function toResponse($request)
    {
        Log::error($this->exception->getMessage() . '-' . $this->exception->getTraceAsString());
        if ($request->wantsJson()) {
            $response = [
                'status' => $this->exception->getCode(),
                'message' => 'ERROR'
            ];
            return response($response, Response::HTTP_INTERNAL_SERVER_ERROR);
        } else {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Whoops Something Went wrong');
        }
    }
}
