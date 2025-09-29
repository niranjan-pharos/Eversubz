<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration {
    public function up()
    {
        // Check if the column already exists
        if (!Schema::hasColumn('order_events', 'order_event_unique_id')) {
            Schema::table('order_events', function (Blueprint $table) {
                // Add the order_event_unique_id column as nullable
                $table->string('order_event_unique_id')->nullable()->after('id');
            });
        }

        // Generate unique ids for the existing records if the column exists
        DB::table('order_events')->get()->each(function ($order) {
            if (!$order->order_event_unique_id) {
                // Create a unique order_event_unique_id (5 random letters + ID)
                $uniqueId = strtoupper(Str::random(5)) . $order->id;
                DB::table('order_events')
                    ->where('id', $order->id)
                    ->update(['order_event_unique_id' => $uniqueId]);
            }
        });

        // Check if the unique index already exists
        $indexExists = DB::select("SHOW INDEXES FROM order_events WHERE Key_name = 'order_events_order_event_unique_id_unique'");

        if (empty($indexExists)) {
            // Add the unique index if it doesn't exist
            Schema::table('order_events', function (Blueprint $table) {
                $table->unique('order_event_unique_id');
            });
        }
    }

    public function down()
    {
        Schema::table('order_events', function (Blueprint $table) {
            $table->dropUnique(['order_event_unique_id']);
            $table->dropColumn('order_event_unique_id');
        });
    }
};
