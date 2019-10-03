<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePageFieldTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_field_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('string')->nullable();
            $table->text('text')->nullable();
            $table->string('locale')->index();
            $table->integer('page_field_id')->unsigned();
            $table->foreign('page_field_id')->references('id')->on('page_fields')->onDelete('cascade');
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
        Schema::dropIfExists('page_field_translations');
    }
}
