<?php


namespace App\Http\Requests;


use App\Requests\FormRequestForApi;

class EnquiryRequest extends FormRequestForApi
{
    public function rules(): array
    {
        return [

            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email',
            'city' => 'required|max:255',
            'state' => 'required|max:255',
            'postal_code' => 'nullable|max:255',
            'optional_number' => 'nullable|numeric|max:255',
            'address1' => 'required|max:255',
            'address2' => 'nullable|max:255',
            'comment' => 'nullable',
            'age' => 'nullable|numeric',
            'mobile_number' => 'required|numeric',
            'pickup_date' => 'required|date:Y-m-d',
            'delivery_date' => 'required|date:Y-m-d',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        return [
            'date.date' => 'Date should be Y-m-d format eg: ' . now()->format('Y-m-d'),
        ];
    }


}
