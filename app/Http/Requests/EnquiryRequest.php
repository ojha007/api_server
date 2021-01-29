<?php


namespace App\Http\Requests;


use App\Requests\FormRequestForApi;

class EnquiryRequest extends FormRequestForApi
{
    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string|min:5',
            'description' => 'required|string',
            'date' => 'required|date:Y-m-d',
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
