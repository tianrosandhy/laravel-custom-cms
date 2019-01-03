<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NavigationItem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('navigation_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('group_id');
            $table->string('title');
            $table->string('type');
            $table->string('url')->nullable();
            $table->string('route')->nullable();
            $table->string('parameter')->nullable();
            $table->string('category_slug')->nullable();
            $table->string('post_slug')->nullable();
            $table->string('page_slug')->nullable();
            $table->string('icon')->nullable();
            $table->tinyinteger('new_tab')->default(0);
            $table->integer('sort_no')->nullable();
            $table->integer('parent')->default(0);
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
        Schema::dropIfExists('navigation_items');
    }
}
