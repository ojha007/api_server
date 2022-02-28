<?php


namespace App\Http\Requests;


use App\Requests\FormRequestForApi;

class WorkerRequest extends FormRequestForApi
{
    public function rules(): array
    {

        return [
            'name' => 'required|string',
            'email' => 'required|unique:users,email,'.$this->request->get('id'),
            'phone' => 'required|numeric',
            'status' => 'required|boolean'

        ];

    }

    public function authorize(): bool
    {
        return true;
    }


}
