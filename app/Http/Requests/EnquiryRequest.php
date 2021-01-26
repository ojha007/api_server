<?php


namespace App\Http\Requests;


use App\Requests\FormRequestForApi;
use App\Rules\ExistsWith;

class EnquiryRequest extends FormRequestForApi
{
    public function rules(): array
    {

        $a = [
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string|min:5',
            'description' => 'required|string',
            'date' => 'required|date:Y-m-d',
        ];
        return array_merge($a, $this->getArrayFieldRules('pickup_address'), $this->getArrayFieldRules('delivery_address'));
    }

    public function getArrayFieldRules($array): array
    {
        return [
            $array . '.country_id' => 'required|exists:countries,id',
            $array . '.state_id' => ['required', new ExistsWith('states', $array . '.country_id')],
            $array . '.street_one' => 'required|string|min:2',
            $array . '.street_two' => 'nullable',
            $array . ".city" => 'required|string',
            $array . ".postal_code" => 'required|numeric',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        $a = [
            'date.date' => 'Date should be Y-m-d format eg: ' . now()->format('Y-m-d'),
        ];
        return array_merge($a, $this->getArrayFieldMessage('pickup_address'), $this->getArrayFieldMessage('delivery_address'));

    }

    public function getArrayFieldMessage($array): array
    {
        $m = ucwords(str_replace("_address", '', $array));
        return [
            $array . '.country_id.required' => $m . ' country is a required field.',
            $array . '.state_id.required' => $m . ' state is a required field.',
            $array . '.state_id.exists' => $m . " state doesn't belong to given country .",
            $array . '.street_one.required' => $m . ' street is a required field.',
            $array . ".city.required" => $m . ' city is a required field.',
            $array . ".postal_code.required" => $m . ' postal code is a required field.',
            $array . ".postal_code.numeric" => $m . ' postal code should be numeric.',
        ];
    }

}
