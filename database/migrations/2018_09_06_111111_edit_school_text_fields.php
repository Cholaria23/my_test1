<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditSchoolTextFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('school_translations', function (Blueprint $table) {
            $table->dropColumn('short_text');
            $table->text('content')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('school_translations', function (Blueprint $table) {
            $table->text('short_text')->nullable();
            $table->text('content')->nullable(false)->change();
        });
    }
}
