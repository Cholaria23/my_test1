<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSeoTitleFieldsToSchoolCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('school_category_translations', function (Blueprint $table) {
            $table->string('seo-title-1');
            $table->string('seo-title-2');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('school_category_translations', function (Blueprint $table) {
            $table->dropColumn('seo-title-1');
            $table->dropColumn('seo-title-2');
        });
    }
}
