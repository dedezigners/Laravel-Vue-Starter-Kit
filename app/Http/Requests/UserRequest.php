<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserRequest extends FormRequest
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
        if ($this->method() === 'PUT') {
            $conditionalValidation = [
                'image' => ['nullable', 'string'],
                'username' => ['required', 'string', 'lowercase', 'alpha_dash:ascii', 'min:4', 'max:255', Rule::unique(User::class)->ignore($this->user->id)],
                'email' => ['required', 'email', 'lowercase', 'max:255', Rule::unique(User::class)->ignore($this->user->id)],
                'password' => ['nullable', Password::default()],
            ];
        } else {
            $conditionalValidation = [
                'image' => ['nullable', 'image'],
                'username' => ['required', 'string', 'lowercase', 'alpha_dash:ascii', 'min:4', 'max:255', Rule::unique(User::class)],
                'email' => ['required', 'email', 'lowercase', 'max:255', Rule::unique(User::class)],
                'password' => ['required', Password::default()],
            ];
        }
        
        return array_merge([
            'name' => ['required', 'string', 'max:255'],
            'role' => ['required', 'in:admin,user'],
            'phone' => ['nullable', 'string'],
            'company' => ['nullable', 'string'],
            'country' => ['nullable', 'string'],
        ], $conditionalValidation);
    }
}
