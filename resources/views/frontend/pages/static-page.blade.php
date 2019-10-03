@extends('frontend.layouts.app')

@section('title', $page->translate(App::getLocale())->seo_title)
@section('description', $page->translate(App::getLocale())->seo_description)
@section('keywords', $page->translate(App::getLocale())->seo_keywords)

@section('content')
    <section class="page page--topForHeader pText">
        <div class="container">
            <ul class="mBreadcrumbs" itemscope itemtype="http://data-vocabulary.org/#">
                <li typeof="v:Breadcrumb">
                    <a href="{{ route('home') }}" rel="v:url" property="v:title">
                        @lang('main.main_page') {{ app()->getLocale() === 'ru' ? 'Сталекс' : 'Staleks' }}
                    </a>
                </li>
                <li class="sep">-</li>
                <li typeof="v:Breadcrumb">
                    <span property="v:title">
                        {{ $page->translate(App::getLocale())->title }}
                    </span>
                </li>
            </ul>
            <hr class="fullLine">
            <div class="page__wrap">
                <h1 class="pText__title">
                    {{ $page->translate(App::getLocale())->title }}
                </h1>
                <div class="content pText__content">
                    {!! $content !!}
                </div>
            </div>
        </div>
    </section>
@endsection