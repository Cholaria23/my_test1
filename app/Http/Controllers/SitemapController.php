<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductAppointment;
use App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class SitemapController extends Controller
{
    public function index()
    {
        // create new sitemap object
        $sitemap = App::make('sitemap');

        // set cache key (string), duration in minutes (Carbon|Datetime|int), turn on/off (boolean)
        // by default cache is disabled
        $sitemap->setCache('laravel.sitemap', 60);

        // check if there is cached sitemap and build new only if is not
        if (!$sitemap->isCached()) {


            // Articles
            $articles = DB::table('articles')->where('deleted_at', null)->orderBy('created_at', 'desc')->get();
            foreach ($articles as $article) {
                $sitemap->add(route('article', ['slug' => $article->slug]), $article->created_at, '1.0', 'monthly', [], null, [
                    ['language' => 'ru', 'url' => URL::to('article/' . $article->slug)],
                    ['language' => 'uk', 'url' => URL::to('ua/article/' . $article->slug)],
                    ['language' => 'en', 'url' => URL::to('en/article/' . $article->slug)],
    		    ['language' => 'pt', 'url' => URL::to('pt/article/' . $article->slug)],
                ]);
            }
            // Articles categories
            $article_categories = DB::table('article_categories')->where('deleted_at', null)->orderBy('created_at', 'desc')->get();
            foreach ($article_categories as $article_category) {
                $sitemap->add(route('blog', ['slug' => $article_category->slug]), $article_category->created_at, '1.0', 'monthly', [], null, [
                    ['language' => 'ru', 'url' => URL::to('blog/' . $article_category->slug)],
                    ['language' => 'uk', 'url' => URL::to('ua/blog/' . $article_category->slug)],
                    ['language' => 'en', 'url' => URL::to('en/blog/' . $article_category->slug)],
		    ['language' => 'pt', 'url' => URL::to('pt/blog/' . $article_category->slug)],
                ]);
            }
            // Workplaces
            $workplaces = DB::table('workplaces')->where('deleted_at', null)->orderBy('created_at', 'desc')->get();
            foreach ($workplaces as $workplace) {
                $sitemap->add(route('workplace', ['slug' => $workplace->slug]), $workplace->created_at, '1.0', 'monthly', [], null, [
                    ['language' => 'ru', 'url' => URL::to('workplace/' . $workplace->slug)],
                    ['language' => 'uk', 'url' => URL::to('ua/workplace/' . $workplace->slug)],
                    ['language' => 'en', 'url' => URL::to('en/workplace/' . $workplace->slug)],
		    ['language' => 'pt', 'url' => URL::to('pt/workplace/' . $workplace->slug)],
                ]);
            }
            // Serials
            $serials = DB::table('serials')->where('deleted_at', null)->orderBy('created_at', 'desc')->get();
            foreach ($serials as $serial) {
                if ($serial->slug) {
                    if ($serial->type === 'pro') {
                        $sitemap->add(route('catalog-pro-series', ['slug' => $serial->slug]), $serial->created_at, '1.0', 'monthly', [], null, [
                            ['language' => 'ru', 'url' => URL::to('catalog-pro/series/' . $serial->slug)],
                            ['language' => 'uk', 'url' => URL::to('ua/catalog-pro/series/' . $serial->slug)],
                            ['language' => 'en', 'url' => URL::to('en/catalog-pro/series/' . $serial->slug)],
			    ['language' => 'pt', 'url' => URL::to('pt/catalog-pro/series/' . $serial->slug)],
                        ]);
                    } else {
                        $sitemap->add(route('catalog-series', ['slug' => $serial->slug]), $serial->created_at, '1.0', 'monthly', [], null, [
                            ['language' => 'ru', 'url' => URL::to('catalog/series/' . $serial->slug)],
                            ['language' => 'uk', 'url' => URL::to('ua/catalog/series/' . $serial->slug)],
                            ['language' => 'en', 'url' => URL::to('en/catalog/series/' . $serial->slug)],
			    ['language' => 'pt', 'url' => URL::to('pt/catalog/series/' . $serial->slug)],
                        ]);
                    }
                }
            }
            // Categories
            $product_categories = ProductCategory::orderBy('created_at', 'desc')->where('deleted_at', null)->get();
            foreach ($product_categories as $product_category) {
                if ($product_category->serial->type === 'pro') {
                    $sitemap->add(route('catalog-pro-category', ['ids' => $product_category->slug]), $product_category->created_at, '1.0', 'monthly', [], null, [
                        ['language' => 'ru', 'url' => URL::to('catalog-pro?categories=' . $product_category->slug)],
                        ['language' => 'uk', 'url' => URL::to('ua/catalog-pro?categories=' . $product_category->slug)],
                        ['language' => 'en', 'url' => URL::to('en/catalog-pro?categories=' . $product_category->slug)],
			['language' => 'pt', 'url' => URL::to('pt/catalog-pro?categories=' . $product_category->slug)],

                    ]);
                } else {
                    $sitemap->add(route('catalog-category', ['ids' => $product_category->slug]), $product_category->created_at, '1.0', 'monthly', [], null, [
                        ['language' => 'ru', 'url' => URL::to('catalog?categories=' . $product_category->slug)],
                        ['language' => 'uk', 'url' => URL::to('ua/catalog?categories=' . $product_category->slug)],
                        ['language' => 'en', 'url' => URL::to('en/catalog?categories=' . $product_category->slug)],
			['language' => 'pt', 'url' => URL::to('pt/catalog?categories=' . $product_category->slug)],
                    ]);
                }
            }
            // Appointments
            $product_appointments = ProductAppointment::where('deleted_at', null)->orderBy('created_at', 'desc')->get();
            foreach ($product_appointments as $product_appointment) {
                $sitemap->add(route('catalog-pro-appointment', ['ids' => $product_appointment->slug]), $product_appointment->created_at, '1.0', 'monthly', [], null, [
                    ['language' => 'ru', 'url' => URL::to('/catalog-pro/appointment/' . $product_appointment->slug)],
                    ['language' => 'uk', 'url' => URL::to('ua//catalog-pro/appointment/' . $product_appointment->slug)],
                    ['language' => 'en', 'url' => URL::to('en//catalog-pro/appointment/' . $product_appointment->slug)],
		    ['language' => 'pt', 'url' => URL::to('pt//catalog-pro/appointment/' . $product_appointment->slug)],
                ]);
                $sitemap->add(route('catalog-appointment', ['ids' => $product_appointment->slug]), $product_appointment->created_at, '1.0', 'monthly', [], null, [
                    ['language' => 'ru', 'url' => URL::to('/catalog/appointment/' . $product_appointment->slug)],
                    ['language' => 'uk', 'url' => URL::to('ua/catalog/appointment/' . $product_appointment->slug)],
                    ['language' => 'en', 'url' => URL::to('en/catalog/appointment/' . $product_appointment->slug)],
		    ['language' => 'pt', 'url' => URL::to('pt/catalog/appointment/' . $product_appointment->slug)],
                ]);
            }
            // Products
            $products = Product::where('deleted_at', null)->orderBy('created_at', 'desc')->get();
            foreach ($products as $product) {
                if ($product->hasTranslation()) {
                    if ($product->is_pro === 'pro') {
                        $sitemap->add(route('product-pro', ['slug' => $product->slug]), $product->created_at, '1.0', 'monthly', [], null, [
                            ['language' => 'ru', 'url' => URL::to('product-pro/' . $product->slug)],
                            ['language' => 'uk', 'url' => URL::to('ua/product-pro/' . $product->slug)],
                            ['language' => 'en', 'url' => URL::to('en/product-pro/' . $product->slug)],
			    ['language' => 'pt', 'url' => URL::to('pt/product-pro/' . $product->slug)],
                        ]);
                    } else {
                        $sitemap->add(route('product', ['slug' => $product->slug]), $product->created_at, '1.0', 'monthly', [], null, [
                            ['language' => 'ru', 'url' => URL::to('product/' . $product->slug)],
                            ['language' => 'uk', 'url' => URL::to('ua/product/' . $product->slug)],
                            ['language' => 'en', 'url' => URL::to('en/product/' . $product->slug)],
			    ['language' => 'pt', 'url' => URL::to('pt/product/' . $product->slug)],
                        ]);
                    }
                }
            }
            // Schools
            $schools = DB::table('schools')->where('deleted_at', null)->orderBy('created_at', 'desc')->get();
            foreach ($schools as $school) {
                if ($school->slug === 'uchebnyy-centr-yulii-zvarich') {
                    \Log::info('uchebnyy-centr-yulii-zvarich');
                }
                $sitemap->add(route('school', ['slug' => $school->slug]), $school->created_at, '1.0', 'monthly', [], null, [
                    ['language' => 'ru', 'url' => URL::to('school/' . $school->slug)],
                    ['language' => 'uk', 'url' => URL::to('ua/school/' . $school->slug)],
                    ['language' => 'en', 'url' => URL::to('en/school/' . $school->slug)],
		    ['language' => 'pt', 'url' => URL::to('pt/school/' . $school->slug)],
                ]);
            }
            // Pages
            $sitemap->add(URL::to('/'), '2012-08-25T20:10:00+02:00', '1.0', 'daily', [], null,
                [
                    ['language' => 'ru', 'url' => URL::to('')],
                    ['language' => 'uk', 'url' => URL::to('ua')],
                    ['language' => 'en', 'url' => URL::to('en')],
		    ['language' => 'pt', 'url' => URL::to('pt')],
                ]);
            $sitemap->add(URL::to('/about'), '2012-08-25T20:10:00+02:00', '1.0', 'daily', [], null,
                [
                    ['language' => 'ru', 'url' => URL::to('about')],
                    ['language' => 'uk', 'url' => URL::to('ua/about')],
                    ['language' => 'en', 'url' => URL::to('en/about')],
		    ['language' => 'pt', 'url' => URL::to('pt/about')],
                ]);
            $sitemap->add(URL::to('/partners-and-cooperation'), '2012-08-25T20:10:00+02:00', '1.0', 'daily', [], null,
                [
                    ['language' => 'ru', 'url' => URL::to('partners-and-cooperation')],
                    ['language' => 'uk', 'url' => URL::to('ua/partners-and-cooperation')],
                    ['language' => 'en', 'url' => URL::to('en/partners-and-cooperation')],
		    ['language' => 'pt', 'url' => URL::to('pt/partners-and-cooperation')],
                ]);
            $sitemap->add(URL::to('/shop-and-service'), '2012-08-25T20:10:00+02:00', '1.0', 'daily', [], null,
                [
                    ['language' => 'ru', 'url' => URL::to('shop-and-service')],
                    ['language' => 'uk', 'url' => URL::to('ua/shop-and-service')],
                    ['language' => 'en', 'url' => URL::to('en/shop-and-service')],
		    ['language' => 'pt', 'url' => URL::to('pt/shop-and-service')],
                ]);
            $sitemap->add(URL::to('/career'), '2012-08-25T20:10:00+02:00', '1.0', 'daily', [], null,
                [
                    ['language' => 'ru', 'url' => URL::to('career')],
                    ['language' => 'uk', 'url' => URL::to('ua/career')],
                    ['language' => 'en', 'url' => URL::to('en/career')],
		    ['language' => 'pt', 'url' => URL::to('pt/career')],
                ]);
//            $sitemap->add(URL::to('/service'), '2012-08-25T20:10:00+02:00', '1.0', 'daily', [], null,
//                [
//                    ['language' => 'ru', 'url' => URL::to('service')],
//                    ['language' => 'uk', 'url' => URL::to('ua/service')],
//                    ['language' => 'en', 'url' => URL::to('en/service')],
//                ]);
            $sitemap->add(URL::to('/maintenance'), '2012-08-25T20:10:00+02:00', '1.0', 'daily', [], null,
                [
                    ['language' => 'ru', 'url' => URL::to('maintenance')],
                    ['language' => 'uk', 'url' => URL::to('ua/maintenance')],
                    ['language' => 'en', 'url' => URL::to('en/maintenance')],
		    ['language' => 'pt', 'url' => URL::to('pt/maintenance')],
                ]);
            $sitemap->add(URL::to('/education'), '2012-08-25T20:10:00+02:00', '1.0', 'daily', [], null,
                [
                    ['language' => 'ru', 'url' => URL::to('education')],
                    ['language' => 'uk', 'url' => URL::to('ua/education')],
                    ['language' => 'en', 'url' => URL::to('en/education')],
		    ['language' => 'pt', 'url' => URL::to('pt/education')],
                ]);
            $sitemap->add(URL::to('/faq'), '2012-08-25T20:10:00+02:00', '1.0', 'daily', [], null,
                [
                    ['language' => 'ru', 'url' => URL::to('faq')],
                    ['language' => 'uk', 'url' => URL::to('ua/faq')],
                    ['language' => 'en', 'url' => URL::to('en/faq')],
		    ['language' => 'pt', 'url' => URL::to('pt/faq')],
                ]);
            $sitemap->add(URL::to('/contacts'), '2012-08-25T20:10:00+02:00', '1.0', 'daily', [], null,
                [
                    ['language' => 'ru', 'url' => URL::to('contacts')],
                    ['language' => 'uk', 'url' => URL::to('ua/contacts')],
                    ['language' => 'en', 'url' => URL::to('en/contacts')],
		    ['language' => 'pt', 'url' => URL::to('pt/contacts')],
                ]);
            $sitemap->add(URL::to('/catalog'), '2012-08-25T20:10:00+02:00', '1.0', 'daily', [], null,
                [
                    ['language' => 'ru', 'url' => URL::to('catalog')],
                    ['language' => 'uk', 'url' => URL::to('ua/catalog')],
                    ['language' => 'en', 'url' => URL::to('en/catalog')],
		    ['language' => 'pt', 'url' => URL::to('pt/catalog')],
                ]);
            $sitemap->add(URL::to('/catalog-pro'), '2012-08-25T20:10:00+02:00', '1.0', 'daily', [], null,
                [
                    ['language' => 'ru', 'url' => URL::to('catalog-pro')],
                    ['language' => 'uk', 'url' => URL::to('ua/catalog-pro')],
                    ['language' => 'en', 'url' => URL::to('en/catalog-pro')],
		    ['language' => 'pt', 'url' => URL::to('pt/catalog-pro')],
                ]);

            $sitemap->add(URL::to('/about-cookie'), '2012-08-25T20:10:00+02:00', '1.0', 'daily', [], null,
                [
                    ['language' => 'ru', 'url' => URL::to('about-cookie')],
                    ['language' => 'uk', 'url' => URL::to('ua/about-cookie')],
                    ['language' => 'en', 'url' => URL::to('en/about-cookie')],
		    ['language' => 'pt', 'url' => URL::to('pt/about-cookie')],
                ]);

        }

        // generate your sitemap (format, filename)
        //$sitemap->store('xml', 'sitemap');
        // this will generate file mysitemap.xml to your public folder

        // show your sitemap (options: 'xml' (default), 'html', 'txt', 'ror-rss', 'ror-rdf')
        return $sitemap->render('xml');
    }
}
