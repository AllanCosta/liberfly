<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

/**
 * @OA\Schema(
 *     schema="RegisterRequest",
 *     type="object",
 *     required={"name", "email", "password", "password_confirmation"},
 *     @OA\Property(property="name", type="string", example="John Doe", description="Name of the user", minLength=2, maxLength=255),
 *     @OA\Property(property="email", type="string", format="email", example="john.doe@example.com", description="Email of the user", maxLength=255),
 *     @OA\Property(property="password", type="string", format="password", example="P@ssw0rd", description="Password for the user", minLength=6),
 *     @OA\Property(property="password_confirmation", type="string", format="password", example="P@ssw0rd", description="Password confirmation")
 * )
 */
class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|between:2,255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => [
                'required',
                'confirmed',
                Password::min(6)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised()
            ],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'name'                  => 'name',
            'email'                 => 'email',
            'password'              => 'password',
        ];
    }
}
