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
            // Drop the old foreign key
            $table->dropForeign(['category_id']); // Adjust if the name is different

            // Change the column if necessary (if not necessary, skip this step)
            $table->renameColumn('category_id', 'business_category_id');

            // Add the new foreign key
            $table->foreign('business_category_id')->references('id')->on('business_categories')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('business_products', function (Blueprint $table) {
            // Drop the new foreign key
            $table->dropForeign(['business_category_id']); // Adjust if the name is different

            // Revert the column name change if it was changed
            $table->renameColumn('business_category_id', 'category_id');

            // Add back the old foreign key
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('CASCADE');
        });
    }
};
