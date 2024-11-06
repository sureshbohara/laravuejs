<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PermissionResource extends JsonResource
{
    public function toArray(Request $request): array 
    {
        return [
            'id' => $this->id,
            'permission' => $this->permission,
            'role_id' => $this->role_id,
            'role' => $this->role ? $this->role->name : null,
        ];
    }
}
