<?php


namespace App\Http\Requests;


use App\Requests\FormRequestForApi;

class CampaignRequest extends FormRequestForApi
{
    public function rules(): array
    {

        return [
            'from_email' => 'required|email',
            'subject' => 'required|string|min:5',
            'message' => 'required|string|min:5',
            "schedule" => 'required'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }


}
