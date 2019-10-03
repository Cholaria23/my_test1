<?php

use Illuminate\Database\Seeder;

class FileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fileCategories = [
            [
                'translations' => [
                    'ru' => 'Логотипы', 'en' => 'Logos','pt' => 'Logos', 'ua' => 'Логотипи'
                ],
                'files' => [
                    [
                        'icon' => 'doc',
                        'path' => 'upload\files\demo.doc',
                        'translations' => [
                            'ru' => 'Тестовый логотип 1', 'en' => 'Test logo 1','pt' => 'Test logo 1', 'ua' => 'Тестовий логотип 1'
                        ]
                    ],
                    [
                        'icon' => 'exe',
                        'path' => 'upload\files\demo.exe',
                        'translations' => [
                            'ru' => 'Тестовый логотип 2', 'en' => 'Test logo 2','pt' => 'Test logo 2', 'ua' => 'Тестовий логотип 2'
                        ]
                    ],
                    [
                        'icon' => 'jpg',
                        'path' => 'upload\files\demo.jpg',
                        'translations' => [
                            'ru' => 'Тестовый логотип 3', 'en' => 'Test logo 3','pt' => 'Test logo 3', 'ua' => 'Тестовий логотип 3'
                        ]
                    ],
                    [
                        'icon' => 'pdf',
                        'path' => 'upload\files\demo.pdf',
                        'translations' => [
                            'ru' => 'Тестовый логотип 4', 'en' => 'Test logo 1','pt' => 'Test logo 1', 'ua' => 'Тестовий логотип 1'
                        ]
                    ],
                    [
                        'icon' => 'png',
                        'path' => 'upload\files\demo.png',
                        'translations' => [
                            'ru' => 'Тестовый логотип 5', 'en' => 'Test logo 2','pt' => 'Test logo 2', 'ua' => 'Тестовий логотип 2'
                        ]
                    ],
                    [
                        'icon' => 'psd',
                        'path' => 'upload\files\demo.psd',
                        'translations' => [
                            'ru' => 'Тестовый логотип 6', 'en' => 'Test logo 3','pt' => 'Test logo 3', 'ua' => 'Тестовий логотип 3'
                        ]
                    ],
                    [
                        'icon' => 'zip',
                        'path' => 'upload\files\demo.zip',
                        'translations' => [
                            'ru' => 'Тестовый логотип 6', 'en' => 'Test logo 3','pt' => 'Test logo 3', 'ua' => 'Тестовий логотип 3'
                        ]
                    ],
                ]
            ],
            [
                'translations' => [
                    'ru' => 'Таблицы', 'en' => 'Tables','pt' => 'Tables', 'ua' => 'Таблиці'
                ],
                'files' => [
                    [
                        'icon' => 'doc',
                        'path' => 'upload\files\demo.doc',
                        'translations' => [
                            'ru' => 'Тестовый логотип 1', 'en' => 'Test logo 1','en' => 'Test logo 1', 'ua' => 'Тестовий логотип 1'
                        ]
                    ],
                    [
                        'icon' => 'exe',
                        'path' => 'upload\files\demo.exe',
                        'translations' => [
                            'ru' => 'Тестовый логотип 2', 'en' => 'Test logo 2','pt' => 'Test logo 2', 'ua' => 'Тестовий логотип 2'
                        ]
                    ],
                    [
                        'icon' => 'jpg',
                        'path' => 'upload\files\demo.jpg',
                        'translations' => [
                            'ru' => 'Тестовый логотип 3', 'en' => 'Test logo 3','pt' => 'Test logo 3', 'ua' => 'Тестовий логотип 3'
                        ]
                    ],
                    [
                        'icon' => 'pdf',
                        'path' => 'upload\files\demo.pdf',
                        'translations' => [
                            'ru' => 'Тестовый логотип 4', 'en' => 'Test logo 1','pt' => 'Test logo 1', 'ua' => 'Тестовий логотип 1'
                        ]
                    ],
                    [
                        'icon' => 'png',
                        'path' => 'upload\files\demo.png',
                        'translations' => [
                            'ru' => 'Тестовый логотип 5', 'en' => 'Test logo 2','pt' => 'Test logo 2', 'ua' => 'Тестовий логотип 2'
                        ]
                    ],
                    [
                        'icon' => 'psd',
                        'path' => 'upload\files\demo.psd',
                        'translations' => [
                            'ru' => 'Тестовый логотип 6', 'en' => 'Test logo 3','pt' => 'Test logo 3', 'ua' => 'Тестовий логотип 3'
                        ]
                    ],
                    [
                        'icon' => 'zip',
                        'path' => 'upload\files\demo.zip',
                        'translations' => [
                            'ru' => 'Тестовый логотип 6', 'en' => 'Test logo 3','pt' => 'Test logo 3', 'ua' => 'Тестовий логотип 3'
                        ]
                    ],
                ]
            ],
            [
                'translations' => [
                    'ru' => 'PSD', 'en' => 'PSD','pt' => 'PSD', 'ua' => 'PSD'
                ],
                'files' => [
                    [
                        'icon' => 'doc',
                        'path' => 'upload\files\demo.doc',
                        'translations' => [
                            'ru' => 'Тестовый логотип 1', 'en' => 'Test logo 1', 'pt' => 'Test logo 1', 'ua' => 'Тестовий логотип 1'
                        ]
                    ],
                    [
                        'icon' => 'exe',
                        'path' => 'upload\files\demo.exe',
                        'translations' => [
                            'ru' => 'Тестовый логотип 2', 'en' => 'Test logo 2','pt' => 'Test logo 2', 'ua' => 'Тестовий логотип 2'
                        ]
                    ],
                    [
                        'icon' => 'jpg',
                        'path' => 'upload\files\demo.jpg',
                        'translations' => [
                            'ru' => 'Тестовый логотип 3', 'en' => 'Test logo 3','pt' => 'Test logo 3', 'ua' => 'Тестовий логотип 3'
                        ]
                    ],
                    [
                        'icon' => 'pdf',
                        'path' => 'upload\files\demo.pdf',
                        'translations' => [
                            'ru' => 'Тестовый логотип 4', 'en' => 'Test logo 1','pt' => 'Test logo 1', 'ua' => 'Тестовий логотип 1'
                        ]
                    ],
                    [
                        'icon' => 'png',
                        'path' => 'upload\files\demo.png',
                        'translations' => [
                            'ru' => 'Тестовый логотип 5', 'en' => 'Test logo 2','pt' => 'Test logo 2', 'ua' => 'Тестовий логотип 2'
                        ]
                    ],
                    [
                        'icon' => 'psd',
                        'path' => 'upload\files\demo.psd',
                        'translations' => [
                            'ru' => 'Тестовый логотип 6', 'en' => 'Test logo 3','pt' => 'Test logo 3', 'ua' => 'Тестовий логотип 3'
                        ]
                    ],
                    [
                        'icon' => 'zip',
                        'path' => 'upload\files\demo.zip',
                        'translations' => [
                            'ru' => 'Тестовый логотип 6', 'en' => 'Test logo 3','pt' => 'Test logo 3', 'ua' => 'Тестовий логотип 3'
                        ]
                    ],
                ]
            ],
            [
                'translations' => [
                    'ru' => 'Банера', 'en' => 'Banners', 'pt' => 'Banners', 'ua' => 'Банера'
                ],
                'files' => [
                    [
                        'icon' => 'doc',
                        'path' => 'upload\files\demo.doc',
                        'translations' => [
                            'ru' => 'Тестовый логотип 1', 'en' => 'Test logo 1','pt' => 'Test logo 1', 'ua' => 'Тестовий логотип 1'
                        ]
                    ],
                    [
                        'icon' => 'exe',
                        'path' => 'upload\files\demo.exe',
                        'translations' => [
                            'ru' => 'Тестовый логотип 2', 'en' => 'Test logo 2','pt' => 'Test logo 2', 'ua' => 'Тестовий логотип 2'
                        ]
                    ],
                    [
                        'icon' => 'jpg',
                        'path' => 'upload\files\demo.jpg',
                        'translations' => [
                            'ru' => 'Тестовый логотип 3', 'en' => 'Test logo 3','pt' => 'Test logo 3', 'ua' => 'Тестовий логотип 3'
                        ]
                    ],
                    [
                        'icon' => 'pdf',
                        'path' => 'upload\files\demo.pdf',
                        'translations' => [
                            'ru' => 'Тестовый логотип 4', 'en' => 'Test logo 1','pt' => 'Test logo 1', 'ua' => 'Тестовий логотип 1'
                        ]
                    ],
                    [
                        'icon' => 'png',
                        'path' => 'upload\files\demo.png',
                        'translations' => [
                            'ru' => 'Тестовый логотип 5', 'en' => 'Test logo 2','pt' => 'Test logo 2', 'ua' => 'Тестовий логотип 2'
                        ]
                    ],
                    [
                        'icon' => 'psd',
                        'path' => 'upload\files\demo.psd',
                        'translations' => [
                            'ru' => 'Тестовый логотип 6', 'en' => 'Test logo 3','pt' => 'Test logo 3', 'ua' => 'Тестовий логотип 3'
                        ]
                    ],
                    [
                        'icon' => 'zip',
                        'path' => 'upload\files\demo.zip',
                        'translations' => [
                            'ru' => 'Тестовый логотип 6', 'en' => 'Test logo 3','pt' => 'Test logo 3', 'ua' => 'Тестовий логотип 3'
                        ]
                    ],
                ]
            ]
        ];

        foreach ($fileCategories as $key => $fileCategory) {
            $cat_id = DB::table('file_categories')->insertGetId([
                'created_at' => \Carbon\Carbon::now()
            ]);
            foreach ($fileCategory['translations'] as $cat_lang => $cat_locale) {
                DB::table('file_category_translations')->insert([
                    'title' => $cat_locale,
                    'locale' => $cat_lang,
                    'file_category_id' => $cat_id,
                    'created_at' => \Carbon\Carbon::now()
                ]);
            }
            foreach ($fileCategory['files'] as $file) {
                $id = DB::table('files')->insertGetId([
                    'file_category_id' => $cat_id,
                    'path' => $file['path'],
                    'icon' => $file['icon'],
                    'created_at' => \Carbon\Carbon::now()
                ]);
                foreach ($file['translations'] as $lang => $locale) {
                    DB::table('file_translations')->insert([
                        'title' => $locale,
                        'locale' => $lang,
                        'file_id' => $id,
                        'created_at' => \Carbon\Carbon::now()
                    ]);
                }
            }
        }

    }
}
