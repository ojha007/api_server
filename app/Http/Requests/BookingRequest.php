<?php


namespace App\Http\Requests;


use App\Requests\FormRequestForApi;

class BookingRequest extends FormRequestForApi
{
    public function rules(): array
    {

        return [
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'address' => 'required|string',
            'start_time' => 'required|date',
            'end_time' => 'required|date',

        ];
    }

    public function authorize(): bool
    {
        return true;
    }


}
