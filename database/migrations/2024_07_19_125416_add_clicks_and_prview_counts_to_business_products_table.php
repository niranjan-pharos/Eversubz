<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('business_products', function (Blueprint $table) {
            $table->unsignedInteger('clicks_count')->default(0);
            $table->unsignedInteger('prview_count')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('business_products', function (Blueprint $table) {
            $table->dropColumn(['clicks_count', 'prview_count']);
        });
    }
};
