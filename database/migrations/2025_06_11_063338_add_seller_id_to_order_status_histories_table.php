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
        Schema::table('order_status_histories', function (Blueprint $table) {
            $table->unsignedBigInteger('seller_id')->nullable()->after('store_order_item_id');

            // Optional: Add foreign key constraint
            $table->foreign('seller_id')->references('id')->on('user_business_infos')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('order_status_histories', function (Blueprint $table) {
            $table->dropForeign(['seller_id']);
            $table->dropColumn('seller_id');
        });
    }
};
