<?php


namespace App\Http\Responses;


use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class ErrorResponse implements Responsable
{

    /**
     * @var Exception
     */
    protected $exception;

    public function __construct(Exception $exception)
    {
        $this->exception = $exception;
    }

    public function toResponse($request)
    {
        logException($this->exception);
        if ($request->wantsJson()) {
            $response = [
                'status' => 500,
                'message' => 'Whoops! Something Went wrong',
                'data'=>[]
            ];
            return response($response);
        } else {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Whoops Something Went wrong');
        }
    }
}
