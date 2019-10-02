<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::table('countries', function (Blueprint $table) {
//            $table->foreign('continent')->references('id')->on('continents')->onDelete('cascade');;
//        });
//
//        Schema::table('cities', function (Blueprint $table) {
//            $table->foreign('country_code')->references('code')->on('countries')->onDelete('cascade');;
//        });
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
