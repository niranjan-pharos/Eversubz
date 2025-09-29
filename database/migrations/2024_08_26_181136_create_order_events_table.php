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
        Schema::create('order_events', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_id'); 
            $table->unsignedBigInteger('user_id')->nullable(); // Nullable if guests
            $table->string('guest_email')->nullable(); // Nullable if user logged in
            $table->decimal('total_amount', 10, 2);
            $table->enum('status', ['pending', 'completed', 'failed']);
            $table->string('payment_id')->nullable();
            $table->string('coupon_code')->nullable();
            $table->decimal('discount', 10, 2)->nullable();
            $table->string('payment_method');
            $table->string('first_name'); 
            $table->string('last_name');
            $table->string('email');
            $table->string('phone');
            $table->text('address');
            $table->string('receipt_number')->nullable();
            $table->string('receipt_url')->nullable();
            $table->string('card_fingerprint')->nullable();
            $table->string('card_last_four', 4)->nullable();
            $table->string('currency', 3)->default('AUD');
            $table->text('comments')->nullable();
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
            // If you have a users table
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
