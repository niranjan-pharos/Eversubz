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
        Schema::create('candidate_experiences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('job_title'); // Example: Software Engineer
            $table->string('company'); // Example: Google
            $table->date('from_date')->nullable(); // Start date
            $table->date('to_date')->nullable(); // End date
            $table->boolean('ongoing')->default(false); // If it's still ongoing
            $table->text('description')->nullable(); // Job responsibilities
            $table->string('location')->nullable(); // Example: San Francisco, USA
            $table->string('job_type')->nullable(); // Example: Full-Time
            $table->string('portfolio_url')->nullable(); // Link to work/portfolio
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('experiences');
    }
};
