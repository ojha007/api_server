<?php


namespace App\Http\Requests;


use App\Requests\FormRequestForApi;

class WorkerRequest extends FormRequestForApi
{
    public function rules(): array
    {

        return [
            'name' => 'required|string',
            'email' => 'required|unique:workers,email',
            'phone' => 'required|numeric|min:5',
            'description' => 'nullable'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }


}
