<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttibuteCategoryToProductCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attribute_category_to_product_category', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_category_id')->references('id')->on('product_categories');
            $table->integer('attribute_category_id')->references('id')->on('attribute_categories');
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
        Schema::dropIfExists('attribute_category_to_product_category');
    }
}
