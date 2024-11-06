<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use App\Repositories\PermissionRepository;
use App\Http\Requests\PermissionRequest;
use App\Http\Resources\PermissionResource;

class PermissionController extends Controller
{
    private PermissionRepository $repository;

    public function __construct(PermissionRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(): JsonResponse
    {
        $permissions = $this->repository->getAll();
        return response()->json(['status' => 200, 'data' => PermissionResource::collection($permissions)], 200);
    }

    public function store(PermissionRequest $request): JsonResponse
    {
        try {
            $permission = $this->repository->store($request);
            return response()->json(['status' => 201, 'msg' => 'Permission created successfully', 'data' => new PermissionResource($permission)], 201);
        } catch (\Exception $e) {
            Log::error('Failed to create permission: ' . $e->getMessage());
            return response()->json(['status' => 500, 'msg' => 'Failed to create permission'], 500);
        }
    }

    public function show(int $id): JsonResponse
    {
        try {
            $permission = $this->repository->find($id);
            return response()->json(['status' => 200, 'data' => new PermissionResource($permission)], 200);
        } catch (\ModelNotFoundException $e) {
            Log::error('Failed to retrieve permission: ' . $e->getMessage());
            return response()->json(['status' => 404, 'msg' => 'Permission not found'], 404);
        }
    }

    public function update(PermissionRequest $request, int $id): JsonResponse
    {
        try {
            $updatedPermission = $this->repository->update($request, $id);
            return response()->json(['status' => 200, 'msg' => 'Permission updated successfully', 'data' => new PermissionResource($updatedPermission)], 200);
        } catch (\Exception $e) {
            Log::error('Failed to update permission: ' . $e->getMessage());
            return response()->json(['status' => 500, 'msg' => 'Failed to update permission'], 500);
        }
    }

    public function destroy(int $id): JsonResponse
    {
        try {
            $this->repository->delete($id);
            return response()->json(['status' => 204, 'msg' => 'Permission deleted successfully'], 204);
        } catch (\Exception $e) {
            Log::error('Failed to delete permission: ' . $e->getMessage());
            return response()->json(['status' => 500, 'msg' => 'Failed to delete permission'], 500);
        }
    }
}
