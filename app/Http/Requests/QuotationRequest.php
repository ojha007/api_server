<?php


namespace App\Http\Requests;


use App\Requests\FormRequestForApi;

class QuotationRequest extends FormRequestForApi
{
    public function rules(): array
    {

        return [
            'title' => 'required|string|min:5',
            'description' => 'required|string|min:10',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }


}
