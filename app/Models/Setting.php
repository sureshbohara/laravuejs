<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
    'system_name',
    'email',
    'phone',
    'phone1',
    'address',
    'opening_hr',
    'facebook',
    'twitter',
    'linkedin',
    'instagram',
    'youtube',
    'tiktok',

    'favicon',
    'logo',
    'loader',
    'bg_image',
    'image1',
    'image2',
    'image3',
    'image4',
    'image5',
    'image6',



    'is_section1',
    'is_section2',
    'is_section3',
    'is_section4',
    'is_section5',
    'is_section6',


    'title1',
    'title2',
    'title3',
    'title4',
    'title5',
    'title6',


    'meta_author',
    'meta_title',
    'meta_keywords',
    'meta_description',

    'info1',
    'info2',
    'info3',
    'info4',
    'info5',
    'info6',

    'mail_transport',
    'mail_host',
    'mail_port',
    'mail_username',
    'mail_password',
    'mail_encryption',
    'mail_from',
    'mail_from_name',
    'smtp_check',
   ];

}
