<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.s
     */
    public function run(): void
    {
        DB::table('settings')->insert([
            'system_name' => 'Alpinist Club',
            'email' => 'info@demo.com',
            'phone' => '+1234567890',
            'phone' => '+1234567898',
            'address' => '123 Main St, Anytown, USA',
            'opening_hr' => 'Mon-Fri: 9am - 5pm',
            'facebook' => 'https://facebook.com/myapplication',
            'twitter' => 'https://twitter.com/myapplication',
            'linkedin' => 'https://linkedin.com/company/myapplication',
            'instagram' => 'https://instagram.com/myapplication',
            'youtube' => 'https://youtube.com/myapplication',
            'tiktok' => 'https://tiktok.com/@myapplication',


            'favicon' => '',
            'logo' => '',
            'loader' => '',
            'bg_image' => '',
            'image1' => '',
            'image2' => '',
            'image3' => '',
            'image4' => '',
            'image5' => '',
            'image6' => '',
            'image7' => '',
            'image8' => '',

            'is_section1' => 0,
            'is_section2' => 1,
            'is_section3' => 0,
            'is_section4' => 1,
            'is_section5' => 0,
            'is_section6' => 1,
            'is_section7' => 0,
            'is_section8' => 1,


            'title1' => 'Welcome to Alpinist Club',
            'title2' => 'Our Mission',
            'title3' => 'Events',
            'title4' => 'Membership',
            'title5' => 'Contact Us',
            'title6' => 'Blog',
            'title7' => 'Gallery',
            'title8' => 'Testimonials',



            'meta_author' => 'Alpinist Club Team',
            'meta_title' => 'Alpinist Club - Outdoor Adventures',
            'meta_keywords' => 'outdoor, adventure, climbing, hiking',
            'meta_description' => 'Alpinist Club offers thrilling outdoor adventures and events.',

            'info1' => 'Information 1',
            'info2' => 'Information 2',
            'info3' => 'Information 3',
            'info4' => 'Information 4',
            'info5' => 'Information 5',
            'info6' => 'Information 6',

            'mail_transport' => 'smtp',
            'mail_host' => 'smtp.mailtrap.io',
            'mail_port' => 587,
            'mail_username' => 'username',
            'mail_password' => 'password',
            'mail_encryption' => 'tls',
            'mail_from' => 'info@alpinist.com',
            'mail_from_name' => 'Alpinist Club',
            'smtp_check' => true,

        ]);
    }
}
