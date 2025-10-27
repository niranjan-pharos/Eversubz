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
        Schema::table('category_candidates', function (Blueprint $table) {
            // Add fundraising_id column after 'id'
            if (!Schema::hasColumn('category_candidates', 'fundraising_id')) {
                $table->unsignedBigInteger('fundraising_id')->nullable()->after('id');
                $table->foreign('fundraising_id')->references('id')->on('fundraisings')->onDelete('set null');
            }

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('category_candidates', function (Blueprint $table) {
            $table->dropForeign(['fundraising_id']); // drop foreign key first
            $table->dropColumn('fundraising_id');    // then drop the column
        });
    }
};
