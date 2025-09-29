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
        Schema::create('event_ticket_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->enum('ticket_type', ['adult', 'children', 'na'])->default('adult');
            $table->enum('category', ['regular', 'early_bird', 'vip'])->default('regular');
            $table->decimal('price', 10, 2)->default(0);
            $table->boolean('is_free')->default(false);
            $table->integer('max_quantity')->default(0);
            $table->integer('sold_quantity')->default(0);
            $table->enum('status', ['active', 'inactive', 'sold_out'])->default('active');
            $table->text('description')->nullable();
            $table->string('icon')->nullable();
            $table->json('attendee_fields')->nullable();
            $table->timestamps();
        });
        
    }
 
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_ticket_types');
    }
};
