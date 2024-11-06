<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ImageHelper;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AdminRequest;
use App\Http\Resources\AdminResource;

class AuthController extends Controller
{
    /**
     * Handle admin login.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function adminLogin(Request $request) {
        // Validate incoming request data
        $data = $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|min:8|max:20',
        ]);

        // Retrieve the admin based on the provided email
        $admin = Admin::where('email', $data['email'])->first();

        // Check if admin exists
        if (!$admin) {
            return response()->json(['status' => 404, 'msg' => 'Email not found'], 404);
        }

        // Check if the admin account is active
        if ($admin->status === 0) {
            return response()->json(['status' => 403, 'msg' => 'Your account is not active'], 403);
        }

        // Verify the provided password
        if (Hash::check($data['password'], $admin->password)) {
            // Create a new token for the admin
            $token = $admin->createToken('admin_token')->plainTextToken;
            return response()->json(['status' => 200, 'token' => $token, 'msg' => 'User logged in successfully!']);
        } else {
            // Handle incorrect password
            return response()->json(['status' => 401, 'msg' => 'Your email or password is incorrect!'], 401);
        }
    }

    /**
     * Handle admin logout.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function adminLogout(Request $request) {
        // Delete the current access token
        $request->user()->currentAccessToken()->delete();
        return response()->json(['status' => 200, 'msg' => 'Logged out successfully']);
    }

    /**
     * Retrieve the logged-in admin's profile.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProfile(Request $request) {
        // Return the admin profile using a resource for consistent formatting
        return response()->json(['status' => 200, 'data' => new AdminResource($request->user())], 200);
    }

    /**
     * Update the logged-in admin's profile.
     *
     * @param AdminRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
        public function updateProfile(Request $request) {
            $admin = Auth::guard('admin')->user();
            // Validate incoming request data
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required',
                'address' => 'nullable|string|max:255',
                'mobile' => 'nullable|string|max:15',
                'facebook' => 'nullable|string|max:255',
                'instagram' => 'nullable|string|max:255',
                'whatsapp' => 'nullable|string|max:15',
                'info' => 'nullable|string',
                'gender' => 'required|string|in:Male,Female,Other',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
            $admin->name = $data['name'];
            $admin->email = $data['email'];
            $admin->address = $data['address'];
            $admin->mobile = $data['mobile'];
            $admin->facebook = $data['facebook'];
            $admin->instagram = $data['instagram'];
            $admin->whatsapp = $data['whatsapp'];
            $admin->info = $data['info'];
            $admin->gender = $data['gender'];
            if ($request->hasFile('image')) {
                $admin->image = ImageHelper::uploadImage($request->file('image'), 'images', $admin->image);
            }
            $admin->save();
            return response()->json(['status' => 200, 'msg' => 'Profile updated successfully', 'data' => new AdminResource($admin)], 200);
        }



    /**
     * Update the logged-in admin's password.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updatePassword(Request $request) {
        // Validate the incoming password data
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|different:current_password',
            'confirm_password' => 'required|same:new_password',
        ]);

        // Retrieve the authenticated admin
        $admin = Auth::guard('admin')->user();

        // Verify the current password
        if (!Hash::check($request->current_password, $admin->password)) {
            return response()->json(['status' => 403, 'msg' => 'Current password incorrect'], 403);
        }

        // Hash and update the new password
        $admin->password = Hash::make($request->new_password);
        $admin->save();

        return response()->json(['status' => 200, 'msg' => 'Password updated successfully'], 200);
    }
}
