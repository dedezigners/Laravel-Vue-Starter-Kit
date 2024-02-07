<?php

namespace App\Http\Resources\Blog;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'icon' => $this->icon,
            'desc' => $this->desc,
            'parent' => $this->parent,
            'parent_category' => new CategoryResource($this->parentCategory),
            'created_at' => $this->created_at->diffForHumans(),
        ];
    }
}
