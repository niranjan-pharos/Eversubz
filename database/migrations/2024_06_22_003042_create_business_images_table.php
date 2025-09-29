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
        Schema::create('business_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_business_infos_id');
            $table->string('image_path');
            $table->timestamps();

            $table->foreign('user_business_infos_id')
                  ->references('id')->on('user_business_infos')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('business_images');
    }
};
