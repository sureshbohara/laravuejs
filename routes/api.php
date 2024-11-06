<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\SettingController;


Route::post('/admin/login', [AuthController::class, 'adminLogin'])->name('admin.login');
Route::middleware(['auth:admin', 'throttle:60,1'])->prefix('admin')->group(function () {

    Route::post('/logout', [AuthController::class, 'adminLogout']);
    Route::get('/profile', [AuthController::class, 'getProfile']); 
    Route::post('/profile/update', [AuthController::class, 'updateProfile']);    
    Route::post('/password/update', [AuthController::class, 'updatePassword']);

   // system adin suers api
    Route::get('/roles', [AdminController::class, 'getRole']);
    Route::get('/users', [AdminController::class, 'index']);
    Route::post('/users/save', [AdminController::class, 'save']);
    Route::delete('/users/delete/{id}', [AdminController::class, 'delete']);
    Route::get('/users/get/{id}', [AdminController::class, 'get']);
    Route::post('/users/update/{id}', [AdminController::class, 'update']);
    Route::post('status/users/{id}', [AdminController::class,'usersStatus']);

     // System permissions by admin API
     Route::resource('permissions', PermissionController::class);

     // Settings routes
    Route::get('settings', [SettingController::class, 'getSettings']);
    Route::post('settings', [SettingController::class, 'updateSettings']);




});
