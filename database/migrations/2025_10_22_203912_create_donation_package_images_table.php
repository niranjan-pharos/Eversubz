<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('donation_package_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('donation_package_id')
                  ->constrained('donation_packages')
                  ->cascadeOnDelete(); // delete images when package is deleted
            $table->string('image'); // stored path (e.g., storage/app/public/...)
            $table->unsignedInteger('position')->default(0); // optional for ordering
            $table->timestamps();

            $table->index(['donation_package_id', 'position']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('donation_package_images');
    }
};
