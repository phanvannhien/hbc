<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountriesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if( !Schema::hasTable('countries') ){
            Schema::create('countries', function(Blueprint $table) {
                $table->increments('id');
                $table->string('code',50);
                $table->string('value',200);
                $table->string('native',50);
                $table->string('phone',50);
                $table->string('continent',10);
                $table->string('capital',50);
                $table->string('currency',30);
                $table->string('languages',30);
                $table->boolean('active_default')->defaulsTo(0);
                $table->unique('code');
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
