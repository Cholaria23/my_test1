@extends('frontend.layouts.app')

@section('title', $school->translate(App::getLocale())->title)
@php($pageDesk = $school->translate(App::getLocale())->seo_description ? strip_tags(mb_substr($school->translate(App::getLocale())->seo_description, 0, 160)) : trans('main.school_desc', ['title' => $school->translate(App::getLocale())->title]))
@section('description', $pageDesk)
@section('keywords', $school->translate(App::getLocale())->seo_keywords)

@section('body_class', 'page-school')

@section('image', $school->avatarImageUrl)

@section('content')
    <section class="page page--topForHeader pSchool">
        <div class="container">
            <ul class="mBreadcrumbs" itemscope itemtype="http://data-vocabulary.org/#">
                <li typeof="v:Breadcrumb">
                    <a href="{{ route('home') }}" rel="v:url" property="v:title">
                        @lang('main.main_page') {{ app()->getLocale() === 'ru' ? 'Сталекс' : 'Staleks' }}
                    </a>
                </li>
                <li class="sep">-</li>
                <li typeof="v:Breadcrumb">
                    <a href="{{ route('education') }}" rel="v:url" property="v:title">
                        @lang('main.education')
                    </a>
                </li>
                <li class="sep">-</li>
                <li typeof="v:Breadcrumb">
                    <span property="v:title">
                        {{ $school->translate(App::getLocale())->title }}
                    </span>
                </li>
            </ul>
            <hr class="fullLine">
            <div class="page__wrap">
                <div class="pSchool__header">
                    <div class="pSchool__img">
                        <img src="{{ $school->avatarImageUrl }}"
                             alt="{{ $school->translate(App::getLocale())->title }}"
                             title="{{ $school->translate(App::getLocale())->title }}">
                    </div>

                    <div class="pSchool__name">
                        <div class="row">
                            <div class="col">
                                <h1 class="pSchool__title">
                                    {{ $school->translate(App::getLocale())->title }}
                                </h1>
                            </div>
                            <div class="col">
                                <p class="pSchool__location">
                                    ({!! $school->translate(App::getLocale())->city !!})
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="pSchool__cats">
                        <div class="row">
                            @foreach($school->schoolCategories as $schoolCategory)
                                <div class="col">
                                    <p class="row middle-xs center-xs">
                                        <span class="col">
                                            <svg width="10px" height="15px" class="{{ $schoolCategory->image_color }}">
                                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-logo-small"></use>
                                            </svg>
                                        </span>
                                        <span class="col">
                                            {!! $schoolCategory->translate(App::getLocale())->title !!}
                                        </span>
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <p class="pSchool__soc row">
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

                    <div class="pSchool__description">
                        {!! $school->translate(App::getLocale())->description !!}
                    </div>
                </div>
                @if($school->courses->count())
                <div class="pSchool__courses">
                    <div class="coursesTable">
                        <div class="coursesTable__header coursesTable__row row">
                            <p class="col coursesTable__date">
                                @lang('main.date')
                            </p>
                            <p class="col coursesTable__course">
                                @lang('main.course')
                            </p>
                            <p class="col coursesTable__duration">
                                @lang('main.duration')
                            </p>
                            <p class="col coursesTable__price">
                                @lang('main.price')
                            </p>
                        </div>
                        <div class="coursesTable__body">
                            @foreach($school->courses as $course)
                                <div class="coursesTable__row row">
                                    <div class="col coursesTable__date">
                                        {{ date('d.m.Y', strtotime($course->start_time)) }}<br>
                                        {{--{{ date('H:i', strtotime($course->start_time)) }}--}}
                                    </div>
                                    <div class="col coursesTable__course">
                                        <h2 class="coursesTable__title">
                                            {!! $course->translate(App::getLocale())->title !!}
                                        </h2>
                                        <div class="coursesTable__content">
                                            {!! $course->translate(App::getLocale())->content !!}
                                        </div>
                                    </div>
                                    <div class="col coursesTable__duration">
                                        {!! $course->translate(App::getLocale())->duration !!}
                                    </div>
                                    <div class="col coursesTable__price">
                                        <div>
                                            <p>
                                                <strong>
                                                    {!! $course->translate(App::getLocale())->price !!}
                                                </strong>
                                            </p>
                                            @if($course->link)
                                                <p>
                                                    <a href="{{ $course->link }}" class="eBtn--black">
                                                        @lang('main.register')
                                                    </a>
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
                <div class="content pSchool__content">
                    {!! $school->translate(App::getLocale())->content !!}
                </div>
            </div>
        </div>
    </section>
@endsection