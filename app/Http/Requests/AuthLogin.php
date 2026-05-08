<?php

namespace App\Http\Requests;

class AuthLogin extends BaseApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, array<mixed>|string>
     */
    public function rules(): array
    {
        return [
           'email' => 'required|email',
           'password'=> 'required'
        ];
    }

}
