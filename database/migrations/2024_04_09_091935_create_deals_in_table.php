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
        Schema::create('deals_in', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_business_info_id'); 
            $table->string('deal'); 
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('user_business_info_id')
                  ->references('id')->on('user_business_infos')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deals_in');
    }
};
