<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds to create initial admin accounts.
     *
     * @return void
     */
    public function run(): void
    {
        $admins = [
            [
                'role_id' => 1,
                'name' => 'Super Admin',
                'email' => 'superadmin@example.com',
                'password' => Hash::make('superadmin123'),
                'address' => '123 Super Admin St, Admin City, Admin Country',
                'mobile' => '1234567890',
                'facebook' => 'https://facebook.com/superadmin',
                'instagram' => 'https://instagram.com/superadmin',
                'whatsapp' => 'https://wa.me/1234567890',
                'gender' => 'Male',
                'image' => 'superadmin.png',
                'info' => 'Head of Administration with full access to all features.',
                'status' => 1,
            ],
            [
                'role_id' => 2,
                'name' => 'System Admin',
                'email' => 'systemadmin@example.com',
                'password' => Hash::make('systemadmin123'),
                'address' => '456 System Admin Blvd, Tech City, Admin Country',
                'mobile' => '0987654321',
                'facebook' => 'https://facebook.com/systemadmin',
                'instagram' => 'https://instagram.com/systemadmin',
                'whatsapp' => 'https://wa.me/0987654321',
                'gender' => 'Male',
                'image' => 'systemadmin.png',
                'info' => 'Responsible for system maintenance and technical support.',
                'status' => 1,
            ],
            [
                'role_id' => 1,
                'name' => 'Content Writer',
                'email' => 'contentwriter@example.com',
                'password' => Hash::make('contentwriter123'),
                'address' => '789 Content Writer Ave, Creative City, Admin Country',
                'mobile' => '1122334455',
                'facebook' => 'https://facebook.com/contentwriter',
                'instagram' => 'https://instagram.com/contentwriter',
                'whatsapp' => 'https://wa.me/1122334455',
                'gender' => 'Female',
                'image' => 'contentwriter.png',
                'info' => 'Creates and manages content for the platform.',
                'status' => 1,
            ],
        ];

        foreach ($admins as $adminData) {
            Admin::create($adminData);
        }
    }
}
