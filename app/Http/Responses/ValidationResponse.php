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

        $response = [
            'status' => 422,
            'message' => $message,
            'data' => []
        ];
//        if ($request->wantsJson()) {
//            return response()->json($response);
//        }
        return response()->json($response);

    }
}
