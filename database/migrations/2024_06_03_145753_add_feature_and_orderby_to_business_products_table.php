<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFeatureAndOrderbyToBusinessProductsTable extends Migration
{
    public function up()
    {
        Schema::table('business_products', function (Blueprint $table) {
            $table->boolean('feature')->default(false);
            $table->integer('orderby')->default(0);
        });
    }

    public function down()
    {
        Schema::table('business_products', function (Blueprint $table) {
            $table->dropColumn('feature');
            $table->dropColumn('orderby');
        });
    }
}
