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
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('ngo_id')->nullable()->after('id');
            $table->date('ngo_join_date')->nullable()->after('ngo_id'); 

            $table->foreign('ngo_id')->references('id')->on('ngos')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('ngo_id');
            $table->dropColumn('ngo_join_date');
        });
    }
};
