<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(LanguagesTableSeeder::class);
         $this->call(CountryCategoriesTableSeeder::class);
         $this->call(CountriesTableSeeder::class);
         $this->call(UserTableSeeder::class);
         $this->call(ArticleCategoryTableSeeder::class);
         $this->call(ArticleTableSeeder::class);
         $this->call(WorkplaceTableSeeder::class);
         $this->call(PosterCategoryTableSeeder::class);
         $this->call(PosterTableSeeder::class);
         $this->call(PageTableSeeder::class);
         $this->call(ServiceCentreTableSeeder::class);
         $this->call(SchoolTableSeeder::class);
         $this->call(MaintenanceCentreTableSeeder::class);
         $this->call(FileTableSeeder::class);
         $this->call(FaqTableSeeder::class);
         $this->call(CatalogTableSeeder::class);
    }
}
