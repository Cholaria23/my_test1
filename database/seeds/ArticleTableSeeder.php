<?php

use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\ArticleCategory;
use Carbon\Carbon;

class ArticleTableSeeder extends Seeder
{
    private $imageRepository;

    public function __construct(\App\Repositories\ImageRepository $imageRepository)
    {
        $this->imageRepository = $imageRepository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = DB::table('article_categories')->select('id')->get()->toArray();

        $faker = Faker\Factory::create();

        for ($i=1; $i<=15; $i++) {
            $key = array_rand($categories);
            $obj = $categories[$key];
            DB::table('articles')->insert([
                'slug' => 'blog-post-' . $i,
                'article_category_id' => $obj->id,
                'created_at' => \Carbon\Carbon::now()
            ]);
            DB::table('article_translations')->insert([
                'title' => 'Запись блога ' . $i,
                'content' => $faker->text($maxNbChars = 300),
                'locale' => 'ru',
                'article_id' => $i,
                'created_at' => \Carbon\Carbon::now()
            ]);
            DB::table('article_translations')->insert([
                'title' => 'Blog post ' . $i,
                'content' => $faker->text($maxNbChars = 300),
                'locale' => 'en',
                'article_id' => $i,
                'created_at' => \Carbon\Carbon::now()
            ]);
	    DB::table('article_translations')->insert([
                'title' => 'Blog post ' . $i,
                'content' => $faker->text($maxNbChars = 300),
                'locale' => 'pt',
                'article_id' => $i,
                'created_at' => \Carbon\Carbon::now()
            ]);

            DB::table('article_translations')->insert([
                'title' => 'Запис блогу ' . $i,
                'content' => $faker->text($maxNbChars = 300),
                'locale' => 'ua',
                'article_id' => $i,
                'created_at' => \Carbon\Carbon::now()
            ]);
        }

// TODO: fix images insert
//        $articles = Article::all();

//        foreach($articles as $article) {
//            $faker = Faker\Factory::create();
//            $image = $faker->imageUrl(800, 600, 'cats');
//            $unique = md5(Carbon::now());
//            $this->imageRepository->imageStore($article, $image, $image, $unique,  'image');
//            $article->update(['image' => $unique]);
//        }
    }
}
