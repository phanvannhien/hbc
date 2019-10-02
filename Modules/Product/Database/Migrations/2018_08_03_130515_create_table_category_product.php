<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCategoryProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_product', function (Blueprint $table) {
            $table->increments('id');
            $table->string('category_image')->nullable();
            $table->integer('category_order')->unsigned()->defaulsTo(0);
            $table->integer('category_level')->unsigned()->defaulsTo(0);
            $table->integer('parent_id')->unsigned()->defaulsTo(0);
            $table->boolean('category_status', false)->defaulsTo(1);
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
        Schema::dropIfExists('category_product');
    }
}
