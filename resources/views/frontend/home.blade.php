@extends('frontend.layouts.app')

@section('title', $page->translate(App::getLocale())->seo_title)
@section('description', $page->translate(App::getLocale())->seo_description)
@section('keywords', $page->translate(App::getLocale())->seo_keywords)

@section('color', 'black')
@section('body_class', 'page-home')

@section('content')

    <div class="pHome">

        <div class="pHome__slider" id="pHome__slider">
            <main-slider :locale="'{{ app()->getLocale() }}'"></main-slider>
            @if($products_pro->count())
            <div class="productsSlider--pro">
                <div class="container">
                    <div class="bModule">
                        <div class="bModule__header">
                            <h3 class="bModule__title">
                                {{ trans('main.new_models') }} STALEKS&#160;PRO
                            </h3>
                            <a href="#" class="bModule__moreLink">
                                {{ trans('main.all_models') }}
                            </a>
                        </div>
                        <div class="bModule__body">
                            <div class="bModule__bodyScroll">
                                <div>
                                    <div class="gridRow">
                                        <div class="row">
                                            @foreach($products_pro as $product)
                                                <div class="col-xs-3 col-md-6 col-lg-3">
                                                    @include('frontend.pages.catalog.parts.preview', ['product_route' => 'product-pro'])
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{--<p class="bModule__bottomBtnBox">--}}
                                {{--<a href="{{ route('catalog-pro') }}" class="eBtn--white">--}}
                                    {{--{{ trans('main.all_models') }}--}}
                                {{--</a>--}}
                            {{--</p>--}}
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @if($products->count())
            <div class="productsSlider--standart">
                <div class="container">
                    <div class="bModule">
                        <div class="bModule__header">
                            <h3 class="bModule__title">
                                {{ trans('main.new_models') }} STALEKS
                            </h3>
                            <a href="#" class="bModule__moreLink">
                                {{ trans('main.all_models') }}
                            </a>
                        </div>
                        <div class="bModule__body">
                            <div class="bModule__bodyScroll">
                                <div>
                                    <div class="gridRow">
                                        <div class="row">
                                            @foreach($products as $product)
                                                <div class="col-xs-3 col-md-6 col-lg-3">
                                                    @include('frontend.pages.catalog.parts.preview', ['product_route' => 'product'])
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{--<p class="bModule__bottomBtnBox">--}}
                                {{--<a href="{{ route('catalog') }}" class="eBtn--black">--}}
                                    {{--{{ trans('main.all_models') }}--}}
                                {{--</a>--}}
                            {{--</p>--}}
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>

        <div class="pHome__wrap">
            <div class="pHome__news">
                <div class="container">
                    <div class="bModule">
                        <div class="bModule__header">
                            <h3 class="bModule__title">
                               {{-- @lang('main.last_news')  --}}
                            </h3>
                            <a href="{{ route('blog') }}" class="bModule__moreLink">
                               {{-- @lang('main.all_news') --}}
                            </a>
                        </div>
                        <div class="bModule__body">
                            <div class="bModule__bodyScroll">
                                <div>
                                    <div class="gridRow">
                                        <div class="row">
                                          {{--  @foreach($articles as $article) --}}
                                          {{--      <div class="col-xs-3 col-md-6 col-lg-3"> --}}
                                           {{--         @include('frontend.pages.blog.parts.preview') --}}
                                           {{--     </div>  --}}
                                           {{-- @endforeach --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p class="bModule__bottomBtnBox">
                                <a href="{{ route('blog') }}" class="eBtn--black">
                                 {{--   @lang('main.all_news') --}}
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pHome__content">
                <div class="container">
                    <div class="gridRow">
                        <div class="row">
                            <div class="col-xs-12 col-lg-6">
                                <h1 style="font-size:22px;">
                                    {{ trans('main.home_seo_title_1') }}
                                </h1>
                                <div class="text">
                                    {!! trans('main.home_seo_text_1') !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-lg-6">
                                <h3>
                                    {{ trans('main.home_seo_title_2') }}
                                </h3>
                                <div class="text">
                                    {!! trans('main.home_seo_text_2') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
