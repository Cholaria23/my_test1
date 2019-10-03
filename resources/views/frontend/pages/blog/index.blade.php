@extends('frontend.layouts.app')

@section('title', $page->translate(App::getLocale())->seo_title)
@section('description', $page->translate(App::getLocale())->seo_description)
@section('keywords', $page->translate(App::getLocale())->seo_keywords)

@section('content')
    <section class="page--topForHeader pBlog">
        <div class="container">
            <h1 class="page__title">
                @if (!Request::route('slug'))
                    @lang('main.staleks_world')
                @else
                    @foreach($categories as $category)
                       @if((Route::currentRouteName() == 'blog' && Request::route('slug') == $category->slug))
                           {{ $category->translate(App::getLocale())->title }}
                        @endif
                    @endforeach
                @endif
            </h1>
            <hr class="fullLine">
            <div class="pBlog__menu">
                @include('frontend.pages.blog.parts.menu')
            </div>
            <div class="gridRow">
                <div class="row">
                    @foreach($articles as $key => $article)
                        <div class="col-xs-12 col-md-6 col-lg-4 col-xl-3">
                            @include('frontend.pages.blog.parts.preview')
                        </div>
                    @endforeach
                    <div class="col-xs-12">
                        {{ $articles->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection