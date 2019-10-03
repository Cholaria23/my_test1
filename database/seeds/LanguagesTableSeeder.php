<?php

use Illuminate\Database\Seeder;

class LanguagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('languages')->insert([
            'title' => 'Русский',
            'code' => 'ru'
        ]);
        DB::table('languages')->insert([
            'title' => 'Українська',
            'code' => 'ua'
        ]);
        DB::table('languages')->insert([
            'title' => 'English',
            'code' => 'en'
        ]);
        DB::table('languages')->insert([
            'title' => 'Portugal',
            'code' => 'pt'
        ]);

    }
}
