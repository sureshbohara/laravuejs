<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Repositories\AdminRepository;
use App\Http\Requests\AdminRequest;
use App\Models\Role;
class AdminController extends Controller
{
    private $adminRepository;

    public function __construct(AdminRepository $adminRepository) {
        $this->adminRepository = $adminRepository;
    }

    public function getRole(){
        $roles = Role::all(); 
        return response()->json($roles);
    }

    public function index() {
        return response()->json(['status' => 200, 'data' => $this->adminRepository->getAll()]);
    }

    public function save(AdminRequest $request) {
        try {
            $admin = $this->adminRepository->store($request);
            return response()->json(['status' => 201, 'msg' => 'Admin created successfully', 'data' => $admin], 201);
        } catch (\Exception $e) {
            Log::error('Failed to create admin: ' . $e->getMessage());
            return response()->json(['status' => 500, 'msg' => 'Failed to create admin'], 500);
        }
    }

    public function get($id) {
        return response()->json(['status' => 200, 'data' => $this->adminRepository->find($id)]);
    }

    public function update(AdminRequest $request, $id) {
        try {
            $updatedAdmin = $this->adminRepository->update($request, $id);
            return response()->json(['status' => 200, 'msg' => 'Admin updated successfully', 'data' => $updatedAdmin], 200);
        } catch (\Exception $e) {
            Log::error('Failed to update admin: ' . $e->getMessage());
            return response()->json(['status' => 500, 'msg' => 'Failed to update admin'], 500);
        }
    }

    public function delete($id) {
        try {
            $this->adminRepository->delete($id);
            return response()->json(['status' => 204, 'msg' => 'Admin deleted successfully'], 204);
        } catch (\Exception $e) {
            Log::error('Failed to delete admin: ' . $e->getMessage());
            return response()->json(['status' => 500, 'msg' => 'Failed to delete admin'], 500);
        }
    }

    public function usersStatus($id) {
        try {
            $admin = $this->adminRepository->toggleStatus($id);
            return response()->json(['status' => 200, 'data' => $admin, 'msg' => 'Admin status toggled successfully']);
        } catch (\Exception $e) {
            Log::error('Failed to toggle admin status: ' . $e->getMessage());
            return response()->json(['status' => 500, 'msg' => 'Failed to toggle admin status'], 500);
        }
    }
}
