<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Models\Page;
use App\Models\Article;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductAppointment;
use App\Models\Serial;
use App\Models\Attribute;
use App;

class ProductController extends Controller
{
    public $type;
    public $page;

    public function __construct(Request $request)
    {
        $route_name = $request->route()->getName();
        if (stripos($route_name, 'pro')) {
            $this->type = 'pro';
            $this->page = Page::where('type', 'catalog-pro')->first();
        } else {
            $this->type = 'standart';
            $this->page = Page::where('type', 'catalog')->first();
        }
    }

    public function catalog(Request $request)
    {
        $page = $this->page;
        $type = $this->type;

        $serials = Serial::where('type', $type)->orderBy('created_at', 'ASC')->get();
        $serials_ids = [];
        foreach ($serials as $serial) {
            $serials_ids[] = $serial->id;
        }

        $appointments = ProductAppointment::all();

        $country_id = Cookie::get('country_id');

        $products = Product::join('product_categories', function ($join) use ($serials_ids) {
            $join->on('products.product_category_id', '=', 'product_categories.id')
                ->whereIn('product_categories.serial_id', $serials_ids);
        })->join('country_to_product', function ($join) use ($country_id) {
            $join->on('products.id', '=', 'country_to_product.product_id');
            if ($country_id) {
                $join->where('country_to_product.country_id', $country_id);
            }
        })->select('products.*')
            ->where('publish', true)
            ->groupBy('products.id')
//            ->orderBy('created_at', 'DESC')
            ->orderBy('sku', 'asc')
            ->paginate(12);

        if (!$products->count()) {
            abort(404);
        }

        return view()->make('frontend.pages.catalog.index', compact(
            'page',
            'products',
            'serials',
            'appointments',
            'type'
        ));
    }

    public function catalogByCategory($slug, Request $request) {
        $type = $this->type;

        if (!$slug) {
            return abort(404);
        }

        $serials = Serial::where('type', $type)->orderBy('created_at', 'ASC')->get();

        $appointments = ProductAppointment::all();

        $selected_category = ProductCategory::where('slug', $slug)->firstOrFail();
        $page = $selected_category;

        $country_id = Cookie::get('country_id');

        $products = Product::join('product_categories', function ($join) use ($slug) {
            $join->on('products.product_category_id', '=', 'product_categories.id')
                ->where('product_categories.slug', $slug);
        })->join('country_to_product', function ($join) use ($country_id) {
            $join->on('products.id', '=', 'country_to_product.product_id');
            if ($country_id) {
                $join->where('country_to_product.country_id', $country_id);
            }
        })->select('products.*')
            ->where('publish', true)
            ->groupBy('products.id')
            ->orderBy('sku', 'asc')
            ->paginate(12);

        if (!$products->count()) {
            abort(404);
        }

        return view()->make('frontend.pages.catalog.index', compact(
            'page',
            'products',
            'selected_category',
            'serials',
            'appointments',
            'selected_category',
            'slug',
            'type'
        ));
    }

    public function catalogBySeries($slug, Request $request) {
        $type = $this->type;

        if (!$slug) {
            return abort(404);
        }
        $serial = Serial::where('slug', $slug)->firstOrFail();
        $page = $serial;
        $serials = [$serial];

        $appointments = ProductAppointment::all();

        $country_id = Cookie::get('country_id');

        $products = Product::join('product_categories', function ($join) use ($serial) {
            $join->on('products.product_category_id', '=', 'product_categories.id')
                ->where('product_categories.serial_id', $serial->id);
        })->join('country_to_product', function ($join) use ($country_id) {
            $join->on('products.id', '=', 'country_to_product.product_id');
            if ($country_id) {
                $join->where('country_to_product.country_id', $country_id);
            }
        })->select('products.*')
            ->where('publish', true)
            ->groupBy('products.id')
            ->orderBy('sku', 'asc')
            ->paginate(12);

        if (!$products->count()) {
            abort(404);
        }

        return view()->make('frontend.pages.catalog.index', compact(
            'page',
            'products',
            'serials',
            'slug',
            'type',
            'appointments'
        ));
    }

