<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('uid', 6)->unique()->nullable()->after('id');
        });

        // Backfill existing users with unique 6-digit random numbers
        $users = DB::table('users')->get();
        $used = [];

        foreach ($users as $user) {
            do {
                $uid = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
            } while (in_array($uid, $used) || DB::table('users')->where('uid', $uid)->exists());

            $used[] = $uid;

            DB::table('users')
                ->where('id', $user->id)
                ->update(['uid' => $uid]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('uid');
        });
    }
};
