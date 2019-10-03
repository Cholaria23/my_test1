@extends('frontend.layouts.app')

@section('title', $page->translate(App::getLocale())->seo_title)
@section('description', $page->translate(App::getLocale())->seo_description)
@section('keywords', $page->translate(App::getLocale())->seo_keywords)

@section('body_class', 'template-about')

@section('script')
    <script>
        window.form_subject_1 = "<?= Config::get('mail.instructorRequest_subject') ?>";
        window.form_type_1 = 'instructor';
        window.form_subject_2 = "<?= Config::get('mail.technologistsRequest_subject') ?>";
        window.form_type_2 = 'technologists';
    </script>
@endsection

@section('content')
    <section class="page pAbout">
        <div class="container">
            @include('frontend.pages.about.parts.header', ['headerImg' => 'serviceImg.jpg'])
            <hr class="fullLine">
            <h1 class="pAbout__pageTitle">
                {{ $page->translate(App::getLocale())->title }}
            </h1>
            <div class="bPeoples gridRow" data-sticky_parent>
                <div class="row">
                    <div class="col-xs-12 col-lg-4 col-xl-3">
                        <div class="bPeoples__box--marginBottom stickInParentBox" data-sticky_column>
                            <svg width="85px" height="55px" class="iconLogos">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-logos"></use>
                            </svg>
                            <h3 class="bPeoples__title">
                                @lang('main.brand_ambassadors')
                            </h3>
                            <div class="bPeoples__desc">
                                {!! trans('main.brand_ambassadors_desc') !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-lg-8 col-xl-9" data-sticky_column>
                        <div class="bPeoples__list gridRow">
                            <div class="row">
                                @foreach($ambassadors as $ambassador)
                                    <div class="col-xs-12 col-md-6 col-xl-4">
                                        <div class="eRepresentative--black">
                                            <a class="eRepresentative__img">
                                                <img src="{{ $ambassador->avatarImageUrl }}" alt="">
                                            </a>
                                            <h4 class="eRepresentative__title">
                                                <a href="#">
                                                    {!! $ambassador->translate(App::getLocale())->name !!}
                                                </a>
                                            </h4>
                                            <p class="eRepresentative__text">
                                                {!! $ambassador->translate(App::getLocale())->post !!}
                                            </p>
                                            <p class="eRepresentative__soc row center-xs">
                                                @if ($ambassador->facebook)
                                                    <span class="col">
                                                        <a href="{{ $ambassador->facebook }}" target="_blank" rel="nofollow">
                                                            <svg width="10px" height="20px">
                                                                <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                     xlink:href="#soc-facebook"></use>
                                                            </svg>
                                                        </a>
                                                    </span>
                                                @endif
                                                @if ($ambassador->viber)
                                                    <span class="col">
                                                        <a href="{{ $ambassador->viber }}" target="_blank" rel="nofollow">
                                                            <svg width="23px" height="23px">
                                                                <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                     xlink:href="#soc-viber"></use>
                                                            </svg>
                                                        </a>
                                                    </span>
                                                @endif
                                                @if ($ambassador->twitter)
                                                    <span class="col">
                                                        <a href="{{ $ambassador->twitter }}" target="_blank" rel="nofollow">
                                                            <svg width="23px" height="23px">
                                                                <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                     xlink:href="#soc-twitter"></use>
                                                            </svg>
                                                        </a>
                                                    </span>
                                                @endif
                                                @if ($ambassador->instagram)
                                                    <span class="col">
                                                        <a href="{{ $ambassador->instagram }}" target="_blank" rel="nofollow">
                                                            <svg width="23px" height="23px">
                                                                <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                     xlink:href="#soc-instagram"></use>
                                                            </svg>
                                                        </a>
                                                    </span>
                                                @endif
                                                @if ($ambassador->google)
                                                    <span class="col">
                                                        <a href="{{ $ambassador->google }}" target="_blank" rel="nofollow">
                                                            <svg width="23px" height="23px">
                                                                <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                     xlink:href="#soc-google"></use>
                                                            </svg>
                                                        </a>
                                                    </span>
                                                @endif
                                            </p>
                                            @if($ambassador->translate(App::getLocale())->content)
                                                <p class="eRepresentative__more">
                                                    <a href="#ambassador-{{ $ambassador->id }}" class="eLink--white open-popup-link">
                                                        @lang('main.more')
                                                    </a>
                                                </p>
                                                <div id="ambassador-{{ $ambassador->id }}" class="white-popup mfp-hide">
                                                    {!! $ambassador->translate(App::getLocale())->content !!}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="fullLine--right">
            <div class="pAbout__articles gridRow">
                <div class="row">
                    <div class="col-xs-12 col-lg-3">
                        <svg width="85px" height="55px" class="iconLogos">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-logos"></use>
                        </svg>
                        <h3 class="rightSidebarModule__title">
                            @lang('main.next_events')
                        </h3>
                        <p class="rightSidebarModule__btn">
                            <a href="{{ route('blog', ['slug' => $article_category_slug]) }}" class="eLink--black">
                                @lang('main.all_events')
                            </a>
                        </p>
                    </div>
                    <div class="col-xs-12 col-lg-9">
                        <div class="bModule__bodyScroll--middle">
                            <div>
                                <div class="gridRow">
                                    <div class="row">
                                        @foreach($articles as $key => $article)
                                            <div class="col-xs-4">
                                                @include('frontend.pages.blog.parts.preview')
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="fullLine--right">
            <div class="bPeoples gridRow" data-sticky_parent>
                <div class="row">
                    <div class="col-xs-12 col-lg-4 col-xl-3">
                        <div class="bPeoples__box stickInParentBox" data-sticky_column>
                            <svg width="85px" height="55px" class="iconLogos">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-logos"></use>
                            </svg>
                            <h3 class="bPeoples__title">
                                @lang('main.instructors')
                            </h3>
                            <div class="bPeoples__desc">
                                {!! trans('main.instructors_decs') !!}
                            </div>
                            <p>
                                <a href="#instructor-modal" class="eBtn--white open-popup-link">
                                    @lang('main.become_an_instructor')
                                </a>
                            </p>
                            <div id="instructor-modal" class="white-popup--small mfp-hide">
                                <request-form :variation="1"></request-form>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-lg-8 col-xl-9" data-sticky_column>
                        <div class="bPeoples__list gridRow">
                            <div class="row">
                                @foreach($instructors as $instructor)
                                    <div class="col-xs-12 col-md-6 col-xl-4">
                                        @include('frontend.pages.about.parts.eRepresentative', ['person' => $instructor])
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        {{--<div class="bPeoples__more">--}}
                            {{--<a href="#" class="eBtn--black">--}}
                                {{--@lang('main.show_more')--}}
                            {{--</a>--}}
                        {{--</div>--}}
                    </div>
                </div>
            </div>
            <hr class="fullLine--right">
            <div class="bPeoples gridRow" data-sticky_parent>
                <div class="row">
                    <div class="col-xs-12 col-lg-4 col-xl-3">
                        <div class="bPeoples__box stickInParentBox" data-sticky_column>
                            <svg width="85px" height="55px" class="iconLogos">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-logos"></use>
                            </svg>
                            <h3 class="bPeoples__title">
                                @lang('main.technologists_and_consultants')
                            </h3>
                            <div class="bPeoples__desc">
                                {!! trans('main.technologists_and_consultants_decs') !!}
                            </div>
                            <p>
                                <a href="#technologists-modal" class="eBtn--white open-popup-link">
                                    @lang('main.become_an_technologists')
                                </a>
                            </p>
                            <div id="technologists-modal" class="white-popup--small mfp-hide">
                                <request-form :variation="2"></request-form>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-lg-8 col-xl-9" data-sticky_column>
                        <div class="bPeoples__list gridRow">
                            <div class="row">
                                @foreach($technologists as $technologist)
                                    <div class="col-xs-12 col-md-6 col-xl-4">
                                        @include('frontend.pages.about.parts.eRepresentative', ['person' => $technologist])
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        {{--<div class="bPeoples__more">--}}
                            {{--<a href="#" class="eBtn--black">--}}
                                {{--@lang('main.show_more')--}}
                            {{--</a>--}}
                        {{--</div>--}}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection