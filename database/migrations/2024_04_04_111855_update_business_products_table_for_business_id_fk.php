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
            // Assuming 'user_id' is the column name and it has a foreign key constraint
            // First, drop the foreign key constraint
            $table->dropForeign(['user_id']); // Adjust the foreign key constraint name if it's different
            $table->dropColumn('user_id'); // Drop the user_id column if it's no longer needed

            // Add the business_id column and foreign key constraint
            $table->unsignedBigInteger('business_id')->nullable(); // Use ->nullable() if the relationship is optional
            $table->foreign('business_id')->references('id')->on('user_business_infos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('business_products', function (Blueprint $table) {
            // Revert the changes: drop the business_id foreign key and column, and add back the user_id column and foreign key
            $table->dropForeign(['business_id']);
            $table->dropColumn('business_id');

            // Assuming you want to revert back to the original state with the user_id column and foreign key
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users'); // Adjust according to your original foreign key setup
        });
    }
};
