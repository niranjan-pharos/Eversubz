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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->nullable();
            $table->string('host_name')->nullable();
            $table->text('about_host')->nullable();
            $table->string('available_tickets')->default(11);
            $table->string('location')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->decimal('price', 8, 2)->nullable();
            $table->text('event_description')->nullable();
            $table->string('facebook_link')->nullable();
            $table->string('linkedin_link')->nullable();
            $table->string('x_link')->nullable();
            $table->string('copy_event_url')->nullable();
            $table->text('refund_policy')->nullable();
            $table->text('keywords')->nullable();
            $table->string('main_image')->nullable();
            $table->string('video_link')->nullable();
            $table->string('mode')->nullable();
            $table->timestamp('from_date_time');
            $table->timestamp('to_date_time');
            // $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('admin_id');
            $table->boolean('status')->default(0);
            $table->boolean('feature')->default(0);
            $table->Integer('orderby')->default(0);
            $table->string('category_id');
            $table->string('creatable_id')->nullable();
            $table->string('creatable_type')->nullable();
            $table->string('interested_count')->nullable();
            $table->string('going_count')->nullable();
            $table->timestamps();
            $table->foreignId('admin_id')->constrained('users');

            // $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
