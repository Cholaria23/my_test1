@extends('frontend.layouts.app')

 @if  (strstr($_SERVER['REQUEST_URI'], '/manicure'))
            @section('title', $page->translate(App::getLocale())->seo_title_manicure)
           @section('description', $page->translate(App::getLocale())->seo_description_manicure)
 @elseif (strstr($_SERVER['REQUEST_URI'], '/pedicure'))
           @section('title', $page->translate(App::getLocale())->seo_title_pedicure)
           @section('description', $page->translate(App::getLocale())->seo_description_pedicure)
 @elseif (strstr($_SERVER['REQUEST_URI'], '/make-up'))
           @section('title', $page->translate(App::getLocale())->seo_title_make_up)
           @section('description', $page->translate(App::getLocale())->seo_description_make_up)
 @elseif (strstr($_SERVER['REQUEST_URI'], '/cosmetology'))
           @section('title', $page->translate(App::getLocale())->seo_title_cosmetology)
           @section('description', $page->translate(App::getLocale())->seo_description_cosmetology)
 @else
   @section('title', $page->translate(App::getLocale())->seo_title)
   @section('description', $page->translate(App::getLocale())->seo_description)
   @section('keywords', $page->translate(App::getLocale())->seo_keywords)
 @endif

@section('color', $type === 'pro' ? 'black' : 'white')

