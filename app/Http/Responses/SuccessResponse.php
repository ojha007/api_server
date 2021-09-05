<?php


namespace App\Http\Responses;


use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

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
            return response()->json([$response, ResponseAlias::HTTP_OK]);
        }
        return redirect()
            ->back()
            ->with('success', 'Success.');
    }
}
