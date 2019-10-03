<?php

use Illuminate\Database\Seeder;

class ArticleCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $articleCategories = [
            [
                'slug' => 'news',
                'type' => 'news',
                'translations' => [
                    'ru' => 'Новости', 'en' => 'News','pt' => 'News', 'ua' => 'Новини'
                ]
            ],
            [
                'slug' => 'events-and-exhibitions',
                'type' => 'events-and-exhibitions',
                'translations' => [
                    'ru' => 'События и выставки', 'en' => 'Events and exhibitions','pt' => 'Events and exhibitions', 'ua' => 'Події та виставки'
                ]
            ],
            [
                'slug' => 'articles-and-reviews',
                'type' => 'articles-and-reviews',
                'translations' => [
                    'ru' => 'Статьи и обзоры', 'en' => 'Articles and reviews','pt' => 'Articles and reviews', 'ua' => 'Статті та огляди'
                ]
            ],
            [
                'slug' => 'video-training',
                'type' => 'video-training',
                'translations' => [
                    'ru' => 'Видео тренинги', 'en' => 'Video training', 'pt' => 'Video training','ua' => 'Відео тренінги'
                ]
            ],
            [
                'slug' => 'courses-schools',
                'type' => 'courses-schools',
                'translations' => [
                    'ru' => 'Курсы школ', 'en' => 'Courses schools','pt' => 'Courses schools', 'ua' => 'Курси шкіл'
                ]
            ],
        ];

        foreach ($articleCategories as $key => $articleCategory) {
            ++$key;
            DB::table('article_categories')->insert([
                'slug' => $articleCategory['slug'],
                'type' => $articleCategory['type'],
                'created_at' => \Carbon\Carbon::now()
            ]);
            foreach ($articleCategory['translations'] as $lang => $locale) {
                DB::table('article_category_translations')->insert([
                    'title' => $locale,
                    'locale' => $lang,
                    'article_category_id' => $key,
                    'created_at' => \Carbon\Carbon::now()
                ]);
            }
        }

    }
}
