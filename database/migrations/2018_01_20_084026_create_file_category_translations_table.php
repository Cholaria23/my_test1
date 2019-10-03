<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFileCategoryTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_category_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('locale')->index();
            $table->integer('file_category_id')->unsigned();
            $table->foreign('file_category_id')->references('id')->on('file_categories')->onDelete('cascade');
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
        Schema::dropIfExists('file_category_translations');
    }
}
