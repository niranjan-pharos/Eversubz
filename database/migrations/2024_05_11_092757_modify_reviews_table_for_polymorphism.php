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
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropForeign(['ad_post_id']);  // Drop the old foreign key if exists
            $table->dropColumn('ad_post_id');    // Drop the old column if exists

            $table->morphs('reviewable');  // This adds `reviewable_id` and `reviewable_type`
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropMorphs('reviewable');  // Remove the polymorphic columns

            $table->unsignedBigInteger('ad_post_id')->nullable(); // Re-add the old column if necessary
            $table->foreign('ad_post_id')->references('id')->on('ad_posts'); // Re-add the foreign key if necessary
        });
    }
};
