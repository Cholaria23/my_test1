<?php

use Illuminate\Database\Seeder;

class CountryCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['slug' => 'other', 'translate' => ['ru' => 'Другие', 'en' => 'Other','pt' => 'Other_PT', 'ua' => 'Інші']],
            ['slug' => 'ukraine', 'translate' => ['ru' => 'Украина', 'en' => 'Ukraine','pt' => 'Ukraine_PT', 'ua' => 'Україна']],
            ['slug' => 'europe', 'translate' => ['ru' => 'Европа', 'en' => 'Europe','pt' => 'Europe_PT', 'ua' => 'Європа']],
            ['slug' => 'usa', 'translate' => ['ru' => 'США', 'en' => 'USA','pt' => 'USA_PT', 'ua' => 'США']],
        ];

        foreach ($categories as $key => $category) {
            ++$key;
            DB::table('country_categories')->insert([
                'created_at' => \Carbon\Carbon::now(),
                'slug' => $category['slug']
            ]);
            foreach ($category['translate'] as $lang => $translate) {
                DB::table('country_category_translations')->insert([
                    'title' => $translate,
                    'locale' => $lang,
                    'country_category_id' => $key,
                    'created_at' => \Carbon\Carbon::now()
                ]);
            }
        }
    }
}
