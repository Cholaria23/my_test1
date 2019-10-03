<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFormRequestsFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('form_requests', function (Blueprint $table) {
            $table->string('country')->nullable();
            $table->string('post')->nullable();
            $table->string('company_name')->nullable();
            $table->string('business')->nullable();
            $table->string('web')->nullable();
            $table->boolean('agree')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('form_requests', function (Blueprint $table) {
            $table->dropColumn('country');
            $table->dropColumn('post');
            $table->dropColumn('company_name');
            $table->dropColumn('business');
            $table->dropColumn('web');
            $table->dropColumn('agree');
        });
    }
}
