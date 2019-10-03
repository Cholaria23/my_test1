<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Product;
use App\Models\Article;
use App\Models\ArticleCategory;
use App;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search') && !is_null($request->get('search')) && $request->get('search') != '') {

            $search = $request->get('search');

            $products = Product::join('product_translations as t', function ($join) use ($search) {
                $join->on('products.id', '=', 't.product_id')
                    ->where('t.locale', '=', App::getLocale());
            })
                ->select('products.*')
                ->orderBy('created_at', 'DESC')
                ->where('products.model', 'LIKE', '%' . $search . '%')
                ->orWhere('products.sku', 'LIKE', '%' . $search . '%')
                ->orWhere('t.title', 'LIKE', '%' . $search . '%')
                ->orWhere('t.short_text', 'LIKE', '%' . $search . '%')
                ->publish()
                ->get();

            $articles = Article::join('article_translations as t', function ($join) use ($search) {
                $join->on('articles.id', '=', 't.article_id')
                    ->where('t.locale', '=', App::getLocale());
            })
                ->select('articles.*')
                ->orderBy('created_at', 'DESC')
                ->orWhere('t.title', 'LIKE', '%' . $search . '%')
                ->orWhere('t.content', 'LIKE', '%' . $search . '%')
                ->publish()
                ->get();

            return view()->make('frontend.pages.search', compact('articles', 'products'));

        } else {
            return redirect(route('home'));
        }
    }
}
