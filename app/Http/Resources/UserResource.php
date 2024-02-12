<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'preview' => "/storage/users/{$this->image}",
            'thumb' => "/storage/users/thumb/{$this->image}",
            'name' => $this->name,
            'email' => $this->email,
            'username' => $this->username,
            'role' => $this->role,
            'phone' => $this->phone,
            'company' => $this->company,
            'country' => $this->country,
        ];
    }
}
