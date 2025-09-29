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
        Schema::table('fundraising', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('ngo_id')->nullable()->after('user_id'); // Add ngo_id after user_id
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fundraising', function (Blueprint $table) {
            //
            $table->dropColumn('ngo_id'); // Remove the ngo_id column
        });
    }
};
