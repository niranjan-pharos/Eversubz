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
        Schema::table('languages', function (Blueprint $table) {
            $table->nullableMorphs('languageable');
        });
    }

    public function down()
    {
        Schema::table('languages', function (Blueprint $table) {
            $table->dropMorphs('languageable');
        });
    }
};
