<?php


namespace App\Http\Requests;


use App\Requests\FormRequestForApi;

class WorkerRequest extends FormRequestForApi
{
    public function rules(): array
    {

        return [
            'name' => 'required|string',
            'email' => 'required|unique:users,email',
            'phone' => 'required|numeric|',
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6',
            'status' => 'required|boolean'

        ];
    }

    public function authorize(): bool
    {
        return true;
    }


}
