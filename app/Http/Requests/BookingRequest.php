<?php


namespace App\Http\Requests;


use App\Requests\FormRequestForApi;

class BookingRequest extends FormRequestForApi
{
    public function rules(): array
    {

        return [
            'user_id' => 'required|exists:users,id'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }


}
