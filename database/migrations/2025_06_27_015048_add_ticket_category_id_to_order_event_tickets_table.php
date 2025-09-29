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
        Schema::table('order_event_tickets', function (Blueprint $table) {
            $table->unsignedBigInteger('ticket_category_id')->nullable()->after('ticket_type_id');
            $table->foreign('ticket_category_id')->references('id')->on('ticket_categories')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_event_tickets', function (Blueprint $table) {
            $table->dropForeign(['ticket_category_id']);
            $table->dropColumn('ticket_category_id');
        });
    }
};
