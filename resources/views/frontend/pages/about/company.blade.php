@extends('frontend.layouts.app')

@section('title', $page->translate(App::getLocale())->seo_title)
@section('description', $page->translate(App::getLocale())->seo_description)
@section('keywords', $page->translate(App::getLocale())->seo_keywords)

@section('body_class', 'template-about')

@section('content')
    <section class="page pAbout">
        <div class="pAbout__wrap">
            <div class="container">
                @include('frontend.pages.about.parts.header', ['headerImg' => 'aboutImg.jpg'])
                <hr class="fullLine">
                <h1 class="pAbout__pageTitle">
                    {{ $page->translate(App::getLocale())->title }}
                </h1>
                <div class="pAbout__content--left">
                    <p class="pAbout__title">
                        <strong class="pAbout__count">01</strong>
                        @lang('main.about_title_1')
                    </p>
                    <div class="pAbout__text">
                        @lang('main.about_text_1')
                    </div>
                    <div class="pAbout__image" data-aos="fade-left">
                        {{--<img src="{{ asset('frontend/img/about/aboutPic-01.jpg') }}" alt="">--}}
                        <div class="iframeBox--big">
                            <iframe width="560" height="315" src="https://www.youtube.com/embed/uQ6_bpXjZfM" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
                <div class="pAbout__content--right">
                    <p class="pAbout__title">
                        <strong class="pAbout__count">02</strong>
                        @lang('main.about_title_2')
                    </p>
                    <div class="pAbout__text">
                        @lang('main.about_text_2')
                    </div>
                    <div class="pAbout__image" data-aos="fade-right">
                        <img src="{{ asset('frontend/img/about/aboutPic-02.jpg') }}" alt="">
                    </div>
                </div>
                <div class="pAbout__content--left">
                    <p class="pAbout__title">
                        <strong class="pAbout__count">03</strong>
                        @lang('main.about_title_3')
                    </p>
                    <div class="pAbout__text">
                        @lang('main.about_text_3')
                    </div>
                    <div class="pAbout__image" data-aos="fade-left">
                        <img src="{{ asset('frontend/img/about/aboutPic-03.jpg') }}" alt="">
                    </div>
                </div>
                <div class="pAbout__content--right">
                    <p class="pAbout__title">
                        <strong class="pAbout__count">04</strong>
                        @lang('main.about_title_4')
                    </p>
                    <div class="pAbout__text">
                        @lang('main.about_text_4')
                    </div>
                </div>
                <div class="pAbout__history">
                    <div class="row">
                        <div class="col-xs-12 col-md-3">
                            <p class="pAbout__title">
                                <strong class="pAbout__count">05</strong>
                                {!! trans('main.about_title_5') !!}
                            </p>
                        </div>
                        <div class="col-xs-12 col-md-9">
                            <div class="pAbout__historySlider">
                                <div class="pAboutHistorySlider" id="pAboutHistorySlider">
                                    <div class="pAboutHistorySlider__wrap">
                                        @for ($i=1; $i<=11; $i++) : 
                                        <div class="pAboutHistorySlider__item">
                                            <p class="pAboutHistorySlider__year">
                                                @lang('main.history_' . $i)
                                            </p>
                                            <div class="pAboutHistorySlider__text">
                                                @lang('main.history_text_' . $i)
                                            </div>
                                        </div>
                                        @endfor 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pAbout__bg">
                <span class="img"></span>
            </div>
        </div>
        <div class="pAboutHistorySlider__lastYear">
            <div class="row reverse">
                <div class="col-xs-12 col-lg-6">
                    <div class="pAboutHistorySlider__content">
                        <p class="pAboutHistorySlider__year">
                            @lang('main.history_last_title')
                        </p>
                        <div class="pAboutHistorySlider__text">
                            <div class="row">
                                <div class="col-xs-6 col-md-4">
                                    {!! trans('main.history_last1') !!}
                                </div>
                                <div class="col-xs-6 col-md-4">
                                    {!! trans('main.history_last2') !!}
                                </div>
                                <div class="col-xs-6 col-md-4">
                                    {!! trans('main.history_last3') !!}
                                </div>
                                <div class="col-xs-6 col-md-4">
                                    {!! trans('main.history_last4') !!}
                                </div>
                                <div class="col-xs-6 col-md-4">
                                    {!! trans('main.history_last5') !!}
                                </div>
                                <div class="col-xs-6 col-md-4">
                                    {!! trans('main.history_last6') !!}
                                </div>
                            </div>
                            {!! trans('main.history_last7') !!}
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-lg-6 image" style="background-image: url('{{ asset('frontend/img/about/pAbout__lastYear.jpg') }}')">
                    <a href="https://www.youtube.com/watch?v=uMM7fKiRyeo" class="popup-ifrane">
                        <svg width="130px" height="130px">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-play"></use>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
