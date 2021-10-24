<?php

namespace App\Http\Requests;

use App\Requests\FormRequestForApi;

class ChangeProfileRequest extends FormRequestForApi
{

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'phone' => 'required',
            'avatar' => 'nullable',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
