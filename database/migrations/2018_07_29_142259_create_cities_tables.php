<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitiesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if( !Schema::hasTable('cities') ){
            Schema::create('cities', function(Blueprint $table) {
                $table->increments('id');
                $table->string('city_name',50);
                $table->string('code',10);
                $table->boolean('published');
                $table->integer('ordering')->defaulsTo(0);
                $table->string('country_code',50);
                $table->integer('country_id');
                $table->string('slug',100)->nullable();
                $table->string('lat',50)->nullable();
                $table->string('lng',50)->nullable();
                $table->boolean('is_default');


                $table->foreign('country_code')->references('code')->on('countries')
                    ->onUpdate('cascade')->onDelete('cascade');
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
