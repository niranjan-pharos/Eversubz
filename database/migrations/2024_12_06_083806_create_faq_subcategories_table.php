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
        
        Schema::create('faq_subcategories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id'); // Foreign key
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->boolean('status')->default(1); // Assuming default status is active
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('category_id')
                ->references('id')
                ->on('faq_categories')
                ->onDelete('cascade'); // Deletes subcategories if the parent category is deleted
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faq_subcategories');
    }
};
