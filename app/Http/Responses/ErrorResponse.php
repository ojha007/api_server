<?php


namespace App\Http\Responses;


use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Response;

class ErrorResponse implements Responsable
{

    /**
     * @var \Exception
     */
    private $exception;

    public function __construct(\Exception $exception)
    {
        $this->exception = $exception;
    }

    public function toResponse($request)
    {
        $response = [
            'status' => $this->exception->getCode(),
            'message' => 'ERROR'
        ];
        if ($request->wantsJson()) {
            return response($response, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
