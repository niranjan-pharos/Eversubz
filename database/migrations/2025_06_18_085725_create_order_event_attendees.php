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
        Schema::create('order_event_attendees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->onDelete('cascade');
            $table->foreignId('ticket_type_id')->constrained('event_ticket_types')->onDelete('cascade');
            $table->foreignId('order_event_id')->constrained()->onDelete('cascade');
            $table->foreignId('order_event_ticket_id')->constrained()->onDelete('cascade');
            $table->json('attendee_fields')->nullable();
            $table->boolean('is_present')->default(0);
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_event_attendees', function (Blueprint $table) {
            $table->dropColumn('attendee_fields');
        });
    }
};
