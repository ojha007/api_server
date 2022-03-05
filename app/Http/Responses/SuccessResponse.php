<?php


namespace App\Http\Responses;


use Illuminate\Contracts\Support\Responsable;

class SuccessResponse implements Responsable
{

    protected $data;
    /**
     * @var null
     */
    public $message;

    public function __construct($data = null, $message = null)
    {
        $this->data = $data;
        $this->message = $message;
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
        if ($this->message) {
            $response['message'] = $this->message;
        }
        if ($request->wantsJson()) {
            return response()->json($response);
        }
        return redirect()
            ->back()
            ->with('success', $this->message ?? 'Success.');
    }
}
