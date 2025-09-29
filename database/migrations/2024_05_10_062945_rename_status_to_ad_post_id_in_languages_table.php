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
        Schema::table('languages', function (Blueprint $table) {
            // Ensure the column exists before trying to drop it
            if (Schema::hasColumn('languages', 'status')) {
                $table->dropColumn('status');
            }

            // Add the new 'ad_post_id' column
            $table->unsignedBigInteger('ad_post_id')->nullable()->after('id');

            // Optionally, add a foreign key constraint
            $table->foreign('ad_post_id')->references('id')->on('ad_posts')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('languages', function (Blueprint $table) {
            // Drop the foreign key and column if it exists
            $table->dropForeign(['ad_post_id']);
            $table->dropColumn('ad_post_id');

            // Optionally, restore the old 'status' column
            $table->string('status')->nullable();
        });
    }
};
