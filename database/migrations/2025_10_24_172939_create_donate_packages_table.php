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
        Schema::create('donate_packages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('donatepkg_id');
            $table->string('name');
            $table->string('email');
            $table->string('phone_number');
            $table->string('country');
            $table->text('message')->nullable();
            $table->decimal('amount', 10, 2);
            $table->decimal('tip', 10, 2);
            $table->decimal('transaction_fee', 10, 2);
            $table->decimal('total_amount', 10, 2);
            $table->string('status')->default('pending');
            $table->string('donation_number');
            $table->string('anonymous')->default('0');
            $table->string('payment_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donate_packages');
    }
};
