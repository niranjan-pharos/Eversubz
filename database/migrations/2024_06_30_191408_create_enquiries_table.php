<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('enquiries', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('name'); // User's first name
            $table->string('last_name')->nullable(); // User's last name
            $table->string('email'); // Email address
            $table->string('phone')->nullable(); // Phone number
            $table->text('description')->nullable(); // Description
            $table->string('module'); // Module name
            $table->date('appointment_date')->nullable(); // Appointment date
            $table->time('appointment_time')->nullable(); // Appointment time
            $table->unsignedBigInteger('enquiryable_id'); // Polymorphic relationship ID
            $table->string('enquiryable_type'); // Polymorphic relationship type
            $table->timestamps(); // Created at and updated at timestamps

            // Indexes for faster lookup
            $table->index(['enquiryable_id', 'enquiryable_type']);
        });
    }

    public function down()
    {
        // Drop the new table if the migration is rolled back
        Schema::dropIfExists('enquiries');
    }
};
