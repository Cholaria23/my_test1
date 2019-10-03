<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Models\Country;
use App\Models\Language;
use Illuminate\Support\Facades\Cache;
use View;
use App;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        $total_countries = App::make('countries');
        view()->share(compact('total_countries'));

        $total_languages = App::make('languages');
        view()->share(compact('total_languages'));
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }

        App::singleton('countries', function () {
            try {
                return Cache::rememberForever('countries', function () {
                    return Country::all();
                });
            } catch (\Illuminate\Database\QueryException $e) {
                return null;
            }
        });

        App::singleton('languages', function () {
            try {
                return Cache::rememberForever('languages', function () {
                    return Language::all();
                });
            } catch (\Illuminate\Database\QueryException $e) {
                return null;
            }
        });

    }
}
