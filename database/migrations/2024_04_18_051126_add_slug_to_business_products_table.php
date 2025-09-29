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
            $table->string('slug')->unique()->nullable()->after('title'); // Adjust column name 'name' as per your table structure
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('business_products', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};
