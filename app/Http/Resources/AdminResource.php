<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminResource extends JsonResource
{
    public function toArray(Request $request): array {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'address' => $this->address,
            'mobile' => $this->mobile,
            'gender' => $this->gender,
            'imageUrl' => $this->imageUrl,
            'facebook' => $this->facebook,
            'instagram' => $this->instagram,
            'whatsapp' => $this->whatsapp,
            'info' => $this->info,
            'status' => $this->status,
            'role' => $this->role ? $this->role->name : null,
        ];
    }
}
