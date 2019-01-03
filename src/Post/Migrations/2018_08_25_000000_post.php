<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Post extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('slug');
            $table->string('tags')->nullable();
            $table->text('excerpt')->nullable();
            $table->text('body')->nullable();
            $table->string('image')->nullable();
            $table->tinyinteger('is_active')->nullable();
            $table->tinyinteger('featured')->nullable();
            $table->integer('click')->nullable();
            $table->timestamps();
        });

        Schema::create('categories', function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->integer('order');
            $table->timestamps();
        });

        Schema::create('post_to_categories', function(Blueprint $table){
            $table->increments('id');
            $table->integer('post_id');
            $table->integer('category_id');
            $table->timestamps();
        });

        Schema::create('post_related', function(Blueprint $table){
            $table->increments('id');
            $table->integer('post_source');
            $table->integer('post_related_id');
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
        Schema::dropIfExists('posts');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('post_to_categories');
        Schema::dropIfExists('post_related');
    }
}
