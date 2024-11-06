<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Ensure to implement authorization checks as needed
    }

    public function rules()
    {
        $rules = [
            'role_id' => 'required|integer|exists:roles,id',
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'mobile' => 'required|string|max:20',
            'facebook' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'whatsapp' => 'nullable|string|max:255',
            'gender' => 'required|string|in:Male,Female,Other',
            'info' => 'nullable|string|max:500',
            'status' => 'nullable|boolean',
            'image' => 'nullable|file|image|mimes:jpeg,png,jpg,gif|max:2048',
            'email' => 'required|email',
            'password' => 'nullable|string|min:8',
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'Please provide a name.',
            'email.required' => 'An email address is required.',
            'email.unique' => 'This email is already in use.',
            'email.email' => 'Please provide a valid email address.',
            'address.required' => 'The address is required.',
            'mobile.required' => 'The mobile field is required.',
            'gender.required' => 'Please select a gender.',
            'password.required' => 'A password is required.',
            'password.min' => 'The password must be at least 8 characters.',
            'image.image' => 'The file must be an image.',
            'image.mimes' => 'The image must be a type of jpeg, png, jpg, or gif.',
            'image.max' => 'The image may not be greater than 2048 kilobytes.',
        ];
    }
}