@section('content')
    <section class="page--topForHeader pCatalog">
        <div class="pCatalog__wrap">
            <div class="container">
                <div class="pCatalog__box">
                    <div class="pCatalog__bg">
                        <svg version="1.1"
                             xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                             x="0px" y="0px" width="575px" height="330px" viewBox="0 0 575 330"
                             style="enable-background:new 0 0 575 330;"
                             xml:space="preserve">
                            <path
                                d="M10,330h555h10V0l-10,0c-13.5,6.5-24.7,17.3-31.7,31.1l-109,216.2c-9.9,19.6-34.9,25.7-52.7,12.9L10,0L0,0l0,330H10z"/>
                        </svg>
                    </div>
                    <div class="pCatalog__img"></div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="page__wrap">
                <div class="row">
                    <div class="col-xs-12 col-lg-3">

                        <div class="bFilterGroup">
                            <div class="bFilterGroup__btn">
                                @lang('main.filters')
                            </div>
                            <div class="bFilterGroup__box">
                                @foreach($serials as $serial)
                                    <div class="bFilter">
                                        <div class="bFilter__header">
                                            <h3 class="bFilter__title">
                                      {{-- @php  echo App::getLocale();  @endphp --}}
					{{-- @php echo Session::get('locale');     @endphp --}}
					{{--  @php  dd($serials); @endphp  --}}
					{{--	var_dump($serials);  --}}
					 {{-- @php die();  @endphp   --}}
						{{ $serial->translate(App::getLocale())->title }}
                                            </h3>
                                            @if($serial->slug)
                                                <a href="{{ route($type === 'pro' ? 'catalog-pro-series' : 'catalog-series', ['slug' => $serial->slug]) }}"
                                                   class="bFilter__aboutLink">
                                                    @lang('main.about_series')
                                                </a>
                                            @endif
                                        </div>
                                        @foreach($serial->categoriesCustomOrder as $category)
                                            <p class="bFilter__filterItem">
                                                <a href="{{ route($type === 'pro' ? 'catalog-pro-category' : 'catalog-category', ['slug' => $category->slug]) }}"></a>
                                                <span class="eCheckBox">
                                                    <input type="checkbox"
                                                           id="category-{{ $category->id }}"
                                                           value="{{ $category->id }}"
                                                           data-entity="categories"
                                                           @if(isset($selected_category) && $category->id === $selected_category->id) checked @endif>
                                                    <span class="eCheckBox__el"></span>
                                                </span>
                                                <label for="category-{{ $category->id }}">
                                                    {{ $category->translate(App::getLocale())->title }}
                                                </label>
                                            </p>
                                        @endforeach
                                    </div>
                                @endforeach
                                @if (isset($slug) && $slug)
                                    <p>
                                        <a href="{{ route($type === 'pro' ? 'catalog-pro' : 'catalog') }}"
                                           @if($type === 'pro')class="eBtn--white" @else class="eBtn--black" @endif
                                        >
                                            @lang('main.all_catalog')
                                        </a>
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-lg-9">

                        <div class="bFilter--top">
                            <div class="row middle-xs between-xs">
                                <div class="col-xs-9">
                                    <div class="row middle-xs">
                                        @if($appointments && count($appointments))
                                            @foreach($appointments as $appointment)
                                                @if (($appointment->slug != 'cosmetology') || $type ==='pro')
                                                <div class="col">
                                                    <p class="bFilter__filterItem">
                                                        <a href="{{ route($type === 'pro' ? 'catalog-pro-appointment' : 'catalog-appointment', ['slug' => $appointment->slug]) }}"></a>
                                                        <span class="eCheckBox">
                                                            <input type="checkbox"
                                                                   id="appointment-{{ $appointment->id }}"
                                                                   value="{{ $appointment->id }}"
                                                                   data-entity="appointments"
                                                                   @if(isset($selected_appointment) && $appointment->slug === $selected_appointment->slug) checked @endif>
                                                            <span class="eCheckBox__el"></span>
                                                        </span>
                                                        <label for="appointment-{{ $appointment->id }}">
                                                            {{ $appointment->translate(App::getLocale())->title }}
                                                            <svg width="10px" height="15px"
                                                                 class="{{ $appointment->icon_color }}">
                                                                <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                     xlink:href="#icon-logo-small"></use>
                                                            </svg>
                                                        </label>
                                                    </p>
                                                </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                <div class="col-xs-3">
                                    <?php
                                    $appends = [];
                                    if (isset($selected_category)) {
                                        $appends['categories'] = [$selected_category->id];
                                    }
                                    if (isset($selected_appointment)) {
                                        $appends['appointments'] = [$selected_appointment];
                                    }
                                    if (count($appends)) {
                                        echo $products->appends($appends)->render();
                                    } else {
                                        echo $products->render();
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>

                        <div class="pCatalog__breadcrumbs">
                            <ul class="mBreadcrumbs" itemscope itemtype="http://data-vocabulary.org/#">
                                <li typeof="v:Breadcrumb">
                                    <a href="{{ route('home') }}" rel="v:url" property="v:title">
                                        @lang('main.main_page') {{ app()->getLocale() === 'ru' ? 'Сталекс' : 'Staleks' }}
                                    </a>
                                </li>
                                <li class="sep">-</li>
                                <li typeof="v:Breadcrumb">
                                    <a href="{{ route($type === 'pro' ? 'catalog-pro' : 'catalog') }}" rel="v:url" property="v:title">
                                        @lang('main.catalog2') {{ $type === 'pro' ? 'Staleks PRO' : 'Staleks' }}
                                    </a>
                                </li>
                                @if(isset($selected_category) && $selected_category)
                                    <li class="sep">-</li>
                                    <li typeof="v:Breadcrumb">
                                    <span property="v:title">
                                        {{ $selected_category->translate(App::getLocale())->title }}
                                    </span>
                                    </li>
                                @endif
                            </ul>
                        </div>

                        @if (isset($slug) && $slug && $serial->translate(App::getLocale())->content)
                            <div class="pCatalog__serial">
                                {!! $serial->translate(App::getLocale())->content !!}
                            </div>
                        @endif

                        <div class="pCatalog__list gridRow">
                            @if($products->count())
                                <div class="row">
                                    @foreach($products as $product)
                                        <div class="col-xs-12 col-md-6 col-lg-4">

                                            @include('frontend.pages.catalog.parts.preview')

                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="emptyMessage">
                                    @lang('main.there_no_products')
                                </p>
                            @endif
                        </div>

                        <?php
                        if (count($appends)) {
                            echo $products->appends($appends)->render();
                        } else {
                            echo $products->render();
                        }
                        ?>

                        @if (isset($selected_category) && $selected_category->translate(App::getLocale())->description)
                            <div class="pCatalog__serial">
                                {!! $selected_category->translate(App::getLocale())->description !!}
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

