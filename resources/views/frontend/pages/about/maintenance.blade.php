@extends('frontend.layouts.app')

@php($currentPage = $maintenance_centers->currentPage())
@if($locationCity)
    @section('title', trans((int) $currentPage  > 1 ? 'main.seo_title_maintenance_paged' : 'main.seo_title_maintenance', ['page' => $currentPage, 'location' => $locationCity->translate(app()->getLocale())->title]))
    @section('description', trans((int) $currentPage > 1 ? 'main.seo_desc_maintenance_paged' : 'main.seo_desc_maintenance', ['page' => $currentPage, 'location' => $locationCity->translate(app()->getLocale())->title]))
@elseif($locationCountry)
    @section('title', trans($currentPage > 1 ? 'main.seo_title_maintenance_paged' : 'main.seo_title_maintenance', ['page' => $currentPage, 'location' => $locationCountry->translate(app()->getLocale())->title]))
    @section('description', trans($currentPage > 1 ? 'main.seo_desc_maintenance_paged' : 'main.seo_desc_maintenance', ['page' => $currentPage, 'location' => $locationCountry->translate(app()->getLocale())->title]))
@else
    @section('title', $page->translate(app()->getLocale())->seo_title . ((int) $maintenance_centers->currentPage() > 1 ? ' ' . trans('main.page') .' ' . $maintenance_centers->currentPage() : ''))
    @section('description', $page->translate(app()->getLocale())->seo_description . ((int) $maintenance_centers->currentPage() > 1 ? ' ' . trans('main.page') .' ' . $maintenance_centers->currentPage() : ''))
@endif
@section('keywords', $page->translate(app()->getLocale())->seo_keywords)

@section('body_class', 'template-about')

@section('content')
    <section class="page pAbout">
        <div class="container">
            @include('frontend.pages.about.parts.header', ['headerImg' => 'serviceImg2.jpg'])
            <hr class="fullLine">
            <h1 class="pAbout__pageTitle">
                {{ $page->translate(app()->getLocale())->title }}
            </h1>
            <div class="bSharpeners gridRow">
                <div class="row">
                    <div class="col-xs-12 col-md-6 col-lg-4 col-xl-3">
                        <div class="bSharpeners__box">
                            <svg width="85px" height="55px" class="iconLogos">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-logos"></use>
                            </svg>
                            <h3 class="bPeoples__title">
                                @lang('main.sharpeners_title')
                            </h3>
                            <div class="bPeoples__desc">
                                @lang('main.sharpeners_desc')
                            </div>
                            <form method="post" class="bSharpeners__form">
                                <p>
                                    <select name="country" id="country-select" data-path="{{ app()->getLocale() === 'ru' ? request()->route()->getName() : app()->getLocale() . '/' . request()->route()->getName() }}">
                                        <option value="">@lang('main.select_country')</option>
                                        @foreach ($countries as $country)
                                            @php($maintenanceCenters = 0)
                                            @foreach ($country->cities as $city)
                                                @php($maintenanceCenters += $city->maintenanceCenters->count())
                                            @endforeach
                                            @if($maintenanceCenters)
                                                <option value="{{ $country->slug }}"
                                                        @if (Request::route('country') === $country->slug) selected @endif>
                                                    {{ $country->translate(app()->getLocale())->title }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </p>
                                @if (Request::route('country') && $cities)
                                    <p>
                                        <select name="city" id="city-select" data-path="{{ app()->getLocale() === 'ru' ? request()->route()->getName() : app()->getLocale() . '/' . request()->route()->getName() }}">
                                            <option value="">@lang('main.select_city')</option>
                                            @foreach ($cities as $city)
                                                <option value="{{ $city->slug }}"
                                                        @if (Request::route('city') === $city->slug) selected @endif>
                                                    {{ $city->translate(app()->getLocale())->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </p>
                                @endif
                            </form>
                        </div>
                    </div>
                    @foreach($maintenance_centers as $maintenance_center)
                        <div class="col-xs-12 col-md-6 col-lg-4 col-xl-3">
                            <div class="bSharpeners__item">
                                <div class="eSharpener">
                                    <h4 class="eSharpener__title">
                                        {!! $maintenance_center->translate(app()->getLocale())->title !!}
                                    </h4>
                                    <p class="eSharpener__location">
                                        <a class="eLink--black" href="{{ route('maintenance', ['country' => $maintenance_center->city->country->slug]) }}">
                                            {!! $maintenance_center->city->country->translate(app()->getLocale())->title !!}
                                        </a>,
                                        <a class="eLink--black" href="{{ route('maintenance', ['country' => $maintenance_center->city->country->slug, 'city' => $maintenance_center->city->slug]) }}">
                                            {!! $maintenance_center->city->translate(app()->getLocale())->title !!}
                                        </a>
                                    </p>
                                    <div class="eSharpener__text">
                                        {!! $maintenance_center->translate(app()->getLocale())->content !!}
                                    </div>
                                    @if ($maintenance_center->authorized)
                                        <p class="eSharpener__authorized">
                                            <svg width="20px" height="26px">
                                                <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                                     xlink:href="#icon-logo"></use>
                                            </svg>
                                            @lang('main.authorized_point')
                                        </p>
                                    @endif
                                    <div class="eSharpener__reviews">
                                        <div class="eSharpener__stars">
                                            <div class="row">
                                                @for($i=1; $i<=5; $i++)
                                                <div class="col">
                                                    <svg @if($i <= $maintenance_center->rating) class="active" @endif width="22px" height="21px">
                                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                                             xlink:href="#star"></use>
                                                    </svg>
                                                </div>
                                                @endfor
                                            </div>
                                        </div>
                                        <a href="#reviews-{{ $maintenance_center->id }}"
                                           class="eSharpener__reviewsLink eLink--black open-popup-link">
                                            
                                            @php ($number = $maintenance_center->publishedReviews->count() )
                                             @php ( $num = ($number % 10 === 1) ? 0 : ( ( ($number % 10 >= 2) && ($number % 10 <= 4) ) ? 1 : 2) )
                                            
                                            {{ $number }} {{ trans_choice('main.reviews_choise', $num) }}
                                        </a>
                                        <div id="reviews-{{ $maintenance_center->id }}" class="white-popup mfp-hide">

                                            <div class="mReviews">


                                                <h3 class="mReviews__title">
                                                    {{ trans('main.add_review') }}
                                                </h3>

                                                <add-review-form :id="{{ $maintenance_center->id }}"></add-review-form>

                                                @if($number)

                                                    <h3 class="mReviews__title">
                                                        {{ trans('main.reviews') }}
                                                        ({{ $number }})
                                                    </h3>

                                                    <div class="mReviews__list">

                                                        @foreach($maintenance_center->publishedReviews as $review)

                                                            <div class="mReviews__item">

                                                                <div class="eReview">
                                                                    <div class="row">
                                                                        <div class="col">
                                                                            <h5 class="eReview__name">
                                                                                {{ $review->name }}
                                                                            </h5>
                                                                        </div>
                                                                        <div class="col">
                                                                            <div class="eReview__stars">
                                                                                <div class="row">
                                                                                    @for($i=1; $i<=5; $i++)
                                                                                        <div class="col">
                                                                                            <svg
                                                                                                @if($i <= $review->rating) class="active"
                                                                                                @endif width="16px"
                                                                                                height="15px">
                                                                                                <use
                                                                                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                                                    xlink:href="#star"></use>
                                                                                            </svg>
                                                                                        </div>
                                                                                    @endfor
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="eReview__service">
                                                                        {{ $review->service }}
                                                                    </div>
                                                                    <div class="eReview__content">
                                                                        {!! $review->content !!}
                                                                    </div>
                                                                </div>

                                                            </div>

                                                        @endforeach

                                                    </div>

                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="col-xs-12">
                        {{ $maintenance_centers->links() }}
                    </div>

                </div>
                @php($content = $page->fields()->where('advanced_name', 'maintenance-text-1')->first())
                @if($content)
                    <hr class="fullLine">
                    <div class="content">
                        {!! $content->translate(app()->getLocale())->text !!}
                    </div>
                @endif
            </div>
            <hr class="fullLine--right">
            <div class="pAbout__articles gridRow">
                <div class="row">
                    <div class="col-xs-12 col-lg-3">
                        <svg width="85px" height="55px" class="iconLogos">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-logos"></use>
                        </svg>
                        <h3 class="rightSidebarModule__title">
                            {!! trans('main.theme_articles') !!}
                        </h3>
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
        </div>
    </section>
@endsection
