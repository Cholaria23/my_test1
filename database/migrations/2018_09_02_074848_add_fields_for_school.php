<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsForSchool extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('schools', function (Blueprint $table) {
            $table->string('slug')->nullable()->unique();
            $table->string('website')->nullable();
            $table->string('youtube')->nullable();
            $table->string('vk')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('schools', function (Blueprint $table) {
            $table->dropColumn('slug');
            $table->dropColumn('website');
            $table->dropColumn('youtube');
            $table->dropColumn('vk');
        });
    }
}
