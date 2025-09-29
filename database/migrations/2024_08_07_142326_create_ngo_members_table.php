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
        Schema::create('ngo_members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ngo_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('designation');
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ngo_members');
    }
};
