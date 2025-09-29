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
            // Drop foreign key constraint
            $table->dropForeign(['ad_post_id']);  // Make sure the key name matches the actual key name in the database
            
            // Drop the column after removing the constraint
            $table->dropColumn('ad_post_id');
        });
    }
    
    public function down()
    {
        Schema::table('languages', function (Blueprint $table) {
            // Re-add the ad_post_id column
            $table->integer('ad_post_id')->unsigned()->nullable();
            
            // Optionally re-add a foreign key constraint
            $table->foreign('ad_post_id')->references('id')->on('ad_posts')->onDelete('cascade');
        });
    }
};
