<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if( !Schema::hasTable('categories') ){
            Schema::create('categories', function (Blueprint $table) {
                $table->increments('id');
                $table->string('category_image');
                $table->integer('parent_id')->unsigned()->defaulsTo(0);
                $table->tinyInteger('status', false)->defaulsTo(0);
                $table->timestamps();
            });
        }
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
