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
            $table->string('permanent_city')->nullable()->after('email'); // Or place it after any column
            $table->string('permanent_state')->nullable()->after('permanent_city');
            $table->string('permanent_country')->nullable()->after('permanent_state');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['permanent_city', 'permanent_state', 'permanent_country']);
        });
    }
};
