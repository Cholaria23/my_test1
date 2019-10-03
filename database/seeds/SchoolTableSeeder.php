<?php

use Illuminate\Database\Seeder;

class SchoolTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $countries = [
            [
                'title' => 'Украина',
                'cities' => ['Харьков', 'Киев', 'Днепр', 'Одесса']
            ],
            [
                'title' => 'Россия',
                'cities' => ['Москва', 'Питер', 'Ростов', 'Челябенск']
            ],
            [
                'title' => 'USA',
                'cities' => ['New York', 'Los Angeles', 'Chicago', 'Houston']
            ]
        ];

        foreach ($countries as $i => $country) {
            foreach ($country['cities'] as $city) {
                $id = DB::table('schools')->insertGetId([
                    'facebook' => '#',
                    'viber' => '#',
                    'twitter' => '#',
                    'instagram' => '#',
                    'google' => '#',
                    'created_at' => \Carbon\Carbon::now()
                ]);
                DB::table('school_translations')->insert([
                    'title' => $faker->name(),
                    'country' => $country['title'],
                    'city' => $city,
                    'locale' => 'ru',
                    'school_id' => $id,
                    'created_at' => \Carbon\Carbon::now()
                ]);
                DB::table('school_translations')->insert([
                    'title' => $faker->name(),
                    'country' => $country['title'],
                    'city' => $city,
                    'locale' => 'en',
                    'school_id' => $id,
                    'created_at' => \Carbon\Carbon::now()
                ]);
		DB::table('school_translations')->insert([
                    'title' => $faker->name(),
                    'country' => $country['title'],
                    'city' => $city,
                    'locale' => 'pt',
                    'school_id' => $id,
                    'created_at' => \Carbon\Carbon::now()
                ]);
                DB::table('school_translations')->insert([
                    'title' => $faker->name(),
                    'country' => $country['title'],
                    'city' => $city,
                    'locale' => 'ua',
                    'school_id' => $id,
                    'created_at' => \Carbon\Carbon::now()
                ]);
            }
        }
    }
}
