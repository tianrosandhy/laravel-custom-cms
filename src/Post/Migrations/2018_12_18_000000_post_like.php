<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PostLike extends Migration
{

    public function up()
    {
        Schema::create('post_likes', function(Blueprint $tb){
            $tb->increments('id');
            $tb->integer('id_post');
            $tb->string('ip');
            $tb->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_likes');
    }
}
