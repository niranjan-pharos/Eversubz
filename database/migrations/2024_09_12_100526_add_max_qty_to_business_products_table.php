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
            $table->integer('max_qty')->nullable()->after('orderby'); // Add the max_qty column after the orderby column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('business_products', function (Blueprint $table) {
            $table->dropColumn('max_qty');
        });
    }
};
