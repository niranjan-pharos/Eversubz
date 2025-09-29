<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropOrderUniqueIdFromOrderEventsTable extends Migration
{
    public function up()
    {
        Schema::table('order_events', function (Blueprint $table) {
            // Drop the order_unique_id column
            $table->dropColumn('order_unique_id');
        });
    }

    public function down()
    {
        Schema::table('order_events', function (Blueprint $table) {
            // If you need to rollback the migration, add the column back
            $table->string('order_unique_id')->nullable()->after('id');
        });
    }
}
