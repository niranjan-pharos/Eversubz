<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('business_products', function (Blueprint $table) {
            // Drop old foreign keys and columns if they exist
            if (Schema::hasColumn('business_products', 'business_category_id')) {
                $table->dropForeign(['business_category_id']);
                $table->dropColumn('business_category_id');
            }

            // Add new foreign key references
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('subcategory_id')->nullable();

            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('subcategory_id')->references('id')->on('subcategories');
        });
    }

    public function down()
    {
        Schema::table('business_products', function (Blueprint $table) {
            // Drop new foreign keys
            $table->dropForeign(['category_id']);
            $table->dropForeign(['subcategory_id']);

            // Remove the columns
            $table->dropColumn(['category_id', 'subcategory_id']);

            // Optionally add back the original business category references if needed
        });
    }
};
