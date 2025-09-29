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
        Schema::table('user_business_hours', function (Blueprint $table) {
            // Assuming 'user_business_info_id' is the name of the new foreign key column
            $table->unsignedBigInteger('user_business_info_id')->nullable();
            $table->foreign('user_business_info_id')->references('id')->on('user_business_infos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_business_hours', function (Blueprint $table) {
            $table->dropForeign(['user_business_info_id']);
            $table->dropColumn('user_business_info_id');
        });
    }
};
