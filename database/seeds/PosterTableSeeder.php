<?php

use Illuminate\Database\Seeder;
use App\Models\PosterCategory;

class PosterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = DB::table('poster_categories')->select('id')->get()->toArray();

        $faker = Faker\Factory::create();

        for ($i = 1; $i <= 15; $i++) {
            $key = array_rand($categories);
            $obj = $categories[$key];
            DB::table('posters')->insert([
                'slug' => 'poster-' . $i,
                'poster_category_id' => $obj->id,
                'created_at' => \Carbon\Carbon::now()
            ]);
            DB::table('poster_translations')->insert([
                'title' => 'Тестовое объявление ' . $i,
                'content' => $faker->text($maxNbChars = 300),
                'locale' => 'ru',
                'poster_id' => $i,
                'created_at' => \Carbon\Carbon::now()
            ]);
            DB::table('poster_translations')->insert([
                'title' => 'Test poster ' . $i,
                'content' => $faker->text($maxNbChars = 300),
                'locale' => 'en',
                'poster_id' => $i,
                'created_at' => \Carbon\Carbon::now()
            ]);
	    DB::table('poster_translations')->insert([
                'title' => 'Test poster ' . $i,
                'content' => $faker->text($maxNbChars = 300),
                'locale' => 'pt',
                'poster_id' => $i,
                'created_at' => \Carbon\Carbon::now()
            ]);
            DB::table('poster_translations')->insert([
                'title' => 'Тестове оголошення ' . $i,
                'content' => $faker->text($maxNbChars = 300),
                'locale' => 'ua',
                'poster_id' => $i,
                'created_at' => \Carbon\Carbon::now()
            ]);
        }
    }
}
