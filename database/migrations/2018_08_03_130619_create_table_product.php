<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('product_code');
            $table->string('product_cas');
            $table->string('product_sku');
            $table->string('product_name');
            $table->string('product_synonym');
            $table->string('product_slug');
            $table->string('product_grade');
            $table->string('product_concentration');
            $table->string('product_formular');
            $table->string('product_weight');
            $table->string('product_tolerance');
            $table->string('product_neck_size');
            $table->string('product_material');
            $table->string('brand');
//            $table->string('brand');

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
        Schema::dropIfExists('');
    }
}
