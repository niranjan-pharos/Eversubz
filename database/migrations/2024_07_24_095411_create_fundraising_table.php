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
        Schema::create('fundraising', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('for');
            $table->decimal('amount', 15, 2)->nullable();
            $table->foreignId('category_id')->constrained('categories');
            $table->string('location')->nullable();
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->text('fundraising_description')->nullable();
            $table->string('facebook_link')->nullable();
            $table->string('linkedin_link')->nullable();
            $table->string('x_link')->nullable();
            $table->string('copy_fundraising_url')->nullable();
            $table->string('video_link')->nullable();
            $table->dateTime('from_date_time')->nullable();
            $table->dateTime('to_date_time')->nullable();
            $table->string('main_image')->nullable();
            $table->string('slug')->unique();
            $table->enum('status', ['active', 'inactive'])->default('inactive');
            $table->boolean('featured')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fundraising');
    }
};
