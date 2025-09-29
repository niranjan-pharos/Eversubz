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
            // Add the 'status' column with boolean type and default value
            $table->boolean('status')->default(false)->after('slug');
        });
    }

    public function down()
    {
        Schema::table('fundraising', function (Blueprint $table) {
            // Remove the 'status' column if rolling back
            $table->dropColumn('status');
        });
    }
};
