<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PostComment extends Migration
{

    public function up()
    {
        Schema::create('post_comments', function(Blueprint $tb){
            $tb->increments('id');
            $tb->integer('id_post');
            $tb->string('email');
            $tb->string('first_name')->nullable();
            $tb->string('last_name')->nullable();
            $tb->text('message')->nullable();
            $tb->integer('reply_to')->nullable();
            $tb->timestamps();
            $tb->tinyInteger('spam')->nullable();
            $tb->string('spam_reason')->nullable();
            $tb->tinyInteger('is_active')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_comments');
    }
}
