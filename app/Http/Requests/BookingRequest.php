<?php


namespace App\Http\Requests;


use App\Models\Booking;
use App\Requests\FormRequestForApi;

class BookingRequest extends FormRequestForApi
{
    public function rules(): array
    {

        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'moving_date' => 'required|date_format:Y-m-d H:i:s',
            'moving_from_suburb' => 'required|string',
            'moving_to_suburb' => 'required|string',
            'access_parking' => 'required|string',
            'pickup_address' => 'required|string',
            'dropoff_address' => 'required|string',
            'additional_address' => 'nullable',
            'additional_service' => 'nullable',
            'size_of_moving' => 'required|in:' . implode(',', array_keys(Booking::allSizeOfMoving())),
            'hear_about_us' => 'nullable',
            'inventory' => 'nullable',
            'comments' => 'nullable',
            'description' => 'nullable',

        ];

    }

    public function authorize(): bool
    {
        return true;
    }


}
