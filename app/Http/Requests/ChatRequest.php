<?php

namespace App\Http\Requests;

use App\Requests\FormRequestForApi;

class ChatRequest extends FormRequestForApi
{

    public function rules(): array
    {
        return [
            'message' => 'required',
            'identifier' => 'nullable',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
