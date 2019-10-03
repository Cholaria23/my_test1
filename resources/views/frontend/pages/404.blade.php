@extends('frontend.layouts.app')

@section('body_class', 'template-about')

@section('content')
    <section class="page pNot">
        <div class="container">
            <div class="pNotHeader">
                <div class="pNotHeader__wrap">
                    <div class="pNotHeader__bg"></div>
                </div>
                <div class="pNotHeader__box">
                    <h2 class="pNotHeader__title">
                        404
                    </h2>
                    <p class="pNotHeader__desc">
                        @lang('main.page_not_found')
                    </p>
                    <p class="pNotHeader__btn">
                        <a href="{{ route('home') }}" class="eBtn--black">
                            @lang('main.go_home')
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection
