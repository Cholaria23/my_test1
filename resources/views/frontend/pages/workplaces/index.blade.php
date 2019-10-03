@extends('frontend.layouts.app')

@section('title', $page->translate(App::getLocale())->seo_title)
@section('description', $page->translate(App::getLocale())->seo_description)
@section('keywords', $page->translate(App::getLocale())->seo_keywords)

@section('content')
    <section class="page pWorkplaces">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h1 class="pPosters__title">
                        @lang('main.workplaces')
                    </h1>
                </div>
                @foreach($workplaces as $workplace)
                    <div class="col-xs-12 col-md-6 col-lg-4">
                        @include('frontend.pages.workplaces.parts.preview')
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection