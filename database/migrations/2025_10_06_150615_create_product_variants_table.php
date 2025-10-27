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
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id'); // foreign key column
            $table->string('variant');                // e.g., Size - M, Color - Red
            $table->string('sku')->unique();          // stock keeping unit
            $table->decimal('price', 10, 2)->default(0);
            $table->integer('quantity')->default(0);
            $table->string('image')->nullable();      // store image path
            $table->integer('isactive')->default(1);
            $table->timestamps();

            // Foreign Key Constraint
            $table->foreign('product_id')
                ->references('id')
                ->on('business_products')
                ->onDelete('cascade'); // if product deleted, variants deleted too
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variants');
    }
};
