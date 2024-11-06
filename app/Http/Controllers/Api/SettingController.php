<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Repositories\SettingRepository;
use App\Http\Requests\SettingRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\JsonResponse;

class SettingController extends Controller
{
    private $repository;

    public function __construct(SettingRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Update the settings in the database
     * 
     * @param  SettingRequest  $request
     * @return JsonResponse
     */
    public function updateSettings(SettingRequest $request): JsonResponse
    {
        try {
            $validatedData = $request->validated();  
            $setting = $this->repository->update(1, $validatedData);  
            return response()->json([
                'status' => 200,
                'msg' => 'Data updated successfully',
                'data' => $setting,
            ]);
        } catch (\Exception $e) {
            Log::error('Error updating settings: ' . $e->getMessage());
            return response()->json([
                'status' => 500,
                'msg' => 'Failed to update settings',
            ], 500);
        }
    }

    /**
     * Get the current settings
     *
     * @return JsonResponse
     */
    public function getSettings(): JsonResponse
    {
        $setting = Setting::find(1); 
        if (!$setting) {
            return response()->json([
                'status' => 404,
                'msg' => 'Settings not found',
            ], 404);
        }
        return response()->json([
            'status' => 200,
            'data' => $setting,
        ]);
    }
}
