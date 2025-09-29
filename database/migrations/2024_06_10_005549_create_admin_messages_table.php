<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminMessagesTable extends Migration
{
    public function up()
    {
        Schema::create('admin_messages', function (Blueprint $table) {
            $table->id();
            $table->string('heading');
            $table->text('description');
            $table->integer('orderby')->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('admin_messages');
    }
}
