<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleCategory;
use function foo\func;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Workplace;
use App\Models\ServiceCenter;
use App\Models\User;
use App\Models\School;
use App\Models\SchoolCategory;
use App\Models\MaintenanceCenter;
use App\Models\Faq;
use App\Models\Product;
use App\Models\Serial;
use App\Models\Country;
use App\Models\City;
use App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cookie;

class PageController extends Controller
{
    public function home(Request $request)
    {
        $country_id = Cookie::get('country_id');

        $page = Page::where('type', 'home')->firstOrFail();
        $articles = Article::publish()->latest()->take(4)->get();

        $serials = Serial::standart()->get();
        $serials_ids = [];
        foreach ($serials as $serial) {
            array_push($serials_ids, $serial->id);
        }
        $products = Product::join('product_categories', function ($join) use ($serials_ids) {
            $join->on('products.product_category_id', '=', 'product_categories.id')
                ->whereIn('product_categories.serial_id', $serials_ids);
        })->join('country_to_product', function ($join) use ($country_id) {
            $join->on('products.id', '=', 'country_to_product.product_id');
            if ($country_id) {
                $join->where('country_to_product.country_id', $country_id);
            }
        })->select('products.*')->publish()->new()->latest()->take(4)->get();

        $serials_pro = Serial::pro()->get();
        $serials_pro_ids = [];
        foreach ($serials_pro as $serial) {
            array_push($serials_pro_ids, $serial->id);
        }
        $products_pro = Product::join('product_categories', function ($join) use ($serials_pro_ids) {
            $join->on('products.product_category_id', '=', 'product_categories.id')
                ->whereIn('product_categories.serial_id', $serials_pro_ids);
        })->join('country_to_product', function ($join) use ($country_id) {
            $join->on('products.id', '=', 'country_to_product.product_id');
            if ($country_id) {
                $join->where('country_to_product.country_id', $country_id);
            }
        })->select('products.*')->publish()->new()->latest()->take(4)->get();

        return view()->make('frontend.pages.home', compact('page', 'articles', 'products', 'products_pro'));
    }

    public function switcher()
    {
        return view()->make('frontend.pages.start');
    }

    public function about()
    {
        $item = new Page();
        $table = $item->getTable();
        $translationsTable = $item->translationsTable;

        $page = $item::where('type', 'about')->firstOrFail();

        $pages = $item::join($translationsTable . ' as t', function ($join) use ($table) {
            $join->on($table . '.id', '=', 't.page_id')
                ->where('t.locale', '=', App::getLocale());
        })->where('type', 'about')
            ->orWhere('type', 'partners-and-cooperation')
            ->orWhere('type', 'shop-and-service')
            ->orWhere('type', 'career')
            ->select('title', 'slug')->get();
        return view()->make('frontend.pages.about.company', compact('page', 'pages'));
    }

    public function cooperation()
    {
        $item = new Page();
        $table = $item->getTable();
        $translationsTable = $item->translationsTable;

        $page = $item::where('type', 'partners-and-cooperation')->firstOrFail();

        $pages = $item::join($translationsTable . ' as t', function ($join) use ($table) {
            $join->on($table . '.id', '=', 't.page_id')
                ->where('t.locale', '=', App::getLocale());
        })->where('type', 'about')
            ->orWhere('type', 'partners-and-cooperation')
            ->orWhere('type', 'shop-and-service')
            ->orWhere('type', 'career')
            ->select('title', 'slug')->get();
        return view()->make('frontend.pages.about.cooperation', compact('page', 'pages'));
    }

    public function shopService()
    {
        $item = new Page();
        $table = $item->getTable();
        $translationsTable = $item->translationsTable;

        $page = $item::where('type', 'shop-and-service')->firstOrFail();

        $pages = $item::join($translationsTable . ' as t', function ($join) use ($table) {
            $join->on($table . '.id', '=', 't.page_id')
                ->where('t.locale', '=', App::getLocale());
        })->where('type', 'about')
            ->orWhere('type', 'partners-and-cooperation')
            ->orWhere('type', 'shop-and-service')
            ->orWhere('type', 'career')
            ->select('title', 'slug')->get();

        $service_centers = ServiceCenter::where('publish', true)->get();

        $sharpeners = User::whereHas('role', function ($q) {
            $q->where('type', 'sharpeners');

        })->get();

        return view()->make('frontend.pages.about.shop', compact('page', 'pages', 'service_centers', 'sharpeners'));
    }

    public function career()
    {
        $item = new Page();
        $table = $item->getTable();
        $translationsTable = $item->translationsTable;

        $page = $item::where('type', 'career')->firstOrFail();

        $pages = $item::join($translationsTable . ' as t', function ($join) use ($table) {
            $join->on($table . '.id', '=', 't.page_id')
                ->where('t.locale', '=', App::getLocale());
        })->where('type', 'about')
            ->orWhere('type', 'partners-and-cooperation')
            ->orWhere('type', 'shop-and-service')
            ->orWhere('type', 'career')
            ->select('title', 'slug')->get();

        $workplaces = Workplace::where('publish', true)->get();

        return view()->make('frontend.pages.about.career', compact('page', 'pages', 'workplaces'));
    }

