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
        Schema::create('donation_packages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ngo_id')->nullable();
            $table->foreign('ngo_id')->references('id')->on('ngos')->onDelete('cascade');
            $table->string('name');
            $table->text('in_packages')->nullable();
            $table->text('description')->nullable();
            $table->string('image');
            $table->decimal('price', 8, 2)->nullable();
            $table->integer('quantity');
            $table->boolean('decide_by_eversabz')->default(1);
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donation_packages');
    }
};
