<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchoolTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('country');
            $table->string('city');
            $table->integer('school_id')->nullable(true)->unsigned()->index();
            $table->foreign('school_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('locale')->index();
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
        Schema::dropIfExists('school_translations');
    }
}
