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
        Schema::table('store_order_items', function (Blueprint $table) {
            $table->unsignedBigInteger('seller_id')->nullable()->after('product_id');
            $table->unsignedBigInteger('user_id')->nullable()->after('seller_id');

            // Foreign keys (optional)
            $table->foreign('seller_id')->references('id')->on('user_business_infos')->onDelete('set null');
            $table->foreign('user_id')->references('user_id')->on('user_business_infos')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('store_order_items', function (Blueprint $table) {
            $table->dropForeign(['seller_id']);
            $table->dropForeign(['user_id']);
            $table->dropColumn(['seller_id', 'user_id']);
        });
    }
};
