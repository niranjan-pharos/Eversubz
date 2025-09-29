<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCreatedByAdminToUserBusinessInfosTable extends Migration
{
    public function up()
    {
        Schema::table('user_business_infos', function (Blueprint $table) {
            $table->boolean('created_by_admin')->default(0);
        });
    }

    public function down()
    {
        Schema::table('user_business_infos', function (Blueprint $table) {
            $table->dropColumn('created_by_admin');
        });
    }
}