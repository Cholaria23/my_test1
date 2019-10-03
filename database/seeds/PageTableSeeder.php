<?php

use Illuminate\Database\Seeder;

class PageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $languages = Config::get('app.locales');

        // Home
        $pageId = DB::table('pages')->insertGetId([
            'slug' => 'home',
            'type' => 'home',
            'created_at' => \Carbon\Carbon::now()
        ]);
        $pageTitle = ['ru' => 'Главная', 'en' => 'Home','pt' => 'Home', 'ua' => 'Головна'];
        foreach ($languages as $language) {
            DB::table('page_translations')->insert([
                'title' => $pageTitle[$language],
                'locale' => $language,
                'page_id' => $pageId,
                'created_at' => \Carbon\Carbon::now()
            ]);
        }
        $id = DB::table('page_fields')->insertGetId([
            'advanced_name' => 'home-text-1',
            'advanced_type' => 'text',
            'page_id' => $pageId,
            'created_at' => \Carbon\Carbon::now()
        ]);
        foreach ($languages as $lang) {
            DB::table('page_field_translations')->insert([
                'text' => 'home ' . $faker->text($maxNbChars = 300),
                'locale' => $lang,
                'page_field_id' => $id,
                'created_at' => \Carbon\Carbon::now()
            ]);
        }

        // About
        $pageId = DB::table('pages')->insertGetId([
            'slug' => 'about',
            'type' => 'about',
            'created_at' => \Carbon\Carbon::now()
        ]);
        $pageTitle = ['ru' => 'Компания Staleks', 'en' => 'Company Staleks','pt' => 'Company Staleks', 'ua' => 'Компанія Staleks'];
        foreach ($languages as $language) {
            DB::table('page_translations')->insert([
                'title' => $pageTitle[$language],
                'locale' => $language,
                'page_id' => $pageId,
                'created_at' => \Carbon\Carbon::now()
            ]);
        }
        $id = DB::table('page_fields')->insertGetId([
            'advanced_name' => 'about-text-1',
            'advanced_type' => 'text',
            'page_id' => $pageId,
            'created_at' => \Carbon\Carbon::now()
        ]);
        foreach ($languages as $lang) {
            DB::table('page_field_translations')->insert([
                'text' => 'about ' . $faker->text($maxNbChars = 300),
                'locale' => $lang,
                'page_field_id' => $id,
                'created_at' => \Carbon\Carbon::now()
            ]);
        }
        $id = DB::table('page_fields')->insertGetId([
            'advanced_name' => 'about-string-1',
            'advanced_type' => 'string',
            'page_id' => $pageId,
            'created_at' => \Carbon\Carbon::now()
        ]);
        foreach ($languages as $lang) {
            DB::table('page_field_translations')->insert([
                'string' => 'about custom string ' . $lang,
                'locale' => $lang,
                'page_field_id' => $id,
                'created_at' => \Carbon\Carbon::now()
            ]);
        }

        // Cooperation
        $pageId = DB::table('pages')->insertGetId([
            'slug' => 'partners-and-cooperation',
            'type' => 'partners-and-cooperation',
            'created_at' => \Carbon\Carbon::now()
        ]);
        $pageTitle = ['ru' => 'Партнёры и сотрудничество', 'en' => 'Partners and cooperation','pt' => 'Partners and cooperation', 'ua' => 'Партнери і співробітництво'];
        foreach ($languages as $language) {
            DB::table('page_translations')->insert([
                'title' => $pageTitle[$language],
                'locale' => $language,
                'page_id' => $pageId,
                'created_at' => \Carbon\Carbon::now()
            ]);
        }

        // Shop and service
        $pageId = DB::table('pages')->insertGetId([
            'slug' => 'shop-and-service',
            'type' => 'shop-and-service',
            'created_at' => \Carbon\Carbon::now()
        ]);
        $pageTitle = ['ru' => 'Staleks shop & service', 'en' => 'Staleks shop & service','pt' => 'Staleks shop & service', 'ua' => 'Staleks shop & service'];
        foreach ($languages as $language) {
            DB::table('page_translations')->insert([
                'title' => $pageTitle[$language],
                'locale' => $language,
                'page_id' => $pageId,
                'created_at' => \Carbon\Carbon::now()
            ]);
        }

        // Career
        $pageId = DB::table('pages')->insertGetId([
            'slug' => 'career',
            'type' => 'career',
            'created_at' => \Carbon\Carbon::now()
        ]);
        $pageTitle = ['ru' => 'Карьера', 'en' => 'Career','pt' => 'Career', 'ua' => 'Кар\'єра'];
        foreach ($languages as $language) {
            DB::table('page_translations')->insert([
                'title' => $pageTitle[$language],
                'locale' => $language,
                'page_id' => $pageId,
                'created_at' => \Carbon\Carbon::now()
            ]);
        }

        // Service
        $pageId = DB::table('pages')->insertGetId([
            'slug' => 'service',
            'type' => 'service',
            'created_at' => \Carbon\Carbon::now()
        ]);
        $pageTitle = ['ru' => 'Профессиональный сервис', 'en' => 'Professional service','pt' => 'Professional service', 'ua' => 'Професійне обслуговування'];
        foreach ($languages as $language) {
            DB::table('page_translations')->insert([
                'title' => $pageTitle[$language],
                'locale' => $language,
                'page_id' => $pageId,
                'created_at' => \Carbon\Carbon::now()
            ]);
        }

        // Maintenance
        $pageId = DB::table('pages')->insertGetId([
            'slug' => 'maintenance',
            'type' => 'maintenance',
            'created_at' => \Carbon\Carbon::now()
        ]);
        $pageTitle = ['ru' => 'Обслуживание инструмента', 'en' => 'Maintenance tool','pt' => 'Maintenance tool', 'ua' => 'Обслуговування інструменту'];
        foreach ($languages as $language) {
            DB::table('page_translations')->insert([
                'title' => $pageTitle[$language],
                'locale' => $language,
                'page_id' => $pageId,
                'created_at' => \Carbon\Carbon::now()
            ]);
        }

        // Education
        $pageId = DB::table('pages')->insertGetId([
            'slug' => 'education',
            'type' => 'education',
            'created_at' => \Carbon\Carbon::now()
        ]);
        $pageTitle = ['ru' => 'Обучение', 'en' => 'Education','pt' => 'Education', 'ua' => 'Навчання'];
        foreach ($languages as $language) {
            DB::table('page_translations')->insert([
                'title' => $pageTitle[$language],
                'locale' => $language,
                'page_id' => $pageId,
                'created_at' => \Carbon\Carbon::now()
            ]);
        }

        // Blog
        $pageId = DB::table('pages')->insertGetId([
            'slug' => 'blog',
            'type' => 'blog',
            'created_at' => \Carbon\Carbon::now()
        ]);
        $pageTitle = ['ru' => 'Блог', 'en' => 'Blog','pt' => 'Blog', 'ua' => 'Блог'];
        foreach ($languages as $language) {
            DB::table('page_translations')->insert([
                'title' => $pageTitle[$language],
                'locale' => $language,
                'page_id' => $pageId,
                'created_at' => \Carbon\Carbon::now()
            ]);
        }

        // Posters
        $pageId = DB::table('pages')->insertGetId([
            'slug' => 'posters',
            'type' => 'posters',
            'created_at' => \Carbon\Carbon::now()
        ]);
        $pageTitle = ['ru' => 'Объявления', 'en' => 'Posters','pt' => 'Posters', 'ua' => 'Оголошення'];
        foreach ($languages as $language) {
            DB::table('page_translations')->insert([
                'title' => $pageTitle[$language],
                'locale' => $language,
                'page_id' => $pageId,
                'created_at' => \Carbon\Carbon::now()
            ]);
        }

        // Jobs
        $pageId = DB::table('pages')->insertGetId([
            'slug' => 'workplaces',
            'type' => 'workplaces',
            'created_at' => \Carbon\Carbon::now()
        ]);
        $pageTitle = ['ru' => 'Вакансии', 'en' => 'Jobs','en' => 'Jobs','pt' => 'Jobs', 'ua' => 'Вакансії'];
        foreach ($languages as $language) {
            DB::table('page_translations')->insert([
                'title' => $pageTitle[$language],
                'locale' => $language,
                'page_id' => $pageId,
                'created_at' => \Carbon\Carbon::now()
            ]);
        }

        // FAQ
        $pageId = DB::table('pages')->insertGetId([
            'slug' => 'faq',
            'type' => 'faq',
            'created_at' => \Carbon\Carbon::now()
        ]);
        $pageTitle = ['ru' => 'Часто задаваемые вопросы', 'en' => 'Frequently asked questions','pt' => 'Frequently asked questions', 'ua' => 'Часті питання'];
        foreach ($languages as $language) {
            DB::table('page_translations')->insert([
                'title' => $pageTitle[$language],
                'locale' => $language,
                'page_id' => $pageId,
                'created_at' => \Carbon\Carbon::now()
            ]);
        }

        // Contacts
        $pageId = DB::table('pages')->insertGetId([
            'slug' => 'contacts',
            'type' => 'contacts',
            'created_at' => \Carbon\Carbon::now()
        ]);
        $pageTitle = ['ru' => 'Контакты', 'en' => 'Contacts','pt' => 'Contacts', 'ua' => 'Контакти'];
        foreach ($languages as $language) {
            DB::table('page_translations')->insert([
                'title' => $pageTitle[$language],
                'locale' => $language,
                'page_id' => $pageId,
                'created_at' => \Carbon\Carbon::now()
            ]);
        }

        // Catalog
        $pageId = DB::table('pages')->insertGetId([
            'slug' => 'catalog',
            'type' => 'catalog',
            'created_at' => \Carbon\Carbon::now()
        ]);
        $pageTitle = ['ru' => 'Каталог', 'en' => 'Catalog','pt' => 'Catalog', 'ua' => 'Каталог'];
        foreach ($languages as $language) {
            DB::table('page_translations')->insert([
                'title' => $pageTitle[$language],
                'locale' => $language,
                'page_id' => $pageId,
                'created_at' => \Carbon\Carbon::now()
            ]);
        }

        // Catalog PRO
        $pageId = DB::table('pages')->insertGetId([
            'slug' => 'catalog-pro',
            'type' => 'catalog-pro',
            'created_at' => \Carbon\Carbon::now()
        ]);
        $pageTitle = ['ru' => 'Каталог', 'en' => 'Catalog','pt' => 'Catalog', 'ua' => 'Каталог'];
        foreach ($languages as $language) {
            DB::table('page_translations')->insert([
                'title' => $pageTitle[$language],
                'locale' => $language,
                'page_id' => $pageId,
                'created_at' => \Carbon\Carbon::now()
            ]);
        }
    }
}
