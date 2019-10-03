@extends('frontend.layouts.app')

@section('title', $page->translate(App::getLocale())->seo_title)
@section('description', $page->translate(App::getLocale())->seo_description)
@section('keywords', $page->translate(App::getLocale())->seo_keywords)

@section('body_class', 'template-about')

@section('script')
    <script>
        window.form_subject_1 = "<?= Config::get('mail.shopRequest_subject') ?>";
        window.form_type_1 = 'shop';
        window.form_subject_2 = "<?= Config::get('mail.sharpenRequest_subject') ?>";
        window.form_type_2 = 'sharpen';
    </script>
@endsection

@section('content')
    <section class="page pAbout">
        <div class="container">
            @include('frontend.pages.about.parts.header', ['headerImg' => 'aboutImg2.jpg'])
            <hr class="fullLine">
            <h1 class="pAbout__pageTitle">
                {{ $page->translate(App::getLocale())->title }}
            </h1>
            <div class="pAbout__descBox--left">
                <p class="pAbout__title">
                    @lang('main.shop_service_title')
                </p>
                <div class="pAbout__text">
                    {!! trans('main.shop_service_text') !!}
                    <p class="row middle-xs">
                        <span class="col">
                            <a href="#form-modal" class="eBtn--black open-popup-link">
                                @lang('main.submit_an_application')
                            </a>
                            <div id="form-modal" class="white-popup--small mfp-hide">
                                <request-form :variation="1"></request-form>
                            </div>
                        </span>
                        {{--<span class="col">--}}
                            {{--<a href="#" class="eLink--black">--}}
                                {{--@lang('main.more')--}}
                            {{--</a>--}}
                        {{--</span>--}}
                    </p>
                </div>
                <div class="pAbout__image" data-aos="fade-left">
                    <img src="{{ asset('frontend/img/about/shopPic-1.jpg') }}" alt="">
                </div>
            </div>
            <hr class="fullLine--right">
            <h3 class="pAbout__titleBig">
                @lang('main.our_services')
            </h3>
            <div class="pAbout__content--left">
                <p class="pAbout__title">
                    <strong class="pAbout__count">01</strong>
                    @lang('main.service_title_1')
                </p>
                <p class="pAbout__text">
                    @lang('main.service_text_1')
                </p>
                <div class="pAbout__image" data-aos="fade-left">
                    <img src="{{ asset('frontend/img/about/shopPic-2.jpg') }}" alt="">
                </div>
            </div>
            <div class="pAbout__content--right">
                <p class="pAbout__title">
                    <strong class="pAbout__count">02</strong>
                    @lang('main.service_title_2')
                </p>
                <p class="pAbout__text">
                    @lang('main.service_text_2')
                </p>
                <div class="pAbout__image" data-aos="fade-right">
                    <img src="{{ asset('frontend/img/about/shopPic-3.jpg') }}" alt="">
                </div>
            </div>
            <div class="pAbout__content--left">
                <p class="pAbout__title">
                    <strong class="pAbout__count">03</strong>
                    @lang('main.service_title_3')
                </p>
                <p class="pAbout__text">
                    @lang('main.service_text_3')
                </p>
                <div class="pAbout__image" data-aos="fade-left">
                    <img src="{{ asset('frontend/img/about/shopPic-4.jpg') }}" alt="">
                </div>
            </div>
            <div class="pAbout__content--right">
                <p class="pAbout__title">
                    <strong class="pAbout__count">04</strong>
                    @lang('main.service_title_4')
                </p>
                <p class="pAbout__text">
                    @lang('main.service_text_4')
                </p>
                <div class="pAbout__image" data-aos="fade-right">
                    <img src="{{ asset('frontend/img/about/shopPic-5.jpg') }}" alt="">
                </div>
            </div>
            <hr class="fullLine">
            <div class="bPeoples gridRow" data-sticky_parent>
                <div class="row">
                    <div class="col-xs-12 col-lg-4 col-xl-3">
                        <div class="bPeoples__box stickInParentBox" data-sticky_column>
                            <svg width="85px" height="55px" class="iconLogos">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-logos"></use>
                            </svg>
                            <h3 class="bPeoples__title">
                                @lang('main.sharpeners')
                            </h3>
                            <div class="bPeoples__desc">
                                @lang('main.sharpeners__desc')
                            </div>
                            <h3 class="bPeoples__title">
                                @lang('main.tools')
                            </h3>
                            <div class="bPeoples__desc">
                                @lang('main.tools__desc')
                            </div>
                            <p>
                                <a href="#sharpen-modal" class="eBtn--white open-popup-link">
                                    @lang('main.sharpen')
                                </a>
                            </p>
                            <div id="sharpen-modal" class="white-popup--small mfp-hide">
                                <request-form :variation="2"></request-form>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-lg-8 col-xl-9" data-sticky_column>
                        <div class="bPeoples__list gridRow">
                            <div class="row">
                                @foreach($sharpeners as $sharpener)
                                    <div class="col-xs-12 col-md-6 col-xl-4">
                                        @include('frontend.pages.about.parts.eRepresentative', ['person' => $sharpener])
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="fullLine">
            <h3 class="pAbout__titleBig">
                @lang('main.service_centers')
            </h3>
            <div class="serviceCenters gridRow">
                <div class="row">
                    @foreach($service_centers as $service_center)
                        <div class="col-xs-12 col-md-6 col-lg-4 col-xl-3">
                            <div class="eServiceCenter">
                                <h5 class="eServiceCenter__title">
                                    {!! $service_center->translate(App::getLocale())->title !!}
                                </h5>
                                <p class="eServiceCenter__label">
                                    @lang('main.address')
                                </p>
                                <div class="eServiceCenter__text">
                                    {!! $service_center->translate(App::getLocale())->address !!}
                                </div>
                                <p class="eServiceCenter__label">
                                    @lang('main.operating_mode')
                                </p>
                                <div class="eServiceCenter__text">
                                    {!! $service_center->translate(App::getLocale())->schedule !!}
                                </div>
                                <p class="eServiceCenter__label">
                                    @lang('main.phones')
                                </p>
                                <div class="eServiceCenter__text">
                                    {!! $service_center->translate(App::getLocale())->phones !!}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection