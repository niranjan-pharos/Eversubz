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
        Schema::table('fundraising', function (Blueprint $table) {
            // Drop the existing foreign key constraint
            $table->dropForeign(['category_id']);
            
            // Change the column type if needed (assuming it's an unsigned big integer)
            $table->unsignedBigInteger('category_id')->change();

            // Add the new foreign key constraint
            $table->foreign('category_id')->references('id')->on('fundraising_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('fundraising', function (Blueprint $table) {
            // Drop the updated foreign key constraint
            $table->dropForeign(['category_id']);

            // Revert the column type if needed (assuming it's an unsigned big integer)
            $table->foreignId('category_id')->constrained('categories'); // Change 'categories' back if needed
        });
    }
};
