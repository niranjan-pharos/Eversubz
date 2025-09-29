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
        Schema::create('ad_posts', function (Blueprint $table) {
            $table->id();
            $table->integer('post_id');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->foreignId('category_id')->constrained();
            $table->foreignId('subcategory_id')->constrained();
            $table->integer('ad_id')->unique();
            $table->string('price_condition')->nullable();
            $table->string('ad_category')->nullable();
            $table->string('product_condition')->nullable();
            $table->string('abn')->nullable();
            $table->text('location')->nullable();
            $table->text('description')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->tinyInteger('featured')->default(0);
            $table->tinyInteger('recommended')->default(0);
            $table->tinyInteger('urgent')->default(0);
            $table->tinyInteger('spotlight')->default(0);
            $table->string('clicks_count')->nullable();
            $table->tinyInteger('status')->default(0)->comment('0: Inactive, 1: Active');
            $table->decimal('price', 8, 2);
            $table->decimal('offer_price', 8, 2)->nullable();
            $table->string('video_url')->nullable();
            $table->string('author_name')->nullable();
            $table->string('author_email')->nullable();
            $table->string('author_phone')->nullable();
            $table->string('author_address')->nullable();
            $table->string('prview_count')->default(0);
            $table->string('item_url')->unique();
            $table->dateTime('expiry_date')->nullable();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ad_posts');
    }
};
