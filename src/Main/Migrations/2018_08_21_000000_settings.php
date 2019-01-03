<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Settings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings_structure', function (Blueprint $table) {
            $table->increments('id');
            $table->string('param');
            $table->string('name');
            $table->text('description')->nullable();
            $table->text('default_value')->nullable();
            $table->string('type')->nullable();
            $table->string('group')->nullable();
            $table->timestamps();
        });

        Schema::create('settings', function(Blueprint $table){
        	$table->increments('id');
        	$table->integer('id_user');
        	$table->string('param');
        	$table->text('value');
            $table->text('options');
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
        Schema::dropIfExists('settings_structure');
        Schema::dropIfExists('settings');
    }
}
