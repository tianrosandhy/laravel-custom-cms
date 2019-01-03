<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Instagram extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instagrams', function (Blueprint $table) {
            $table->increments('id');
            $table->string('instagram_id');
            $table->string('shortcode');
            $table->string('type', 10)->nullable();
            $table->string('link')->nullable();
            $table->string('hires_image_url')->nullable();
            $table->string('stored_url')->nullable();
            $table->text('caption')->nullable();
            $table->integer('likes')->nullable();
            $table->text('tags')->nullable();
            $table->string('video_url')->nullable();
            $table->integer('video_view')->nullable();
            $table->string('owner_id')->nullable();
            $table->tinyInteger('featured')->nullable();
            $table->tinyInteger('is_active')->nullable();
            $table->datetime('post_created')->nullable();
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
        Schema::dropIfExists('instagrams');
    }
}
