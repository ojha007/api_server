<?php


namespace App\Http\Requests;


use App\Requests\FormRequestForApi;

class SendQuotationsRequest extends FormRequestForApi
{
    public function rules(): array
    {

        return [
            'enquiry_id' => 'required|exists:enquiries,id',
            'quotation_id' => 'required|exists:quotations,id',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        return [
            'quotation_id.required' => 'Quotation is a required .'
        ];
    }


}
