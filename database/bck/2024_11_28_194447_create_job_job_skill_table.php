<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobJobSkillTable extends Migration
{
    public function up()
    {
        Schema::create('job_job_skill', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_id')->constrained()->onDelete('cascade');
            $table->foreignId('job_skill_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            
            // Optional: add a unique constraint to prevent duplicate entries
            $table->unique(['job_id', 'job_skill_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('job_job_skill');
    }
}