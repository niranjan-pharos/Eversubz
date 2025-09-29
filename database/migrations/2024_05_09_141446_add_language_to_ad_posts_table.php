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
        Schema::table('ad_posts', function (Blueprint $table) {
            Schema::table('ad_posts', function (Blueprint $table) {
                $table->string('languages')->nullable()->after('title'); // Assuming you want it after the 'title' column
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ad_posts', function (Blueprint $table) {
            $table->dropColumn('languages');
        });
    }
};
