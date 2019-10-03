<?php

use Illuminate\Database\Seeder;

class CatalogTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $catalog = [
            'serials' => [
                [
                    'title' => ['ru' => 'Beaty & Care', 'en' => 'Beaty & Care', 'pt' => 'Beaty & Care', 'ua' => 'Beaty & Care'],
                    'type' => 'standart',
                    'slug' => 'beaty-and-care',
                ],
                [
                    'title' => ['ru' => 'Cassic', 'en' => 'Cassic','pt' => 'Cassic', 'ua' => 'Cassic'],
                    'type' => 'standart',
                    'slug' => 'cassic',
                ],
                [
                    'title' => ['ru' => 'Аксессуары', 'en' => 'Accessories', 'pt' => 'Accessories', 'ua' => 'Аксесуари'],
                    'type' => 'standart',
                    'slug' => null,
                ],
                [
                    'title' => ['ru' => 'Exclusive', 'en' => 'Exclusive','pt' => 'Exclusive', 'ua' => 'Exclusive'],
                    'type' => 'pro',
                    'slug' => 'exclusive',
                ],
                [
                    'title' => ['ru' => 'Expert', 'en' => 'Expert', 'pt' => 'Expert', 'ua' => 'Expert'],
                    'type' => 'pro',
                    'slug' => 'expert',
                ],
                [
                    'title' => ['ru' => 'Smart', 'en' => 'Smart', 'pt' => 'Smart', 'ua' => 'Smart'],
                    'type' => 'pro',
                    'slug' => 'smart',
                ],
                [
                    'title' => ['ru' => 'Аксессуары', 'en' => 'Accessories','pt' => 'Accessories', 'ua' => 'Аксесуари'],
                    'type' => 'pro',
                    'slug' => null,
                ],
            ],
            'appointments_ids' => [],
            'appointments' => [
                [
                    'title' => ['ru' => 'Маникюр', 'en' => 'Manicure','pt' => 'Manicure', 'ua' => 'Манікюр'],
                    'icon_color' => 'pink'
                ],
                [
                    'title' => ['ru' => 'Педикюр', 'en' => 'Pedicure','pt' => 'Pedicure', 'ua' => 'Педикюр'],
                    'icon_color' => 'purple'
                ],
                [
                    'title' => ['ru' => 'Make up', 'en' => 'Make up','pt' => 'Make up', 'ua' => 'Make up'],
                    'icon_color' => 'orange'
                ],
                [
                    'title' => ['ru' => 'Косметология', 'en' => 'Cosmetology','pt' => 'Cosmetology', 'ua' => 'Косметологія'],
                    'icon_color' => 'yellow'
                ],
            ]
        ];

        $countries = DB::table('countries')->select('id')->get()->toArray();
        $articles = DB::table('articles')->select('id')->get()->toArray();

        foreach ($catalog['appointments'] as $item) {
            $appointment_id = DB::table('product_appointments')->insertGetId([
                'icon_color' => $item['icon_color'],
                'created_at' => \Carbon\Carbon::now()
            ]);
            array_push($catalog['appointments_ids'], $appointment_id);
            foreach (Config::get('app.locales') as $land) {
                DB::table('product_appointment_translations')->insert([
                    'title' => $item['title'][$land],
                    'locale' => $land,
                    'product_appointment_id' => $appointment_id,
                    'created_at' => \Carbon\Carbon::now()
                ]);
            }
        }

        $attribute_category_ids = [];
        $attributes_ids = [];
        for ($attrcat = 0; $attrcat < 5; $attrcat++) {
            $attribute_category_id = DB::table('attribute_categories')->insertGetId([
                'created_at' => \Carbon\Carbon::now()
            ]);
            array_push($attribute_category_ids, $attribute_category_id);
            foreach (Config::get('app.locales') as $land) {
                DB::table('attribute_category_translations')->insert([
                    'title' => 'Категория атрибутов ' . $attribute_category_id,
                    'locale' => $land,
                    'attribute_category_id' => $attribute_category_id,
                    'created_at' => \Carbon\Carbon::now()
                ]);
            }
            for ($attr = 0; $attr < 5; $attr++) {
                $attribute_id = DB::table('attributes')->insertGetId([
                    'attribute_category_id' => $attribute_category_id,
                    'created_at' => \Carbon\Carbon::now()
                ]);
                $attributes_ids['attr_cat-' . $attribute_category_id] = [];
                array_push($attributes_ids['attr_cat-' . $attribute_category_id], $attribute_id);
                foreach (Config::get('app.locales') as $land) {
                    DB::table('attribute_translations')->insert([
                        'title' => 'Атрибут ' . $attribute_id,
                        'locale' => $land,
                        'attribute_id' => $attribute_id,
                        'created_at' => \Carbon\Carbon::now()
                    ]);
                }
            }
        }

        foreach ($catalog['serials'] as $item) {
            $serial_id = DB::table('serials')->insertGetId([
                'type' => $item['type'],
                'slug' => $item['slug'],
                'created_at' => \Carbon\Carbon::now()
            ]);
            foreach (Config::get('app.locales') as $land) {
                DB::table('serial_translations')->insert([
                    'title' => $item['title'][$land],
                    'content' => $faker->text($maxNbChars = 300),
                    'locale' => $land,
                    'serial_id' => $serial_id,
                    'created_at' => \Carbon\Carbon::now()
                ]);
            }
            for ($i = 0; $i < 5; $i++) {
                $cat_id = DB::table('product_categories')->insertGetId([
                    'slug' => 'test-category-' . $serial_id . '-' . $i,
                    'serial_id' => $serial_id,
                    'created_at' => \Carbon\Carbon::now()
                ]);
                foreach (Config::get('app.locales') as $land) {
                    DB::table('product_category_translations')->insert([
                        'title' => 'Test category ' . $cat_id,
                        'locale' => $land,
                        'product_category_id' => $cat_id,
                        'created_at' => \Carbon\Carbon::now()
                    ]);
                }
                $rand_attribute_category = array_random($attribute_category_ids);
                DB::table('attribute_category_to_product_category')->insert([
                    'product_category_id' => $cat_id,
                    'attribute_category_id' => $rand_attribute_category,
                    'created_at' => \Carbon\Carbon::now()
                ]);
                for ($j = 0; $j < 5; $j++) {
                    $prod_id = DB::table('products')->insertGetId([
                        'slug' => 'test-pruduct-' . $cat_id . '-' . $j,
                        'model' => $item['title']['en'] . ' ' . $cat_id . $j,
                        'sku' => 'SKU ' . $cat_id . $j,
                        'product_category_id' => $cat_id,
                        'created_at' => \Carbon\Carbon::now()
                    ]);
                    foreach (Config::get('app.locales') as $land) {
                        DB::table('product_translations')->insert([
                            'title' => 'Test product ' . $prod_id,
                            'short_text' => $faker->text($maxNbChars = 200),
                            'video' => 'https://www.youtube.com/embed/43oF1kDWPFA',
                            'locale' => $land,
                            'product_id' => $prod_id,
                            'created_at' => \Carbon\Carbon::now()
                        ]);
                    }
                    $rand = array_random($catalog['appointments_ids']);
                    DB::table('appointment_to_product')->insert([
                        'product_id' => $prod_id,
                        'appointment_id' => $rand,
                        'created_at' => \Carbon\Carbon::now()
                    ]);
                    $rand_attribute = array_random($attributes_ids['attr_cat-' . $rand_attribute_category]);
                    DB::table('attribute_to_product')->insert([
                        'product_id' => $prod_id,
                        'attribute_id' => $rand_attribute,
                        'created_at' => \Carbon\Carbon::now()
                    ]);
                    $rand_countries = array_random($countries, 10);
                    foreach ($rand_countries as $country) {
                        DB::table('country_to_product')->insert([
                            'product_id' => $prod_id,
                            'country_id' => $country->id,
                            'created_at' => \Carbon\Carbon::now()
                        ]);
                    }
                    $rand_articles = array_random($articles, 3);
                    foreach ($rand_articles as $article) {
                        DB::table('article_to_product')->insert([
                            'product_id' => $prod_id,
                            'article_id' => $article->id,
                            'created_at' => \Carbon\Carbon::now()
                        ]);
                    }
                }
            }
        }
    }
}
