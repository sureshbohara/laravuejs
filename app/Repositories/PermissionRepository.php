<?php

namespace App\Repositories;

use App\Models\Permission;
use App\Http\Requests\PermissionRequest;
use Illuminate\Support\Facades\Log;

class PermissionRepository
{
    public function getAll(): \Illuminate\Database\Eloquent\Collection
    {
        return Permission::all();
    }

    public function store(PermissionRequest $request): Permission
    {
        $validatedData = $request->validated();
        return Permission::create($validatedData);
    }

    public function find(int $id): Permission 
    {
        return Permission::findOrFail($id);
    }

    public function update(PermissionRequest $request, int $id): Permission
    {
        $permission = $this->find($id);
        $validatedData = $request->validated();
        $permission->update($validatedData);
        return $permission;
    }

    public function delete(int $id): void
    {
        $permission = $this->find($id);
        $permission->delete();
    }
}
