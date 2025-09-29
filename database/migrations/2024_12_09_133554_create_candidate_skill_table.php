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
        Schema::create('candidate_skill', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('candidate_profile_id');
            $table->unsignedBigInteger('skill_id');
            $table->enum('proficiency_level', ['beginner', 'intermediate', 'expert'])->nullable();
            $table->timestamps();
        
            $table->foreign('candidate_profile_id')->references('id')->on('candidate_profiles')->onDelete('cascade');
            $table->foreign('skill_id')->references('id')->on('skills')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidate_skill');
    }
};
