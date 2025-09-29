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
        Schema::create('candidate_educations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('degree'); 
            $table->string('institution');
            $table->string('field_of_study')->nullable();
            $table->date('from_date')->nullable();
            $table->date('to_date')->nullable(); 
            $table->boolean('ongoing')->default(false); 
            $table->string('grade')->nullable(); 
            $table->string('location')->nullable();
            $table->text('achievements')->nullable(); // Example: Awards, Scholarships
            $table->text('description')->nullable();
            $table->string('certificate_url')->nullable();
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('educations');
    }
};
