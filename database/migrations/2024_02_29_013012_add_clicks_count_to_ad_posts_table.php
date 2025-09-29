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
        if (!Schema::hasColumn('ad_posts', 'clicks_count')) {
            $table->unsignedInteger('clicks_count')->default(0);
        }
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ad_posts', function (Blueprint $table) {
            $table->dropColumn('clicks_count');
        });
    }
};
