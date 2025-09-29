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
        Schema::table('event_enquiries', function (Blueprint $table) {
            $table->string('module')->after('description')->default('event');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('event_enquiries', function (Blueprint $table) {
            $table->dropColumn('module');
        });
    }
};
