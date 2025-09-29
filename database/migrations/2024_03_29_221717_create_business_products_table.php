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
        if (!Schema::hasTable('business_products')) {
            Schema::create('business_products', function (Blueprint $table) {
                $table->id();
                $table->string('product_id')->nullable();
                $table->unsignedBigInteger('user_id');
                $table->string('title');
                $table->string('slug')->nullable();
                $table->unsignedBigInteger('category_id');
                $table->unsignedBigInteger('business_id');
                $table->unsignedBigInteger('subcategory_id')->nullable();
                $table->decimal('price', 8, 2);
                $table->decimal('mrp', 8, 2)->nullable();
                $table->text('description')->nullable();
                $table->text('main_image')->nullable();
                $table->string('video_url')->nullable();
                $table->string('item_url');
                $table->string('sku')->nullable();
                $table->tinyInteger('status')->default(0);
                $table->tinyInteger('feature')->default(0);
                $table->tinyInteger('orderby');
                $table->string('max_qty');
                $table->string('clicks_count')->default('0');
                $table->string('prview_count')->default('0');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('business_products');
    }
};
