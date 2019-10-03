@extends('frontend.layouts.app')

@section('title', $page->translate(App::getLocale())->seo_title)
@section('description', $page->translate(App::getLocale())->seo_description)
@section('keywords', $page->translate(App::getLocale())->seo_keywords)

@section('body_class', 'template-about')

@section('script')
    <script>
        window.form_subject_1 = "<?= Config::get('mail.cooperationRequest_subject') ?>";
        window.form_type_1 = 'cooperation';
    </script>
@endsection

@section('content')
    <section class="page pAbout">
        <div class="container">
            @include('frontend.pages.about.parts.header', ['headerImg' => 'caooperationImg.jpg'])
            <hr class="fullLine">
            <h1 class="pAbout__pageTitle">
                {{ $page->translate(App::getLocale())->title }}
            </h1>
            <div class="pAbout__descBox--left">
                <p class="pAbout__title">
                    @lang('main.about_cooperation_title_1')
                </p>
                <div class="pAbout__text">
                    {!! trans('main.about_cooperation_text_1') !!}
                    <p class="row middle-xs">
                        <span class="col">
                            <a href="#form-modal" class="eBtn--black open-popup-link">
                                @lang('main.submit_an_application')
                            </a>
                        </span>
                        {{--<span class="col">--}}
                            {{--<a href="#" class="eLink--black">--}}
                                {{--@lang('main.more')--}}
                            {{--</a>--}}
                        {{--</span>--}}
                    </p>
                    <div id="form-modal" class="white-popup--small mfp-hide">
                        <request-form :variation="1"></request-form>
                    </div>
                </div>
                <div class="pAbout__image" data-aos="fade-left">
                    <img src="{{ asset('frontend/img/about/caooperationPic-1.jpg') }}" alt="">
                </div>
            </div>
            <hr class="fullLine--right">
            <files :locale="'{{ app()->getLocale() }}'"></files>
        </div>
    </section>
@endsection