    public function catalogByAppointment($slug, Request $request) {
        $page = $this->page;
        $type = $this->type;
        $selected_appointment = ProductAppointment::where('slug', $slug)->first();

        if (!$selected_appointment) {
            return abort(404);
        }
        $serials = Serial::where('type', $type)->orderBy('created_at', 'ASC')->get();
        $serials_ids = [];
        foreach ($serials as $serial) {
            $serials_ids[] = $serial->id;
        }

        $appointments = ProductAppointment::all();

        $country_id = Cookie::get('country_id');

        $products = Product::join('appointment_to_product', function ($join) use ($selected_appointment) {
            $join->on('products.id', '=', 'appointment_to_product.product_id')
                ->where('appointment_to_product.appointment_id', $selected_appointment->id);
        })->join('product_categories', function ($join) use ($serials_ids) {
            $join->on('products.product_category_id', '=', 'product_categories.id')
                ->whereIn('product_categories.serial_id', $serials_ids);
        })->join('country_to_product', function ($join) use ($country_id) {
            $join->on('products.id', '=', 'country_to_product.product_id');
            if ($country_id) {
                $join->where('country_to_product.country_id', $country_id);
            }
        })->select('products.*')
            ->where('publish', true)
            ->groupBy('products.id')
            ->orderBy('sku', 'asc')
            ->paginate(12);

        if (!$products->count()) {
            abort(404);
        }

        return view()->make('frontend.pages.catalog.index', compact(
            'page',
            'products',
            'serials',
            'type',
            'appointments',
            'selected_appointment'
        ));
    }

    public function show($slug, Request $request)
    {
        $route_name = $request->route()->getName();

        $product = Product::where('slug', $slug)->firstOrFail();

        if (!$product->hasTranslation()) {
            abort(404);
        }

        $type = $product->is_pro === 'pro' ? 'pro' : 'standart';

        if ($route_name === 'product-pro' && $type === 'standart') {
            return redirect(route('product', ['slug' => $slug]));
        } else if ($route_name === 'product' && $type === 'pro') {
            return redirect(route('product-pro', ['slug' => $slug]));
        }

        if (!$product->publish) {
            $catalog_url = $type == 'pro' ? 'catalog-pro' : 'catalog';
            return redirect(route($catalog_url));
        }
        if ($product) {
            $product->increment('views');
        }

        $page = Page::where('type', 'catalog')->first();

        $articles = $product->articles()->take(3)->get();

        $serial_id = $product->category()->first()->serial_id;
        $serial = Serial::find($serial_id);
        $is_exclusive = $serial->slug == 'exclusive' ? true : false;

        $serials = Serial::where('type', $type)->get();
        $serials_ids = [];
        foreach ($serials as $serial) {
            array_push($serials_ids, $serial->id);
        }

//        $popular_products = Product::join('product_categories', function ($join) use ($serials_ids, $product) {
//            $join->on('products.product_category_id', '=', 'product_categories.id')
//                ->whereIn('product_categories.serial_id', $serials_ids)
//                ->where('products.id', '!=', $product->id);
//        })->select('products.*')->orderby('views', 'DESC')->take(4)->get();

        $popular_products = Product::where('product_category_id', $product->product_category_id)->orderby('views', 'DESC')->take(4)->get();

        $attribute_categories = [];
        foreach ($product->category->attributecategories as $attributecategory) {
//            $cat_attributes = Attribute::where('attribute_category_id', $attributecategory->id)->get();
            $cat_attributes = Attribute::join('attribute_translations as t', function ($join) {
                $join->on('attributes.id', '=', 't.attribute_id')
                    ->where('t.locale', '=', App::getLocale());
            })
                ->groupBy('attributes.id')
                ->groupBy('t.title')
                ->orderBy('t.title', 'desc')
                ->with('translations')
                ->get();
            $attribute_categories[$attributecategory->translate(App::getLocale())->title] = $cat_attributes;
        }

        return view()->make('frontend.pages.catalog.show', compact('page', 'product', 'articles', 'is_exclusive', 'popular_products', 'attribute_categories'));
    }
}
