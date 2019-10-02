<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLanguagesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if( !Schema::hasTable('languages') ){
            Schema::create('languages', function(Blueprint $table) {
                $table->increments('id');
                $table->string('code',10);
                $table->string('name',50);
                $table->string('icon',50);
                $table->unique('active')->defaulsTo(0);

                $table->primary('code');
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
