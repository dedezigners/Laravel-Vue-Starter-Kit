<?php

namespace App\Http\Requests\Blog;

use App\Models\Blog\Tag;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TagRequest extends FormRequest
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
                'slug' => ['required', 'string', 'lowercase', 'alpha_dash:ascii', 'max:255', Rule::unique(Tag::class)->ignore($this->tag->id)],
            ];
        } else {
            $conditionalValidation = [
                'slug' => ['required', 'string', 'lowercase', 'alpha_dash:ascii', 'max:255', Rule::unique(Tag::class)],
            ];
        }
        
        return array_merge([
            'name' => ['required', 'string', 'max:255'],
            'desc' => ['nullable', 'string'],
        ], $conditionalValidation);
    }
}
