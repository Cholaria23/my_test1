<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\Page;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug = null)
    {
        $page = null;

        if ($slug) {
            $page = ArticleCategory::where('slug', $slug)->publish()->firstOrFail();
            $articles = Article::filterByCategory($page->id)->publish()->latest()->paginate(12); // TODO: fix when category not publish
        } else {
            $page = Page::where('type', 'blog')->firstOrFail();
            $articles = Article::publish()->latest()->paginate(12);
        }

        $articlesCount = $articles->count();
        $categories = ArticleCategory::publish()->get();
        return view()->make('frontend.pages.blog.index', compact('articles', 'articlesCount', 'categories', 'page'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();
        if (!$article->publish) {
            return redirect(route('blog'));
        }
        $article->increment('views');
        $articles = Article::where('id', '!=', $article->id)->latest()->inRandomOrder()->take(2)->get();
        $articlesCount = Article::latest()->get()->count();
        $categories = ArticleCategory::latest()->publish()->get();
        return view()->make('frontend.pages.blog.show', compact('article', 'articles', 'articlesCount', 'categories'));
    }


}
