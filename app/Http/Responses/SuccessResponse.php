<?php


namespace App\Http\Responses;


use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Response;

class SuccessResponse implements Responsable
{

    protected $data;

    public function __construct($data = null)
    {
        $this->data = $data;
    }

    public function toResponse($request)
    {
        $response = [
            'status' => 201,
            'message' => 'SUCCESS'
        ];
        if ($this->data) {
            $response['data'] = $this->data;
        }
        if ($request->wantsJson()) {
            return response()->json([$response, Response::HTTP_OK]);
        }
        return redirect()
            ->back()
            ->with('success', 'Success.');
    }
}
