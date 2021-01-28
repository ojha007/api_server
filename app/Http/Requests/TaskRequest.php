<?php


namespace App\Http\Requests;


use App\Requests\FormRequestForApi;

class TaskRequest extends FormRequestForApi
{
    public function rules(): array
    {

        return [
            'address' => 'required|string',
            'state_id' => 'required|exists:states,id',
            'title' => 'required|string|min:5',
            'description' => 'required|string',
            'date' => 'required|date',
            'worker_id' => 'required|exists:workers,id'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }


}
