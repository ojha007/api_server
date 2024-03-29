<?php


namespace App\Http\Responses;


use Illuminate\Contracts\Support\Responsable;
use Illuminate\Validation\Validator;


class ValidationResponse implements Responsable
{

    protected $validation;
    /**
     * @var null
     */
    protected $message;

    public function __construct($validation = null, $message = null)
    {
        $this->validation = $validation;
        $this->message = $message;
    }

    public function toResponse($request)
    {
        $message = $this->message ?? "Whoops ! Something went wrong.";
        if ($this->validation instanceof Validator)
            $message = $this->validation->errors()->first();

        if ($request->wantsJson()) {
            $response = [
                'status' => 422,
                'message' => $message,
                'data' => []
            ];
            return response()->json($response);
        } else {
            return redirect()->back()
                ->with('failed', $message);
        }


    }
}
