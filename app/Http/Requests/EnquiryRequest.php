<?php


namespace App\Http\Requests;


use App\Requests\FormRequestForApi;

class EnquiryRequest extends FormRequestForApi
{
    public function rules(): array
    {
        return [

            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'title' => 'required|string',
            'description' => 'required|string',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

}
