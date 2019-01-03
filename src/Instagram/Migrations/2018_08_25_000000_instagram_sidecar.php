<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InstagramSidecar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instagram_sidecars', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('instagram_id');
            $table->string('type')->nullable();
            $table->string('hires_image_url')->nullable();
            $table->string('stored_url')->nullable();
            $table->string('video_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('instagram_sidecars');
    }
}
