<?php


namespace App\Http\Requests;


use App\Requests\FormRequestForApi;

class TaskRequest extends FormRequestForApi
{
    public function rules(): array
    {

        if ($this->request->get('_method')) {
            return [
                'description' => 'nullable|string',
                'task_completed' => 'required|date',
                'images' => 'array',
                'images.*' => 'nullable|string'
            ];
        } else {
            return [
                'booking_id' => 'required|exists:bookings,id',
                'title' => 'required'
            ];
        }
    }

    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        return parent::messages(); // TODO: Change the autogenerated stub
    }

}
