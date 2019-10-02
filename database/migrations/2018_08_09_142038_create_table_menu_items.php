<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMenuItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('menu_items', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('menu_id');
            $table->integer('parent_id')->defaultsTo(0);
            $table->integer('menu_order')->defaultsTo(0);
            $table->integer('menu_level')->defaultsTo(0);
            $table->string('menu_link',254);
            $table->string('type',50);
            $table->boolean('menu_status')->defaultsTo(1);
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
        //
    }
}
