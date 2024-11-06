<?php

namespace App\Repositories;

use App\Models\Admin;
use App\Http\Requests\AdminRequest;
use Illuminate\Support\Facades\Log;
use App\Helpers\ImageHelper;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\AdminResource;

class AdminRepository
{
    public function getAll() {
        return AdminResource::collection(Admin::getRecord());
    }

    public function store(AdminRequest $request) {
        $validatedData = $request->validated();
        $validatedData['password'] = Hash::make($validatedData['password']);

        if ($request->hasFile('image')) {
            $validatedData['image'] = ImageHelper::uploadImage($request->file('image'), 'images');
        }

        $admin = Admin::create($validatedData);
        return new AdminResource($admin);
    }

    public function find($id) {
        return new AdminResource(Admin::findOrFail($id));
    }

    public function update(AdminRequest $request, $id) {
        $admin = Admin::findOrFail($id);
        $validatedData = $request->validated();

        if (isset($validatedData['password']) && !empty($validatedData['password'])) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        } else {
            unset($validatedData['password']);
        }

        if ($request->hasFile('image')) {
            if ($admin->image) {
                ImageHelper::deleteImage($admin->image, 'images');
            }
            $validatedData['image'] = ImageHelper::uploadImage($request->file('image'), 'images');
        }

        $admin->update($validatedData);
        return new AdminResource($admin);
    }

    public function delete($id) {
        $admin = Admin::findOrFail($id);
        if ($admin->image) {
            ImageHelper::deleteImage($admin->image, 'images');
        }
        $admin->delete();
    }

    public function toggleStatus($id) {
        $admin = Admin::findOrFail($id);
        $admin->toggleStatus();
        return new AdminResource($admin);
    }
}
