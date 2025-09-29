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
        Schema::table('business_products', function (Blueprint $table) {
            // Drop the foreign key constraint
            $table->dropForeign(['subcategory_id']);  // Ensure this matches the actual foreign key name
            // Drop the column
            $table->dropColumn('subcategory_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('business_products', function (Blueprint $table) {
            // Re-add the column first
            $table->unsignedBigInteger('subcategory_id')->nullable();

            // Re-add the foreign key constraint
            $table->foreign('subcategory_id')->references('id')->on('subcategories');
        });
    }
};
