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
    Schema::create('order_status_histories', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('store_order_id');
        $table->string('changed_by_type'); // 'seller', 'user', or 'admin'
        $table->unsignedBigInteger('changed_by')->nullable();
        $table->string('from_status');
        $table->string('to_status');
        $table->text('comment')->nullable();
        $table->timestamps();

        $table->foreign('store_order_id')->references('id')->on('store_orders')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_status_histories');
    }
};
