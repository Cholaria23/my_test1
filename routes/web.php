<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => App\Http\Middleware\LocaleMiddleware::getLocale()], function () {

    Auth::routes();

    // Home
    Route::get('/', 'PageController@home')->name('home');
    Route::get('/switcher', 'PageController@switcher')->name('switcher');

    // Pages
    Route::get('/about', 'PageController@about')->name('about');
    Route::get('/partners-and-cooperation', 'PageController@cooperation')->name('partners-and-cooperation');
    Route::get('/shop-and-service', 'PageController@shopService')->name('shop-and-service');
    Route::get('/career', 'PageController@career')->name('career');
    // Route::get('/service', 'PageController@service')->name('service');
    Route::get('/maintenance/{country?}/{city?}', 'PageController@maintenance')->name('maintenance');
    Route::get('/education/{country?}/{city?}', 'PageController@education')->name('education');
    Route::get('/education/{country?}/{city?}?categories={ids?}', 'PageController@education')->name('education-filtered');
    Route::get('/school/{slug}', 'SchoolController@show')->name('school');
    Route::get('/agreement', 'PageController@agreement')->name('agreement');
    Route::get('/privacy-policy', 'PageController@privacyPolicy')->name('privacy-policy');
    Route::get('/about-cookie', 'PageController@aboutCookie')->name('about-cookie');

    // Blog
    Route::get('/blog/{slug?}', 'ArticleController@index')->name('blog');
    Route::get('/article/{slug}', 'ArticleController@show')->name('article');

    Route::get('/faq', 'PageController@faq')->name('faq');
    Route::get('/contacts', 'PageController@contacts')->name('contacts');

    Route::get('/workplace/{slug}', 'PageController@workplace')->name('workplace');

    // Catalog
    Route::get('/catalog', 'ProductController@catalog')->name('catalog');
    Route::get('/catalog-pro', 'ProductController@catalog')->name('catalog-pro');

    Route::get('/catalog/series/{slug}', 'ProductController@catalogBySeries')->name('catalog-series');
    Route::get('/catalog-pro/series/{slug}', 'ProductController@catalogBySeries')->name('catalog-pro-series');

    Route::get('/catalog/appointment/{slug}', 'ProductController@catalogByAppointment')->name('catalog-appointment');
    Route::get('/catalog-pro/appointment/{slug}', 'ProductController@catalogByAppointment')->name('catalog-pro-appointment');

    Route::get('/catalog/category/{slug}', 'ProductController@catalogByCategory')->name('catalog-category');
    Route::get('/catalog-pro/category/{slug}', 'ProductController@catalogByCategory')->name('catalog-pro-category');

    Route::get('/product/{slug}', 'ProductController@show')->name('product');
    Route::get('/product-pro/{slug}', 'ProductController@show')->name('product-pro');

    // Search
    Route::get('/search', 'SearchController@index')->name('search');

    // Auth
    Route::get('/logout', 'Auth\LoginController@logout')->name('logout');


    Route::get('/frontend/js/lang.js', 'LanguageController@getLocales')->name('getLocales');
});

// Requests
Route::post('/subscribe-form', 'FormRequestController@subscribeFormStore')->name('subscribe');
Route::post('/marketing-support-form', 'FormRequestController@marketingSupportFormStore')->name('marketing-support-form');
Route::post('/workplace-form', 'FormRequestController@workplaceFormStore')->name('workplace-form');
Route::post('/add-review', 'FormRequestController@reviewStore')->name('add-review');
Route::post('/add-form-request', 'FormRequestController@formRequestStore')->name('add-form-request');
Route::post('/add-contact-request', 'FormRequestController@formContactStore')->name('add-contact-request');

Route::post('/set-first-visit', 'CookieController@index')->name('set-first-visit');


// Lang
Route::post('/select-country-and-language', 'LanguageController@selectCountryAndLanguage')->name('select-country-and-language');
Route::get('/setLocale/{lang}', 'LanguageController@setLocale')->name('setLocale');
Route::get('/getLanguages', 'LanguageController@getLanguages')->name('getLanguages');
Route::get('/getCountries/{locale}', 'CountryController@getCountries')->name('getCountries');

Route::get('/getFiles/{cats?}', 'FileController@getFiles')->name('getFiles');
Route::post('/checkPassword', 'FileController@checkPassword')->name('checkPassword');

//Route::get('sitemap', 'SitemapController@index')->name('sitemap');
