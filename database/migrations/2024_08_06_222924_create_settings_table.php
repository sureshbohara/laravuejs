<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('system_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('phone1')->nullable();
            $table->text('address')->nullable();
            $table->string('opening_hr')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('instagram')->nullable();
            $table->string('youtube')->nullable();
            $table->string('tiktok')->nullable();

            $table->boolean('is_section1')->default(0);
            $table->boolean('is_section2')->default(0);
            $table->boolean('is_section3')->default(0);
            $table->boolean('is_section4')->default(0);
            $table->boolean('is_section5')->default(0);
            $table->boolean('is_section6')->default(0);



            $table->string('title1')->nullable();
            $table->string('title2')->nullable();
            $table->string('title3')->nullable();
            $table->string('title4')->nullable();
            $table->string('title5')->nullable();
            $table->string('title6')->nullable();



            $table->string('favicon')->nullable();
            $table->string('logo')->nullable();
            $table->string('loader')->nullable();
            $table->string('bg_image')->nullable();
            $table->string('image1')->nullable();
            $table->string('image2')->nullable();
            $table->string('image3')->nullable();
            $table->string('image4')->nullable();
            $table->string('image5')->nullable();
            $table->string('image6')->nullable();

           

            $table->string('meta_author')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();

            $table->longText('info1')->nullable();
            $table->longText('info2')->nullable();
            $table->longText('info3')->nullable();
            $table->longText('info4')->nullable();
            $table->longText('info5')->nullable();
            $table->longText('info6')->nullable();

            $table->string('mail_transport')->nullable();
            $table->string('mail_host')->nullable();
            $table->integer('mail_port')->nullable();
            $table->string('mail_username')->nullable();
            $table->string('mail_password')->nullable();
            $table->string('mail_encryption')->nullable();
            $table->string('mail_from')->nullable();
            $table->string('mail_from_name')->nullable();
            $table->boolean('smtp_check')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
