<?php

use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries = [
            [
                'category_id' => 2,
                'translate' => ['ru' => 'Украина', 'en' => 'Ukraine','pt' => 'Ukraine', 'ua' => 'Україна'],
                'latitude' => '49.023470', 'longitude' => '31.630266'
            ],
            [
                'category_id' => 1,
                'translate' => ['ru' => 'Россия', 'en' => 'Russia','pt' => 'Russia', 'ua' => 'Росія'],
                'latitude' => '61.954215', 'longitude' => '99.090709'
            ],
            [
                'category_id' => 1,
                'translate' => ['ru' => 'Беларусь', 'en' => 'Belarus','pt' => 'Belarus', 'ua' => 'Білорусь'],
                'latitude' => '53.890594', 'longitude' => '27.568606'
            ],
            [
                'category_id' => 1,
                'translate' => ['ru' => 'Казахстан', 'en' => 'Kazakhstan','pt' => 'Kazakhstan', 'ua' => 'Казахстан'],
                'latitude' => '51.142013', 'longitude' => '71.430981'
            ],
            [
                'category_id' => 1,
                'translate' => ['ru' => 'Израиль', 'en' => 'Israel','pt' => 'Israel', 'ua' => 'Ізраїль'],
                'latitude' => '31.208944', 'longitude' => '34.795685'
            ],
            [
                'category_id' => 1,
                'translate' => ['ru' => 'Узбекистан', 'en' => 'Uzbekistan','pt' => 'Uzbekistan', 'ua' => 'Узбекистан'],
                'latitude' => '41.983602, ', 'longitude' => '63.997048'
            ],
            [
                'category_id' => 1,
                'translate' => ['ru' => 'Киргизстан', 'en' => 'Kyrgyzstan','pt' => 'Kyrgyzstan', 'ua' => 'Киргизстан'],
                'latitude' => '41.407460', 'longitude' => '74.506561'
            ],
            [
                'category_id' => 1,
                'translate' => ['ru' => 'Грузия', 'en' => 'Georgia','pt' => 'Georgia', 'ua' => 'Грузія'],
                'latitude' => '41.817820', 'longitude' => '44.845923'
            ],
            [
                'category_id' => 1,
                'translate' => ['ru' => 'Армения', 'en' => 'Armenia','pt' => 'Armenia', 'ua' => 'Вірменія'],
                'latitude' => '40.132447', 'longitude' => '44.496511'
            ],
            [
                'category_id' => 1,
                'translate' => ['ru' => 'Турция', 'en' => 'Turkey','pt' => 'Turkey', 'ua' => 'Туреччина'],
                'latitude' => '38.595453', 'longitude' => '35.472793'
            ],
            [
                'category_id' => 1,
                'translate' => ['ru' => 'Азербайджан', 'en' => 'Azerbaijan','pt' => 'Azerbaijan', 'ua' => 'Азербайджан'],
                'latitude' => '40.363262', 'longitude' => '48.292455'
            ],
            [
                'category_id' => 4,
                'translate' => ['ru' => 'США', 'en' => 'USA', 'pt' => 'USA', 'ua' => 'США'],
                'latitude' => '39.497213', 'longitude' => '-101.358155'
            ],
            [
                'category_id' => 1,
                'translate' => ['ru' => 'Кипр', 'en' => 'Cyprus','pt' => 'Cyprus',  'ua' => 'Кіпр'],
                'latitude' => '35.037181', 'longitude' => '33.188881'
            ],
            [
                'category_id' => 1,
                'translate' => ['ru' => 'Бельгия', 'en' => 'Belgium','pt' => 'Belgium', 'ua' => 'Бельгія'],
                'latitude' => '50.486631', 'longitude' => '4.640858'
            ],
            [
                'category_id' => 3,
                'translate' => ['ru' => 'Германия', 'en' => 'Germany','pt' => 'Germany', 'ua' => 'Німеччина'],
                'latitude' => '51.062372', 'longitude' => '10.408365'
            ],
            [
                'category_id' => 3,
                'translate' => ['ru' => 'Ирландия', 'en' => 'Ireland','pt' => 'Ireland', 'ua' => 'Ірландія'],
                'latitude' => '50.979442', 'longitude' => '10.430337'
            ],
            [
                'category_id' => 3,
                'translate' => ['ru' => 'Италия', 'en' => 'Italy','pt' => 'Italy', 'ua' => 'Італія'],
                'latitude' => '41.877922', 'longitude' => '12.728857'
            ],
            [
                'category_id' => 3,
                'translate' => ['ru' => 'Латвия', 'en' => 'Latvia','pt' => 'Latvia', 'ua' => 'Латвія'],
                'latitude' => '57.003961', 'longitude' => '26.070341'
            ],
            [
                'category_id' => 3,
                'translate' => ['ru' => 'Литва', 'en' => 'Lithuania','pt' => 'Lithuania', 'ua' => 'Литва'],
                'latitude' => '55.627267', 'longitude' => '23.728628'
            ],
            [
                'category_id' => 3,
                'translate' => ['ru' => 'Молдавия', 'en' => 'Moldova','pt' => 'Moldova', 'ua' => 'Молдавія'],
                'latitude' => '47.045122', 'longitude' => '28.845255'
            ],
            [
                'category_id' => 3,
                'translate' => ['ru' => 'Польша', 'en' => 'Poland','pt' => 'Poland', 'ua' => 'Польща'],
                'latitude' => '52.874540', 'longitude' => '18.912436'
            ],
            [
                'category_id' => 3,
                'translate' => ['ru' => 'Румыния', 'en' => 'Romania','pt' => 'Romania', 'ua' => 'Румунія'],
                'latitude' => '45.716171', 'longitude' => '25.103683'
            ],
            [
                'category_id' => 3,
                'translate' => ['ru' => 'Чехия', 'en' => 'Czech Republic','pt' => 'Czech Republic', 'ua' => 'Чехія'],
                'latitude' => '49.675602', 'longitude' => '15.133170'
            ],
            [
                'category_id' => 3,
                'translate' => ['ru' => 'Швеция', 'en' => 'Sweden','pt' => 'Sweden', 'ua' => 'Швеція'],
                'latitude' => '62.925507', 'longitude' => '16.484725'
            ],
            [
                'category_id' => 3,
                'translate' => ['ru' => 'Эстония', 'en' => 'Estonia','pt' => 'Estonia', 'ua' => 'Естонія'],
                'latitude' => '58.686656', 'longitude' => '25.810366'
            ],
            [
                'category_id' => 1,
                'translate' => ['ru' => 'Аргентина', 'en' => 'Argentina','pt' => 'Argentina', 'ua' => 'Аргентина'],
                'latitude' => '-35.574959', 'longitude' => '-65.245179'
            ],
	     [
                'category_id' => 3,
                'translate' => ['ru' => 'Португалия', 'en' => 'Portugal','pt' => 'Portugal', 'ua' => 'Португалія'],
                'latitude' => '58.686656', 'longitude' => '25.810366'
            ],

        ];

        foreach ($countries as $key => $country) {
            ++$key;
            DB::table('countries')->insert([
                'created_at' => \Carbon\Carbon::now(),
                'country_category_id' => $country['category_id'],
                'latitude' => $country['latitude'],
                'longitude' => $country['longitude'],
            ]);
            foreach ($country['translate'] as $lang => $translate) {
                DB::table('country_translations')->insert([
                    'title' => $translate,
                    'locale' => $lang,
                    'country_id' => $key,
                    'created_at' => \Carbon\Carbon::now()
                ]);
            }
        }
    }
}
