@extends('frontend.layouts.app')

@section('title', $page->translate(App::getLocale())->seo_title)
@section('description', $page->translate(App::getLocale())->seo_description)
@section('keywords', $page->translate(App::getLocale())->seo_keywords)

@section('content')
    <section class="page pPosters">
        <div class="container">
            <div class="row">
                @foreach($categories as $category)
                    <div class="col-xs-12">
                        <h2 class="pPosters__title">
                            {{ $category->translate(App::getLocale())->title }}
                        </h2>
                    </div>
                    @foreach($posters[$category->slug] as $poster)
                        <div class="col-xs-12 col-md-6 col-lg-4">
                            @include('frontend.pages.posters.parts.preview')
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>
    </section>
@endsection