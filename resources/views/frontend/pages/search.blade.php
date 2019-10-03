@extends('frontend.layouts.app')

@php($product_route = 'product')

@section('content')
    <section class="page--topForHeader pSearch">
        <div class="container">
            <h1 class="page__title">
                @lang('main.search_results')
            </h1>
            <hr class="fullLine">
            @if ($products->count())
                <div class="bModule">
                    <div class="bModule__header">
                        <h3 class="bModule__title">
                           
                           @php ($number = $products->count())
                            @php ($num = ($number % 10 == 1) ? 0 : ((($number % 10 >= 2) && ($number % 10 <= 4)) ? 1 : 2) )
                            {{-- @endif --}}
                            {{ $number }} {{ trans_choice('main.search_product_positions', $num) }}
                        </h3>
                    </div>
                    <div class="bModule__body">
                        <div class="gridRow">
                            <div class="row">
                                @foreach($products as $product)
                                    <div class="col-xs-12 col-md-6 col-lg-3">
                                        @include('frontend.pages.catalog.parts.preview')
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <br><br>
            @endif
            @if ($articles->count())
                <br><br>
                <div class="bModule">
                    <div class="bModule__header">
                        <h3 class="bModule__title">
                           
                           @php( $number = $articles->count() )
                            @php ($num = ($number % 10 == 1) ? 0 : ((($number % 10 >= 2) && ($number % 10 <= 4)) ? 1 : 2) )
                            
                            {{ $number }} {{ trans_choice('main.search_article_positions', $num) }}
                        </h3>
                    </div>
                    <div class="bModule__body">
                        <div class="gridRow">
                            <div class="row">
                                @foreach($articles as $article)
                                    <div class="col-xs-12 col-md-6 col-lg-3">
                                        @include('frontend.pages.blog.parts.preview')
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection
