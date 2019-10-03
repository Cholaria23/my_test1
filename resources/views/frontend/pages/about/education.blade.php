@extends('frontend.layouts.app')

@section('title', $page_seo_title)
@section('description', $page_seo_description)
@section('keywords', $page->translate(App::getLocale())->seo_keywords)

@section('body_class', 'template-about')

@section('content')
    <section class="page pAbout">
        <div class="container">
            @include('frontend.pages.about.parts.header', ['headerImg' => 'educationImg.jpg'])
            <hr class="fullLine">
            <h1 class="pAbout__pageTitle">
                {{ $page->translate(App::getLocale())->title }}
            </h1>
            <div class="bSchools gridRow">
                <div class="row">
                    <div class="col-xs-12 col-md-6 col-lg-4 col-xl-3">
                        <div class="bSchools__box">
                            <svg width="85px" height="55px" class="iconLogos">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-logos"></use>
                            </svg>
                            <h3 class="bPeoples__title">
                                @lang('main.schools')
                            </h3>
                            <div class="bPeoples__desc">
                                @lang('main.schools_desc')
                            </div>
                            <form method="post" class="bSchools__form">
                                <p>
                                    <select name="country" id="country-select" data-path="{{ app()->getLocale() !== 'ru' ? app()->getLocale() . '/' : '' }}{{ request()->route()->getName() }}">
                                        <option value="">@lang('main.select_country')</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ mb_strtolower($country->country) }}"
                                                    @if (Request::route('country') == mb_strtolower($country->country)) selected @endif>
                                                {{ $country->country }}
                                            </option>
                                        @endforeach
                                    </select>
                                </p>
                                @if (Request::route('country') && $cities)
                                    <p>
                                        <select name="city" id="city-select" data-path="{{ app()->getLocale() !== 'ru' ? app()->getLocale() . '/' : '' }}{{ request()->route()->getName() }}">
                                            <option value="">@lang('main.select_city')</option>
                                            @foreach ($cities as $city)
                                                <option value="{{ mb_strtolower($city->city) }}"
                                                        @if (Request::route('city') == mb_strtolower($city->city)) selected @endif>
                                                    {{ $city->city }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </p>
                                @endif
                                <p>
                                    <select name="category" id="category-select" data-path="{{ app()->getLocale() !== 'ru' ? app()->getLocale() . '/' : '' }}{{ request()->route()->getName() }}">
                                        <option value="">@lang('main.select_category')</option>
                                        @foreach ($school_categories as $category)
                                            <option value="{{ $category->id }}"
                                                    @if (app('request')->input('category') == $category->id) selected @endif>
                                                {{ $category->translate(App::getLocale())->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </p>
                            </form>
                        </div>
                    </div>
                    @if($schools->count())
                        @foreach ($schools as $school)
                            <div class="col-xs-12 col-md-6 col-lg-4 col-xl-3">
                                <div class="bSchools__item">
                                    <div class="eRepresentative--gray">
                                        <a href="{{ route('school', ['slug' => $school->slug]) }}" class="eRepresentative__img">
                                            <img src="{{ $school->avatarImageUrl }}" alt="">
                                        </a>
                                        <h4 class="eRepresentative__title">
                                            <a href="{{ route('school', ['slug' => $school->slug]) }}">
                                                {!! $school->translate(App::getLocale())->title !!}
                                            </a>
                                        </h4>
                                        <p class="eRepresentative__location">
                                            {!! $school->translate(App::getLocale())->city !!}
                                        </p>
                                        @foreach($school->schoolCategories as $schoolCategory)
                                            <p class="eRepresentative__cat">
                                                <span class="row middle-xs center-xs">
                                                    <span class="col">
                                                        <svg width="10px" height="15px" class="{{ $schoolCategory->image_color }}">
                                                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-logo-small"></use>
                                                        </svg>
                                                    </span>
                                                    <span class="col">
                                                        {!! $schoolCategory->translate(App::getLocale())->title !!}
                                                    </span>
                                                </span>
                                            </p>
                                        @endforeach
                                        <p class="eRepresentative__soc row center-xs">
                                            @if ($school->website)
                                                <span class="col">
                                                    <a href="{{ $school->website }}" target="_blank" rel="nofollow">
                                                        <svg width="23px" height="23px">
                                                            <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                 xlink:href="#soc-www"></use>
                                                        </svg>
                                                    </a>
                                                </span>
                                            @endif
                                            @if ($school->facebook)
                                                <span class="col">
                                                    <a href="{{ $school->facebook }}" target="_blank" rel="nofollow">
                                                        <svg width="23px" height="23px">
                                                            <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                 xlink:href="#soc-facebook"></use>
                                                        </svg>
                                                    </a>
                                                </span>
                                            @endif
                                            @if ($school->viber)
                                                <span class="col">
                                                    <a href="viber://add?number={{ $school->viber }}" target="_blank" rel="nofollow">
                                                        <svg width="23px" height="23px">
                                                            <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                 xlink:href="#soc-viber"></use>
                                                        </svg>
                                                    </a>
                                                </span>
                                            @endif
                                            @if ($school->twitter)
                                                <span class="col">
                                                    <a href="{{ $school->twitter }}" target="_blank" rel="nofollow">
                                                        <svg width="23px" height="23px">
                                                            <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                 xlink:href="#soc-twitter"></use>
                                                        </svg>
                                                    </a>
                                                </span>
                                            @endif
                                            @if ($school->instagram)
                                                <span class="col">
                                                    <a href="{{ $school->instagram }}" target="_blank" rel="nofollow">
                                                        <svg width="23px" height="23px">
                                                            <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                 xlink:href="#soc-instagram"></use>
                                                        </svg>
                                                    </a>
                                                </span>
                                            @endif
                                            @if ($school->google)
                                                <span class="col">
                                                    <a href="{{ $school->google }}" target="_blank" rel="nofollow">
                                                        <svg width="23px" height="23px">
                                                            <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                 xlink:href="#soc-google"></use>
                                                        </svg>
                                                    </a>
                                                </span>
                                            @endif
                                            @if ($school->youtube)
                                                <span class="col">
                                                    <a href="{{ $school->youtube }}" target="_blank" rel="nofollow">
                                                        <svg width="23px" height="23px">
                                                            <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                 xlink:href="#soc-youtube"></use>
                                                        </svg>
                                                    </a>
                                                </span>
                                            @endif
                                            @if ($school->vk)
                                                <span class="col">
                                                    <a href="{{ $school->vk }}" target="_blank" rel="nofollow">
                                                        <svg width="23px" height="23px">
                                                            <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                 xlink:href="#soc-vk"></use>
                                                        </svg>
                                                    </a>
                                                </span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-xs-12 col-md-6 col-lg-4 col-xl-3">
                            <div class="bSchools__item">
                                <div class="eRepresentative--gray">
                                    <p class="eRepresentative__img">
                                        <img src="{{ asset('frontend/img/placeholders/user-placeholder.jpg') }}" alt="">
                                    </p>
                                    <h4 class="eRepresentative__title">
                                        @lang('main.no_schools')
                                    </h4>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                {{--<div class="bSchools__more">--}}
                {{--<a href="#" class="eBtn--black">--}}
                {{--@lang('main.show_more')--}}
                {{--</a>--}}
                {{--</div>--}}
            </div>
            @if($courses->count())
                <hr class="fullLine--right">
                <div class="pAbout__articles gridRow">
                    <div class="row">
                        <div class="col-xs-12 col-lg-3">
                            <svg width="85px" height="55px" class="iconLogos">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-logos"></use>
                            </svg>
                            <h3 class="rightSidebarModule__title">
                                {!! trans('main.next_courses') !!}
                            </h3>
                            <p class="rightSidebarModule__btn">
                                <a href="{{ route('blog', ['slug' => $courses_slug]) }}" class="eLink--black">
                                    @lang('main.all_courses')
                                </a>
                            </p>
                        </div>
                        <div class="col-xs-12 col-lg-9">
                            <div class="bModule__bodyScroll--middle">
                                <div>
                                    <div class="gridRow">
                                        <div class="row">
                                            @foreach($courses as $key => $article)
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
            @endif
            @if($training->count())
                <hr class="fullLine--right">
                <div class="pAbout__articles gridRow">
                    <div class="row">
                        <div class="col-xs-12 col-lg-3">
                            <svg width="85px" height="55px" class="iconLogos">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-logos"></use>
                            </svg>
                            <h3 class="rightSidebarModule__title">
                                {!! trans('main.video_training') !!}
                            </h3>
                            <p class="rightSidebarModule__btn">
                                <a href="{{ route('blog', ['slug' => $training_slug]) }}" class="eLink--black">
                                    @lang('main.all_video_training')
                                </a>
                            </p>
                        </div>
                        <div class="col-xs-12 col-lg-9">
                            <div class="bModule__bodyScroll--middle">
                                <div>
                                    <div class="gridRow">
                                        <div class="row">
                                            @foreach($training as $key => $article)
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
            @endif
        </div>
    </section>
@endsection