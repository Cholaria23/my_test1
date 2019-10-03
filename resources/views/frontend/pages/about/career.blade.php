@extends('frontend.layouts.app')

@section('title', $page->translate(App::getLocale())->seo_title)
@section('description', $page->translate(App::getLocale())->seo_description)
@section('keywords', $page->translate(App::getLocale())->seo_keywords)

@section('body_class', 'template-about')

@section('content')
    <section class="page pAbout">
        <div class="container">
            @include('frontend.pages.about.parts.header', ['headerImg' => 'careerImg.jpg'])
            <hr class="fullLine">
            <h1 class="pAbout__pageTitle">
                {{ $page->translate(App::getLocale())->title }}
            </h1>
            <div class="pAbout__descBox--left">
                <p class="pAbout__title">
                    @lang('main.become_a_member')
                </p>
                <div class="pAbout__text">
                    {!! trans('main.career_text') !!}
                    {{--<p class="row middle-xs">--}}
                        {{--<span class="col">--}}
                            {{--<a href="#" class="eLink--black">--}}
                                {{--@lang('main.more')--}}
                            {{--</a>--}}
                        {{--</span>--}}
                    {{--</p>--}}
                </div>
                <p class="pAbout__title">
                    @lang('main.career_title_2')
                </p>
                <div class="pAbout__text">
                    {!! trans('main.career_text_2') !!}
                </div>
                <br>
                <p class="pAbout__title">
                    @lang('main.career_title_3')
                </p>
                <div class="pAbout__text">
                    {!! trans('main.career_text_3') !!}
                </div>
                <br>
                <p class="pAbout__title">
                    @lang('main.career_title_4')
                </p>
                <div class="pAbout__text">
                    {!! trans('main.career_text_4') !!}
                </div>
                <br>
                <p class="pAbout__title">
                    @lang('main.career_title_5')
                </p>
                <div class="pAbout__text">
                    {!! trans('main.career_text_5') !!}
                </div>
                <div class="pAbout__image" data-aos="fade-left">
                    <img src="{{ asset('frontend/img/about/careerPic.jpg') }}" alt="">
                </div>
            </div>
            <hr class="fullLine--right">
            <h3 class="pAbout__titleBig">
                @lang('main.workplaces')
            </h3>
            <div class="workplaces gridRow">
                <div class="row">
		<!-- ru -->
		@if(app()->getLocale() === "ru")
		  <iframe style="width:100%; border:none;"   id="RUAFRAME" frameborder="0" scrolling="no" src="https://rabota.ua/export/context/company.aspx?ntid=3189226&lang=ru"></iframe>
		  <script type="text/javascript" src="https://rabota.ua/export/context/company.js"></script>
		@elseif(app()->getLocale() === "ua")
	         <iframe style="width:100%; border:none;"   id="RUAFRAME" frameborder="0" scrolling="no" src="https://rabota.ua/export/context/company.aspx?ntid=3189226&lang=ua"></iframe>
		 <script type="text/javascript" src="https://rabota.ua/export/context/company.js"></script> 
		@else
		<iframe style="width:100%; border:none;"   id="RUAFRAME" frameborder="0" scrolling="no" src="https://rabota.ua/export/context/company.aspx?ntid=3189226&lang=en"></iframe>
                 <script type="text/javascript" src="https://rabota.ua/export/context/company.js"></script>
		@endif
		{{-- <div style="font-family:inherit; margin-top:15px;"><a target="_blank" href="https://rabota.ua/company3189226">STALEKS</a> --}}
		 </div> 
			
                  {{--  @if (isset($workplaces))   --}}
                  {{--       @foreach($workplaces as $workplace)   --}}
                  {{--           <div class="col-xs-12 col-md-6 col-lg-4 col-xl-3">   --}}
                  {{--               <div class="eWorkplace">    --}}
                  {{--                   <h5 class="eWorkplace__title">    --}}
                  {{--                       <a href="{{ route('workplace', ['slug' => $workplace->slug]) }}">    --}}
                  {{--                           {{ $workplace->title }}    --}}
                  {{--                       </a>   --}}
                  {{--                   </h5>    --}}
                  {{--                   <p class="eWorkplace__date">    --}}
                  {{--                       {{ $workplace->created_at->format('d.m.y') }}    --}}
                  {{--                   </p>     --}}
                  {{--                   <p class="eWorkplace__more">   --}}
                  {{--                       <a href="{{ route('workplace', ['slug' => $workplace->slug]) }}"    --}}
                  {{--                          class="eLink--black">   --}}
                  {{--                           @lang('main.more')    --}}
                  {{--                       </a>    --}}
                  {{--                   </p>    --}}
                  {{--               </div>   --}}
                  {{--           </div>     --}}
                  {{--       @endforeach									    --}}
                  {{--  @endif                                                                                       --}}
               {{-- </div>  --}}
            </div>
        </div>
    </section>
@endsection
