<?php

namespace App\Http\Requests;

use App\Rules\MatchOldPassword;
use Illuminate\Foundation\Http\FormRequest;



class ChangePasswordRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => 'required|string|min:6|different:current_password',
            'new_confirm_password' => 'same:new_password'
        ];

    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function getRedirectUrl(): string
    {
        $url = $this->redirector->getUrlGenerator();
        return $url->previous() . '#change-password';
    }
}
