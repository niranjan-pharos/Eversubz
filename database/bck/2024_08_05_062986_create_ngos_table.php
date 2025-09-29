<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNgosTable extends Migration
{
    public function up()
    {
        Schema::create('ngos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('cat_id'); 
            $table->string('ngo_name');
            $table->string('contact_email');
            $table->year('establishment')->nullable();
            $table->json('languages')->nullable();
            $table->string('abn')->nullable();
            $table->string('acnc')->nullable();
            $table->string('gst')->nullable();
            $table->string('size')->nullable();
            $table->string('ngo_address')->nullable();
            $table->string('ngo_city');
            $table->string('ngo_state')->nullable();
            $table->string('ngo_country')->nullable();
            $table->string('contact_phone', 25)->nullable();
            $table->string('website_url')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->boolean('feature')->default(false);
            $table->integer('orderby')->default(0);
            $table->string('logo_path')->nullable();
            $table->text('ngo_description')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('created_by_admin')->default(0);
            $table->timestamps();

            // Add the foreign key constraint after all columns have been defined
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('cat_id')->references('id')->on('ngo_categories')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('ngos');
    }
}
