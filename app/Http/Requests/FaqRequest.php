<?php


namespace App\Http\Requests;


use App\Requests\FormRequestForApi;

class FaqRequest extends FormRequestForApi
{
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ];

    }

    public function authorize(): bool
    {
        return true;
    }


}
