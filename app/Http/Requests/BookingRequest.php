<?php


namespace App\Http\Requests;


use App\Requests\FormRequestForApi;

class BookingRequest extends FormRequestForApi
{
    public function rules(): array
    {

        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'moving_date' => 'required|date_format:Y-m-d',
            'moving_from_suburb' => 'required|string',
            'moving_to_suburb' => 'required|string',
            'access_parking' => 'required|string',
            'pickup_address' => 'required|string',
            'dropoff_address' => 'required|string',
            'additional_address' => 'nullable',
            'additional_service' => 'nullable',
            'size_of_moving' => 'required',
            'hear_about_us' => 'nullable',
            'inventory' => 'nullable',
            'comments' => 'nullable',
            'description' => 'nullable',
            'additional_services' => 'array'

        ];

    }

    public function authorize(): bool
    {
        return true;
    }


}
