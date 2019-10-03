@extends('frontend.layouts.app')

@section('title', $workplace->translate(App::getLocale())->seo_title)
@section('description', $workplace->translate(App::getLocale())->seo_description)
@section('keywords', $workplace->translate(App::getLocale())->seo_keywords)

@section('body_class', 'page-article')

@section('content')
    <section class="page page--topForHeader pWorkplace">
        <div class="container">
            <h1 class="pWorkplace__title">
                {{ $workplace->translate(App::getLocale())->title }}
            </h1>
            <hr class="fullLine">
            <div class="page__wrap">
                <div class="row">
                    <div class="col-xs-12 col-lg-9">
                        <p class="pWorkplace__date">
                            {{ $workplace->created_at->format('d.m.y') }}
                        </p>
                        <div class="content pWorkplace__content">
                            {!! $workplace->translate(App::getLocale())->content !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-lg-3">
                        <workplace-form></workplace-form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection