<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            // 'image' => '/assets/images/profile.jpeg',
            'name' => $this->name,
            'username' => $this->username,
            'is_admin' => $this->role === 'admin',
            'role' => $this->role
        ];
    }
}
