<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;  // Set to true for now, you can adjust later for authentication
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'system_name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'phone1' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'opening_hr' => 'nullable|string|max:255',
            'facebook' => 'nullable|url|max:255',
            'twitter' => 'nullable|url|max:255',
            'linkedin' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
            'youtube' => 'nullable|url|max:255',
            'tiktok' => 'nullable|url|max:255',

            'favicon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'loader' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'bg_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image3' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image4' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image5' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image6' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',


            'is_section1' => 'nullable|boolean',
            'is_section2' => 'nullable|boolean',
            'is_section3' => 'nullable|boolean',
            'is_section4' => 'nullable|boolean',
            'is_section5' => 'nullable|boolean',
            'is_section6' => 'nullable|boolean',

            'title1' => 'nullable|string',
            'title2' => 'nullable|string',
            'title3' => 'nullable|string',
            'title4' => 'nullable|string',
            'title5' => 'nullable|string',
            'title6' => 'nullable|string',


            'meta_author' => 'nullable|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',

            'info1' => 'nullable|string',
            'info2' => 'nullable|string',
            'info3' => 'nullable|string',
            'info4' => 'nullable|string',
            'info5' => 'nullable|string',
            'info6' => 'nullable|string',

            'mail_transport' => 'nullable|string|max:255',
            'mail_host' => 'nullable|string|max:255',
            'mail_port' => 'nullable|integer',
            'mail_username' => 'nullable|string|max:255',
            'mail_password' => 'nullable|string|max:255',
            'mail_encryption' => 'nullable|string|max:255',
            'mail_from' => 'nullable|string|max:255',
            'mail_from_name' => 'nullable|string|max:255',
            'smtp_check' => 'nullable|boolean',
        ];
    }
}
