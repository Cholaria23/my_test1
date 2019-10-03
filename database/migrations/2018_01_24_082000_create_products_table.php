<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
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
            $table->integer('views')->default(0);
            $table->string('slug')->unique();
            $table->string('model');
            $table->string('sku');
            $table->string('preview_image_1')->nullable();
            $table->string('preview_image_2')->nullable();
            $table->string('video')->nullable();
            $table->boolean('is_set')->default(false)->nullable();
            $table->boolean('publish')->default(true)->nullable();
            $table->integer('product_category_id')->unsigned();
            $table->foreign('product_category_id')->references('id')->on('product_categories')->onDelete('cascade');
            $table->softDeletes();
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
        Schema::dropIfExists('products');
    }
}
