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
        Schema::create('user_business_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('business_name');
            $table->text('slug');
            $table->unsignedBigInteger('business_category');
            $table->string('business_type')->nullable();
            $table->string('abn')->unique()->nullable(); // Australian Business Number
            $table->string('sku')->unique()->nullable(); // Australian Company Number
            $table->string('acn')->unique()->nullable(); // Australian Company Number
            $table->string('gst')->unique()->nullable();
            $table->string('vat')->unique()->nullable();
            $table->string('contact_email');
            $table->string('contact_phone');
            $table->text('business_address')->nullable();
            $table->text('business_description')->nullable();
            $table->string('website_url')->nullable();
            $table->text('social_media_links')->nullable(); 
            $table->text('facebook_url')->nullable(); 
            $table->text('twitter_url')->nullable(); 
            $table->text('instagram_url')->nullable(); 
            $table->text('linkedin_url')->nullable(); 
            $table->text('business_city')->nullable(); 
            $table->text('business_state')->nullable(); 
            $table->text('business_country')->nullable(); 
            $table->tinyInteger('created_by_admin')->default(0); 
            $table->string('logo_path')->nullable(); 
            $table->tinyInteger('status')->default(0); // 0 = Unapproved, 1 = Approved
            $table->tinyInteger('feature')->default(0);
            $table->Integer('orderby');
            $table->Integer('establish_year')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_business_infos');
    }
};
