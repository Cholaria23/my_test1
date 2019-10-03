@extends('frontend.layouts.app')

@section('title', $page->translate(App::getLocale())->seo_title)
@section('description', $page->translate(App::getLocale())->seo_description)
@section('keywords', $page->translate(App::getLocale())->seo_keywords)

@section('script')
    <script>
        window.form_subject_1 = "<?= Config::get('mail.askRequest_subject') ?>";
        window.form_type_1 = 'ask';
    </script>
@endsection

@section('content')
    <section class="page page--topForHeader pFaq">
        <div class="container">
            <h1 class="pFaq__title">
                @lang('main.faq_title')
            </h1>
            <hr class="fullLine">
            <div class="page__wrap">
                <div class="row">
                    <div class="col-xs-12 col-lg-9">
                        @foreach($faq as $item)
                            <div class="eFaq eFaq--close">
                                <div class="eFaq__question">
                                    <p>
                                        {{ $item->translate(App::getLocale())->question }}
                                    </p>
                                    <div class="eFaq__icon">
                                        <svg width="16px" height="10px" class="arrow">
                                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-arrow-drop-bottom"></use>
                                        </svg>
                                        <svg width="16px" height="16px" class="close">
                                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-close"></use>
                                        </svg>
                                    </div>
                                </div>
                                <div class="eFaq__answer">
                                    <div class="content">
                                        {!! $item->translate(App::getLocale())->answer !!}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="col-xs-12 col-lg-3">
                        <request-form :variation="1"></request-form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection