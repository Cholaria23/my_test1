<?php

use Illuminate\Database\Seeder;

class PosterCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('poster_categories')->insert([
            'slug' => 'buy',
            'created_at' => \Carbon\Carbon::now()
        ]);
        DB::table('poster_category_translations')->insert([
            'title' => 'Покупаем',
            'locale' => 'ru',
            'poster_category_id' => 1,
            'created_at' => \Carbon\Carbon::now()
        ]);
        DB::table('poster_category_translations')->insert([
            'title' => 'Buy',
            'locale' => 'en',
            'poster_category_id' => 1,
            'created_at' => \Carbon\Carbon::now()
        ]);
	DB::table('poster_category_translations')->insert([
            'title' => 'Buy',
            'locale' => 'pt',
            'poster_category_id' => 1,
            'created_at' => \Carbon\Carbon::now()
        ]);

        DB::table('poster_category_translations')->insert([
            'title' => 'Купуємо',
            'locale' => 'ua',
            'poster_category_id' => 1,
            'created_at' => \Carbon\Carbon::now()
        ]);

        DB::table('poster_categories')->insert([
            'slug' => 'sell',
            'created_at' => \Carbon\Carbon::now()
        ]);
        DB::table('poster_category_translations')->insert([
            'title' => 'Продаём',
            'locale' => 'ru',
            'poster_category_id' => 2,
            'created_at' => \Carbon\Carbon::now()
        ]);
        DB::table('poster_category_translations')->insert([
            'title' => 'Sell',
            'locale' => 'en',
            'poster_category_id' => 2,
            'created_at' => \Carbon\Carbon::now()
        ]);
	 DB::table('poster_category_translations')->insert([
            'title' => 'Sell',
            'locale' => 'pt',
            'poster_category_id' => 2,
            'created_at' => \Carbon\Carbon::now()
        ]);
        DB::table('poster_category_translations')->insert([
            'title' => 'Продаємо',
            'locale' => 'ua',
            'poster_category_id' => 2,
            'created_at' => \Carbon\Carbon::now()
        ]);
    }
}
