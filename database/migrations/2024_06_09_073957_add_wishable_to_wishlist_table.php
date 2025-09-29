<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWishableToWishlistTable extends Migration
{
    public function up()
    {
        Schema::table('wishlist', function (Blueprint $table) {
            $table->unsignedBigInteger('wishable_id')->after('user_id');
            $table->string('wishable_type')->after('wishable_id');
            $table->dropForeign(['ad_post_id']);
            $table->dropColumn('ad_post_id');
        });
    }

    public function down()
    {
        Schema::table('wishlist', function (Blueprint $table) {
            $table->dropColumn('wishable_id');
            $table->dropColumn('wishable_type');
            $table->unsignedBigInteger('ad_post_id')->after('user_id');
            $table->foreign('ad_post_id')->references('id')->on('ad_posts')->onDelete('cascade');
        });
    }
}