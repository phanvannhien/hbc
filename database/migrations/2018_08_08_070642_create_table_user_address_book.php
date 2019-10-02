<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUserAddressBook extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address_book', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('user_id');
            $table->string('full_name',200);
            $table->string('phone',200);
            $table->integer('province_id');
            $table->integer('districtid');
            $table->integer('wardid');
            $table->string('address',254);


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
