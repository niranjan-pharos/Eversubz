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
            // Add the new column
            $table->integer('account_type')->default(0)->after('account_type');
        });

        // Copy data from account_type to account_type
        DB::table('users')->update(['account_type' => DB::raw('account_type')]);

        // Drop the old column
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('account_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Add the old column back
            $table->boolean('account_type')->default(0)->after('account_type');
        });

        // Copy data back from account_type to account_type
        DB::table('users')->update(['account_type' => DB::raw('account_type')]);

        // Drop the new column
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('account_type');
        });
    }
};
