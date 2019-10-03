<?php

use Illuminate\Database\Seeder;

class ServiceCentreTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for ($i=1; $i<=4; $i++) {
            DB::table('service_centers')->insert([
                'created_at' => \Carbon\Carbon::now()
            ]);
            DB::table('service_center_translations')->insert([
                'title' => 'Тестовый сервисный центер ' . $i,
                'address' => $faker->address(),
                'schedule' => 'ПН-СБ / с 8:00 - 20:00, ВС - ВЫХОДНОЙ',
                'phones' => $faker->phoneNumber(),
                'locale' => 'ru',
                'service_center_id' => $i,
                'created_at' => \Carbon\Carbon::now()
            ]);
            DB::table('service_center_translations')->insert([
                'title' => 'Test service center ' . $i,
                'address' => $faker->address(),
                'schedule' => 'ПН-СБ / с 8:00 - 20:00, ВС - ВЫХОДНОЙ',
                'phones' => $faker->phoneNumber(),
                'locale' => 'en',
                'service_center_id' => $i,
                'created_at' => \Carbon\Carbon::now()
            ]);
	    DB::table('service_center_translations')->insert([
                'title' => 'Test service center ' . $i,
                'address' => $faker->address(),
                'schedule' => 'ПН-СБ / с 8:00 - 20:00, ВС - ВЫХОДНОЙ',
                'phones' => $faker->phoneNumber(),
                'locale' => 'pt',
                'service_center_id' => $i,
                'created_at' => \Carbon\Carbon::now()
            ]);

            DB::table('service_center_translations')->insert([
                'title' => 'Тестова сервiсний центер ' . $i,
                'address' => $faker->address(),
                'schedule' => 'ПН-СБ / с 8:00 - 20:00, ВС - ВЫХОДНОЙ',
                'phones' => $faker->phoneNumber(),
                'locale' => 'ua',
                'service_center_id' => $i,
                'created_at' => \Carbon\Carbon::now()
            ]);
        }
    }
}