    public function faq()
    {
        $faq = Faq::where('publish', true)->get();
        $page = Page::where('type', 'faq')->firstOrFail();

        return view()->make('frontend.pages.faq', compact('page', 'faq'));
    }

    public function contacts()
    {
        $page = Page::where('type', 'contacts')->firstOrFail();
        return view()->make('frontend.pages.contacts', compact('page'));
    }

//    public function service()
//    {
//        $item = new Page();
//        $table = $item->getTable();
//        $translationsTable = $item->translationsTable;
//
//        $page = $item::where('type', 'service')->firstOrFail();
//
//        $pages = $item::join($translationsTable . ' as t', function ($join) use ($table) {
//            $join->on($table . '.id', '=', 't.page_id')
//                ->where('t.locale', '=', App::getLocale());
//        })->where('type', 'maintenance')
////            ->orWhere('type', 'service')
//            ->orWhere('type', 'education')
//            ->select('title', 'slug')->get();
//
//        $article_category = ArticleCategory::where('type', 'events-and-exhibitions')->first();
//        $article_category_slug = $article_category->slug;
//        $articles = Article::where('article_category_id', $article_category->id)->publish()->latest()->take(3)->get();
//
//        $ambassadors = User::whereHas('role', function($q)
//        {
//            $q->where('type', 'ambassadors');
//
//        })->get();
//
//        $instructors = User::whereHas('role', function($q)
//        {
//            $q->where('type', 'instructors');
//
//        })->get();
//
//        $technologists = User::whereHas('role', function($q)
//        {
//            $q->where('type', 'technologists');
//
//        })->get();
//
//        return view()->make('frontend.pages.about.service', compact('page', 'pages', 'articles', 'article_category_slug', 'ambassadors', 'instructors', 'technologists'));
//    }

    public function maintenance($country = null, $city = null)
    {
        $item = new Page();
        $table = $item->getTable();
        $translationsTable = $item->translationsTable;

        $page = $item::where('type', 'maintenance')->firstOrFail();

        $pages = $item::join($translationsTable . ' as t', function ($join) use ($table) {
            $join->on($table . '.id', '=', 't.page_id')
                ->where('t.locale', '=', App::getLocale());
        })
            ->where('type', 'maintenance')
//            ->orWhere('type', 'service')
            ->orWhere('type', 'education')
            ->select('title', 'slug')->get();

        $article_category = ArticleCategory::where('type', 'events-and-exhibitions')->first(); // TODO: Fix when category not publish
        $article_category_slug = $article_category->slug;
        $articles = Article::where('publish', true)->where('article_category_id', $article_category->id)->publish()->latest()->take(3)->get();


        if ($country && null === $city) {
            $maintenance_centers = MaintenanceCenter::publish()->whereHas('city', function ($query) use ($country) {
                $query->whereHas('country', function($country_query) use ($country) {
                    $country_query->where('slug', $country);
                });
            })->paginate(11);
        } elseif ($country && $city) {
            $maintenance_centers = MaintenanceCenter::publish()->whereHas('city', function ($query) use ($city, $country) {
                $query->whereHas('country', function($country_query) use ($country) {
                    $country_query->where('slug', $country);
                });
                $query->where('slug', $city);
            })->paginate(11);
        } else {
            $maintenance_centers = MaintenanceCenter::publish()->paginate(11);
        }
        if (!$maintenance_centers->count()) {
            abort(404);
        }

        $countries = Country::all(); // TODO: fix it and remove from blade
        $locationCountry = null;
        $locationCity = null;
        $cities = null;
        if ($country) {
            $locationCountry = Country::where('slug', $country)->first();
            $cities = City::whereHas('country', function ($query) use ($country) {
                $query->whereTranslation('title', $country, 'en');
            })->get();
        }
        if ($city) {
            $locationCity = City::where('slug', $city)->first();
        }

        return view()->make('frontend.pages.about.maintenance', compact(
            'page',
            'pages',
            'articles',
            'article_category_slug',
            'maintenance_centers',
            'countries',
            'cities',
            'locationCountry',
            'locationCity'
            )
        );
    }

