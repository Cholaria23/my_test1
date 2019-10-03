@extends('frontend.layouts.app')

@section('title', $article->translate(App::getLocale())->seo_title)
@section('description', $article->translate(App::getLocale())->seo_description)
@section('keywords', $article->translate(App::getLocale())->seo_keywords)

@section('image', $article->thumbImageUrl)

@section('body_class', 'page-article')

@section('content')
    <section class="page page--topForHeader pArticle">
        <div class="container">

            <ul class="mBreadcrumbs" itemscope itemtype="http://data-vocabulary.org/#">
                <li typeof="v:Breadcrumb">
                    <a href="{{ route('home') }}" rel="v:url" property="v:title">
                        @lang('main.main_page') {{ app()->getLocale() === 'ru' ? 'Сталекс' : 'Staleks' }}
                    </a>
                </li>
                <li class="sep">-</li>
                <li typeof="v:Breadcrumb">
                    <a href="{{ route('blog', ['slug' => $article->category->slug]) }}" rel="v:url" property="v:title">
                        {{ $article->category->translate(App::getLocale())->title }}
                    </a>
                </li>
                <li class="sep">-</li>
                <li typeof="v:Breadcrumb">
                    <span property="v:title">
                        {{ $article->translate(App::getLocale())->title }}
                    </span>
                </li>
            </ul>

            <hr class="fullLine">
            <div class="page__wrap">
                <div class="row">
                    <div class="col-xs-12 col-lg-9 last-lg">
                        <div class="pArticle__box">
                            <div class="pArticle__img">
                                <img src="{{ $article->thumbImageUrl }}"
                                     alt="{{ $article->translate(App::getLocale())->title }}"
                                     title="{{ $article->translate(App::getLocale())->title }}">
                            </div>
                            <p class="pArticle__date">
                                <strong>
                                    {{ $article->created_at->format('d') }}
                                </strong>
                                {{ $article->created_at->format('m/Y') }}
                            </p>
                        </div>
                        @if ($article->translate(App::getLocale())->short_text)
                            <div class="row">
                                <div class="col-xs-12 col-lg-6">
                                    <h1 class="pArticle__title">
                                        {{ $article->translate(App::getLocale())->title }}
                                    </h1>
                                    <p class="pArticle__cat">
                                        <a href="{{ route('blog', ['slug' => $article->category->slug]) }}">
                                            {{ $article->category->translate(App::getLocale())->title }}
                                        </a>
                                    </p>
                                </div>
                                <div class="col-xs-12 col-lg-6">
                                    <div class="pArticle__short">
                                        {!! $article->translate(App::getLocale())->short_text !!}
                                    </div>
                                </div>
                            </div>
                        @else
                            <h1 class="pArticle__title">
                                {{ $article->translate(App::getLocale())->title }}
                            </h1>
                            <p class="pArticle__cat">
                                <a href="{{ route('blog', ['slug' => $article->category->slug]) }}">
                                    {{ $article->category->translate(App::getLocale())->title }}
                                </a>
                            </p>
                        @endif
                        <div class="content pArticle__content">
                            {!! $article->translate(App::getLocale())->content !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-lg-3">
                        <div class="pArticle__menu">
                            @include('frontend.pages.blog.parts.menu')
                        </div>
                        <div class="pArticle__subscribe">
                            <subscribe-form></subscribe-form>
                        </div>

                        <div class="pArticle__articles rightSidebarModule">
                            <svg width="85px" height="55px" class="iconLogos">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-logos"></use>
                            </svg>
                            <h3 class="rightSidebarModule__title">
                                @lang('main.related_articles')
                            </h3>
                            <div class="bModule__bodyScroll--small">
                                <div>
                                    <div class="gridRow">
                                        <div class="row">
                                            @foreach($articles as $key => $article)
                                                <div class="col-xs-6 col-lg-12 col-xl-12">
                                                    @include('frontend.pages.blog.parts.preview')
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a href="{{ route('blog', ['slug' => $article->category->slug]) }}" class="eBtn--black">
                                @lang('main.more_news')
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection