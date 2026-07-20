<?php

namespace App\ValueChainMap\UserAccessManagement\UserManagement\Presentation\Requests\Users;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class RegisterUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::guest(); // Only allow guests to register new users
    }

    protected function failedAuthorization()
    {
        throw new AuthorizationException('You are already logged in. Please log out to register a new account.');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'max:16'],
            'display_name' => ['string', 'max:255']
        ];
    }

    public function messages(): array
    {
        return [
            // Email messages
            'email.required' => 'Please enter your email.',
            'email.email'    => 'That doesn’t look like a valid email address.',
            'email.unique'   => 'This email is already in use. Try logging in.',
            
            // Password messages
            'password.required' => 'Please create a password.',
            'password.string'   => 'Password format is invalid.',
            'password.min'      => 'Password is too short. Please use at least 8 letters.',
            'password.max'      => 'Password is too long. Please use 16 or fewer letters.',
            
            // Display name messages
            'display_name.string' => 'Name format is invalid.',
            'display_name.max'    => 'Your display name cannot be longer than 255 letters.'
        ];
    }

}
