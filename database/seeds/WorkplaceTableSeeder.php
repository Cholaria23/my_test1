<?php

use Illuminate\Database\Seeder;

class WorkplaceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for ($i=1; $i<=15; $i++) {
            DB::table('workplaces')->insert([
                'slug' => 'test-workplace-' . $i,
                'created_at' => \Carbon\Carbon::now()
            ]);
            DB::table('workplace_translations')->insert([
                'title' => 'Тестовая вакансия ' . $i . ' (Страна, Город)',
                'content' => $faker->text($maxNbChars = 300),
                'locale' => 'ru',
                'workplace_id' => $i,
                'created_at' => \Carbon\Carbon::now()
            ]);
            DB::table('workplace_translations')->insert([
                'title' => 'Test vacancy ' . $i . ' (Country, City)',
                'content' => $faker->text($maxNbChars = 300),
                'locale' => 'en',
                'workplace_id' => $i,
                'created_at' => \Carbon\Carbon::now()
            ]);
	    DB::table('workplace_translations')->insert([
                'title' => 'Test vacancy ' . $i . ' (Country, City)',
                'content' => $faker->text($maxNbChars = 300),
                'locale' => 'pt',
                'workplace_id' => $i,
                'created_at' => \Carbon\Carbon::now()
            ]);

            DB::table('workplace_translations')->insert([
                'title' => 'Тестова вакансія ' . $i . ' (Країна, Місто)',
                'content' => $faker->text($maxNbChars = 300),
                'locale' => 'ua',
                'workplace_id' => $i,
                'created_at' => \Carbon\Carbon::now()
            ]);
        }
    }
}