    public function education(Request $request, $country = null, $city = null)
    {
        $item = new Page();
        $table = $item->getTable();
        $translationsTable = $item->translationsTable;

        $page = $item::where('type', 'education')->firstOrFail();

        $pages = $item::join($translationsTable . ' as t', function ($join) use ($table) {
            $join->on($table . '.id', '=', 't.page_id')
                ->where('t.locale', '=', App::getLocale());
        })->where('type', 'maintenance')
//            ->orWhere('type', 'service')
            ->orWhere('type', 'education')
            ->select('title', 'slug')->get();

        $article_courses_category = ArticleCategory::where('type', 'courses-schools')->first();
        $courses_slug = $article_courses_category->slug;
        $courses = Article::where('article_category_id', $article_courses_category->id)->publish()->latest()->take(3)->get();

        $article_training_category = ArticleCategory::where('type', 'video-training')->first();
        $training_slug = $article_training_category->slug;
        $training = Article::where('article_category_id', $article_training_category->id)->publish()->latest()->take(3)->get();


        $schools = School::whereHas('translations', function ($query) use ($request, $country, $city) {
            $query->where('locale', App::getLocale());
            if ($country) {
                $query->where('country', $country);
            }
            if ($city) {
                $query->where('city', $city);
            }
        })->where('publish', true);

        if ($request->input('category')) {
            $schools->whereHas('schoolCategories', function ($q) use ($request) {
                $q->where('school_category_id', $request->input('category'));
            });
        }

        $schools = $schools->get();

        $school_categories = SchoolCategory::all();

        $countries = \DB::table('school_translations')->where('locale', App::getLocale())->select(['country'])->groupBy('country')->orderBy('country', 'asc')->get()->toArray();
        $cities = null;
        if ($country) {
            $cities = \DB::table('school_translations')->where('locale', App::getLocale())->where('country', $country)->select(['city'])->groupBy('city')->orderBy('city', 'asc')->get()->toArray();
        }

        $page_seo_title = $page->translate(App::getLocale())->seo_title;
        $page_seo_description = $page->translate(App::getLocale())->seo_description;
        $location = null;
        $school_category = null;
        if (request()->route('country')) {
            $country = mb_strtoupper(mb_substr(request()->route('country'), 0, 1)) . mb_substr(request()->route('country'), 1);
            $location = ', ' . $country;
        }
        if (request()->route('city')) {
            $city = mb_strtoupper(mb_substr(request()->route('city'), 0, 1)) . mb_substr(request()->route('city'), 1);
            $location .= ', ' . $city;
        }
        if ($request->input('category')[0]) {
            $school_category = SchoolCategory::find((int)$request->input('category')[0]);
        } else {
            $school_category = SchoolCategory::where('slug', 'nogtevoy-servis')->first(); // TODO fix hardcode
        }
        $seoTitle1 = $school_category->translate(app()->getLocale())->getAttribute('seo-title-1');
        $seoTitle2 = $school_category->translate(app()->getLocale())->getAttribute('seo-title-2');
        if ($location && $school_category) {
            $page_seo_title = trans('main.seo_title_education', [
                'location' => $location,
                'category' => $seoTitle1
            ]);
            $page_seo_description = trans('main.seo_desc_education', [
                'location' => $location,
                'category' => $seoTitle2
            ]);
        }
        if ($location && !$school_category) {
            $page_seo_title = trans('main.seo_title_education', [
                'location' => $location,
                'category' => trans('main.seo_category_education')
            ]);
            $page_seo_description = trans('main.seo_desc_education', [
                'location' => $location,
                'category' => $seoTitle2
            ]);
        }
        if (!$location && $school_category) {
            $page_seo_title = trans('main.seo_title_education', [
                'location' => '',
                'category' => $seoTitle1
            ]);
            $page_seo_description = trans('main.seo_desc_education', [
                'location' => '',
                'category' => $seoTitle2
            ]);
        }

        return view()->make('frontend.pages.about.education', compact('page', 'pages', 'courses', 'courses_slug', 'training', 'training_slug', 'schools', 'school_categories', 'countries', 'cities', 'page_seo_title', 'page_seo_description'));
    }

    public function workplace($slug)
    {
        $workplace = Workplace::where('slug', $slug)->firstOrFail();
        if ($workplace && $workplace->publish) {
            return view()->make('frontend.pages.workplaces.show', compact('workplace'));
        }
        return redirect(route('home'));
    }

    public function agreement()
    {
        $page = Page::where('type', 'agreement')->firstOrFail();
        $content = $page->fields()->where('advanced_name', 'agreement-text-1')->first()->translate(App::getLocale())->text;
        return view()->make('frontend.pages.static-page', compact('page', 'content'));
    }

    public function privacyPolicy()
    {
        $page = Page::where('type', 'privacy_policy')->firstOrFail();
        $content = $page->fields()->where('advanced_name', 'privacy-policy-text-1')->first()->translate(App::getLocale())->text;
        return view()->make('frontend.pages.static-page', compact('page', 'content'));
    }

    public function aboutCookie()
    {
        $page = Page::where('type', 'about_cookie')->firstOrFail();
        $content = $page->fields()->where('advanced_name', 'cookie-text-1')->first()->translate(App::getLocale())->text;
        return view()->make('frontend.pages.static-page', compact('page', 'content'));
    }
}
