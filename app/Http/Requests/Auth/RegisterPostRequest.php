<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterPostRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "first_name" => [
                'required',
                'persian_alpha',
                'min:2',
                'max:128'
            ],
            "last_name" => [
                'required',
                'persian_alpha',
                'min:2',
                'max:128'
            ],

            "mobile" => [
                'required',
                'ir_mobile:zero',
                'unique:users,mobile',
            ],
            "email" => [
                'required',
                'email',
                'unique:users,email',
            ],
            'password' => [
                'required',
                'min:8',
                'max:128',
                'confirmed'
            ],

        ];
    }
}
