<?php

namespace App\Http\Requests\Blog;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'icon' => ['nullable', 'image', 'max:500'],
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'lowercase', 'alpha_dash:ascii', 'max:255', 'unique:categories'],
            'desc' => ['nullable', 'string'],
            'parent' => ['nullable', 'exists:categories,id'],
        ];
    }
}
