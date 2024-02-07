<?php

namespace App\Http\Requests\Blog;

use App\Models\Blog\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        if ($this->method() === 'PUT') {
            $conditionalValidation = [
                'slug' => ['required', 'string', 'lowercase', 'alpha_dash:ascii', 'max:255', Rule::unique(Category::class)->ignore($this->category->id)],
            ];
        } else {
            $conditionalValidation = [
                'slug' => ['required', 'string', 'lowercase', 'alpha_dash:ascii', 'max:255', Rule::unique(Category::class)],
            ];
        }
        
        return array_merge([
            'icon' => ['nullable', 'image', 'max:500'],
            'name' => ['required', 'string', 'max:255'],
            'desc' => ['nullable', 'string'],
            'parent' => ['nullable', 'exists:categories,id'],
        ], $conditionalValidation);
    }
}
