<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchoolToSchoolCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_to_school_category', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('school_id')->references('id')->on('schools');
            $table->integer('school_category_id')->references('id')->on('school_categories');
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
        Schema::dropIfExists('school_to_school_category');
    }
}
