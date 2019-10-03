<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCountrySlug extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('countries', function (Blueprint $table) {
            $table->string('slug')->nullable()->unique();
        });

        $country_translations = DB::table('country_translations')->where('locale', 'en')->get();
        foreach ($country_translations as $country_translation) {
            DB::table('countries')->where('id', $country_translation->country_id)->update([
                'slug' => str_replace(' ', '-', strtolower($country_translation->title))
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('countries', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
}
