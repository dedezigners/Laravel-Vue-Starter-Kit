<?php

namespace App\Http\Requests\Blog;

use App\Models\Blog\Post;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PostRequest extends FormRequest
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
                'slug' => ['required', 'string', 'lowercase', 'alpha_dash:ascii', 'max:255', Rule::unique(Post::class)->ignore($this->post->id)],
            ];
        } else {
            $conditionalValidation = [
                'image' => ['required', 'image'],
                'slug' => ['required', 'string', 'lowercase', 'alpha_dash:ascii', 'max:255', Rule::unique(Post::class)],
            ];
        }
        
        return array_merge([
            'title' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'tag_ids' => ['nullable', 'array'],
            'tag_ids.*' => ['exists:tags,id'],
            'excerpt' => ['required', 'string'],
            'content' => ['nullable', 'string'],
        ], $conditionalValidation);
    }
}
