<?php

use Illuminate\Database\Seeder;

class MaintenanceCentreTableSeeder extends Seeder
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
                $id = DB::table('maintenance_centers')->insertGetId([
                    'created_at' => \Carbon\Carbon::now()
                ]);
                DB::table('maintenance_center_translations')->insert([
                    'title' => $faker->name(),
                    'content' => $faker->address() . '<br>ПН-СБ / с 8:00 - 20:00, ВС - ВЫХОДНОЙ<br>' . $faker->phoneNumber(),
                    'country' => $country['title'],
                    'city' => $city,
                    'locale' => 'ru',
                    'maintenance_center_id' => $id,
                    'created_at' => \Carbon\Carbon::now()
                ]);
                DB::table('maintenance_center_translations')->insert([
                    'title' => $faker->name(),
                    'content' => $faker->address() . '<br>ПН-СБ / с 8:00 - 20:00, ВС - ВЫХОДНОЙ<br>' . $faker->phoneNumber(),
                    'country' => $country['title'],
                    'city' => $city,
                    'locale' => 'en',
                    'maintenance_center_id' => $id,
                    'created_at' => \Carbon\Carbon::now()
                ]);
		DB::table('maintenance_center_translations')->insert([
                    'title' => $faker->name(),
                    'content' => $faker->address() . '<br>ПН-СБ / с 8:00 - 20:00, ВС - ВЫХОДНОЙ<br>' . $faker->phoneNumber(),
                    'country' => $country['title'],
                    'city' => $city,
                    'locale' => 'pt',
                    'maintenance_center_id' => $id,
                    'created_at' => \Carbon\Carbon::now()
                ]);

                DB::table('maintenance_center_translations')->insert([
                    'title' => $faker->name(),
                    'content' => $faker->address() . '<br>ПН-СБ / с 8:00 - 20:00, ВС - ВЫХОДНОЙ<br>' . $faker->phoneNumber(),
                    'country' => $country['title'],
                    'city' => $city,
                    'locale' => 'ua',
                    'maintenance_center_id' => $id,
                    'created_at' => \Carbon\Carbon::now()
                ]);
            }
        }
    }
}
