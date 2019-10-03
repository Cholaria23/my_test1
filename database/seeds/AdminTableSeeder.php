<?php

use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $roles = [
            [
                'type' => 'admin',
                'title' => 'Administrator',
            ], [
                'type' => 'sharpeners',
                'title' => 'Sharpeners',
            ], [
                'type' => 'ambassadors',
                'title' => 'Ambassadors',
            ], [
                'type' => 'instructors',
                'title' => 'Instructors',
            ], [
                'type' => 'technologists',
                'title' => 'Technologists',
            ]
        ];

        $countRoles = count($roles);
        for ($i = 0; $i < $countRoles; $i++) {

            $role_id = DB::table('roles')->insertGetId([
                'type' => $roles[$i]['type'],
                'title' => $roles[$i]['title'],
                'created_at' => \Carbon\Carbon::now()
            ]);

            if ($roles[$i]['type'] == 'admin') {
                $user_id = DB::table('users')->insertGetId([
                    'email' => 'mr.korg@ya.ru',
                    'password' => bcrypt('030306'),
                    'role_id' => $role_id,
                    'created_at' => \Carbon\Carbon::now()
                ]);
                DB::table('user_translations')->insert([
                    'name' => 'Admin',
                    'locale' => 'ru',
                    'user_id' => $user_id,
                    'created_at' => \Carbon\Carbon::now()
                ]);
                DB::table('user_translations')->insert([
                    'name' => 'Admin',
                    'locale' => 'en',
                    'user_id' => $user_id,
                    'created_at' => \Carbon\Carbon::now()
                ]);
		DB::table('user_translations')->insert([
                    'name' => 'Admin',
                    'locale' => 'pt',
                    'user_id' => $user_id,
                    'created_at' => \Carbon\Carbon::now()
                ]);

                DB::table('user_translations')->insert([
                    'name' => 'Admin',
                    'locale' => 'ua',
                    'user_id' => $user_id,
                    'created_at' => \Carbon\Carbon::now()
                ]);
            } else {
                for ($key = 0; $key < 12; $key++) {
                    $user_id = DB::table('users')->insertGetId([
                        'role_id' => $role_id,
                        'facebook' => '#',
                        'viber' => '#',
                        'twitter' => '#',
                        'instagram' => '#',
                        'google' => '#',
                        'created_at' => \Carbon\Carbon::now()
                    ]);
                    DB::table('user_translations')->insert([
                        'name' => $faker->name(),
                        'post' => $faker->catchPhrase(),
                        'content' => $faker->text($maxNbChars = 300),
                        'locale' => 'ru',
                        'user_id' => $user_id,
                        'created_at' => \Carbon\Carbon::now()
                    ]);
                    DB::table('user_translations')->insert([
                        'name' => $faker->name(),
                        'post' => $faker->catchPhrase(),
                        'content' => $faker->text($maxNbChars = 300),
                        'locale' => 'en',
                        'user_id' => $user_id,
                        'created_at' => \Carbon\Carbon::now()
                    ]);
		    DB::table('user_translations')->insert([
                        'name' => $faker->name(),
                        'post' => $faker->catchPhrase(),
                        'content' => $faker->text($maxNbChars = 300),
                        'locale' => 'pt',
                        'user_id' => $user_id,
                        'created_at' => \Carbon\Carbon::now()
                    ]);

                    DB::table('user_translations')->insert([
                        'name' => $faker->name(),
                        'post' => $faker->catchPhrase(),
                        'content' => $faker->text($maxNbChars = 300),
                        'locale' => 'ua',
                        'user_id' => $user_id,
                        'created_at' => \Carbon\Carbon::now()
                    ]);
                }
            }
        }
    }
}
