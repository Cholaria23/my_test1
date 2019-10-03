<?php

use Illuminate\Database\Seeder;

class FaqTableSeeder extends Seeder
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
            $id = DB::table('faq')->insertGetId([
                'created_at' => \Carbon\Carbon::now()
            ]);
            DB::table('faq_translations')->insert([
                'question' => 'Тестовый вопрос ' . $i . ' LOREM IPSUM DOLOR SIT AMET',
                'answer' => $faker->text($maxNbChars = 300),
                'locale' => 'ru',
                'faq_id' => $id,
                'created_at' => \Carbon\Carbon::now()
            ]);
            DB::table('faq_translations')->insert([
                'question' => 'Test qustion ' . $i . ' LOREM IPSUM DOLOR SIT AMET',
                'answer' => $faker->text($maxNbChars = 300),
                'locale' => 'en',
                'faq_id' => $id,
                'created_at' => \Carbon\Carbon::now()
            ]);
	    DB::table('faq_translations')->insert([
                'question' => 'Test qustion ' . $i . ' LOREM IPSUM DOLOR SIT AMET',
                'answer' => $faker->text($maxNbChars = 300),
                'locale' => 'pt',
                'faq_id' => $id,
                'created_at' => \Carbon\Carbon::now()
            ]);

            DB::table('faq_translations')->insert([
                'question' => 'Тестова питання ' . $i . ' LOREM IPSUM DOLOR SIT AMET',
                'answer' => $faker->text($maxNbChars = 300),
                'locale' => 'ua',
                'faq_id' => $id,
                'created_at' => \Carbon\Carbon::now()
            ]);
        }
    }
}
