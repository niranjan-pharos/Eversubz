<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('fundraising_id');
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
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('donations');
    }
}
