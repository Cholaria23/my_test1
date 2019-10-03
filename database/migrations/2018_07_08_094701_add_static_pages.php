<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStaticPages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $languages = Config::get('app.locales');

        // agreement
        $pageId = DB::table('pages')->insertGetId([
            'slug' => 'agreement',
            'type' => 'agreement',
            'created_at' => \Carbon\Carbon::now()
        ]);
        $pageTitle = ['ru' => 'Соглашение', 'en' => 'Agreement', 'ua' => 'Угода'];
        foreach ($languages as $language) {
            DB::table('page_translations')->insert([
                'title' => $pageTitle[$language],
                'locale' => $language,
                'page_id' => $pageId,
                'created_at' => \Carbon\Carbon::now()
            ]);
        }
        $id = DB::table('page_fields')->insertGetId([
            'advanced_name' => 'agreement-text-1',
            'advanced_type' => 'text',
            'page_id' => $pageId,
            'created_at' => \Carbon\Carbon::now()
        ]);
        foreach ($languages as $lang) {
            DB::table('page_field_translations')->insert([
                'text' => 'agreement text ' . $lang,
                'locale' => $lang,
                'page_field_id' => $id,
                'created_at' => \Carbon\Carbon::now()
            ]);
        }

        // privacy_policy
        $pageId = DB::table('pages')->insertGetId([
            'slug' => 'privacy-policy',
            'type' => 'privacy_policy',
            'created_at' => \Carbon\Carbon::now()
        ]);
        $pageTitle = ['ru' => 'Политика конфиденциальности', 'en' => 'Privacy policy', 'ua' => 'Політика конфіденційності'];
        foreach ($languages as $language) {
            DB::table('page_translations')->insert([
                'title' => $pageTitle[$language],
                'locale' => $language,
                'page_id' => $pageId,
                'created_at' => \Carbon\Carbon::now()
            ]);
        }
        $id = DB::table('page_fields')->insertGetId([
            'advanced_name' => 'privacy-policy-text-1',
            'advanced_type' => 'text',
            'page_id' => $pageId,
            'created_at' => \Carbon\Carbon::now()
        ]);
        foreach ($languages as $lang) {
            DB::table('page_field_translations')->insert([
                'text' => 'privacy policy text ' . $lang,
                'locale' => $lang,
                'page_field_id' => $id,
                'created_at' => \Carbon\Carbon::now()
            ]);
        }

        // about_cookie
        $pageId = DB::table('pages')->insertGetId([
            'slug' => 'about-cookie',
            'type' => 'about_cookie',
            'created_at' => \Carbon\Carbon::now()
        ]);
        $pageTitle = ['ru' => 'Про Сookie', 'en' => 'About Сookie', 'ua' => 'Про Сookie'];
        foreach ($languages as $language) {
            DB::table('page_translations')->insert([
                'title' => $pageTitle[$language],
                'locale' => $language,
                'page_id' => $pageId,
                'created_at' => \Carbon\Carbon::now()
            ]);
        }
        $id = DB::table('page_fields')->insertGetId([
            'advanced_name' => 'cookie-text-1',
            'advanced_type' => 'text',
            'page_id' => $pageId,
            'created_at' => \Carbon\Carbon::now()
        ]);
        foreach ($languages as $lang) {
            DB::table('page_field_translations')->insert([
                'text' => 'about cookie text ' . $lang,
                'locale' => $lang,
                'page_field_id' => $id,
                'created_at' => \Carbon\Carbon::now()
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
        //
    }
}
