<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>

    <!-- Google Tag Manager -->
    <script>(function (w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start':
                    new Date().getTime(), event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-TG5MSQM');
	</script>
    <!-- End Google Tag Manager -->

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" id="meta-csrf-token">

   {{--Start Add canonical Aleksandr --}}
	<link rel="canonical" href="{{ request()->url() }}"> 
   {{--END Add canonical Aleksandr --}}

    @if(request()->query('page', false) || request()->query('appointments', false))
        <meta name=robots content="noindex,follow"/>
        <base href="https://staleks.com"/>
    @endif

    @if (request()->route() && request()->route()->getName() !== 'maintenance')
        @foreach(config('app.locales') as $locale)
            @php($link = null)
            @for ($i = 1; Request::segment($i) !== null; $i++)
                @if(!in_array(Request::segment($i), ['ua', 'en','pt','es']))
                    @php($link .= '/' . Request::segment($i))
                @endif
            @endfor
            @if($link)
                @php($link = request()->getQueryString() ? $link . '?' . request()->getQueryString() : $link)
                <link rel="alternate"
                      hreflang="{{  ($locale === 'ua') ? 'uk' : $locale }}"
                      href="{{ url(($locale === 'ru') ? $link : $locale . $link) }}"/>
            @elseif(request()->route()->getName() === 'home')
                <link rel="alternate"
                      hreflang="{{  ($locale === 'ua') ? 'uk' : $locale }}"
                      href="{{ url(($locale === 'ru') ? '/' : '/' . $locale) }}"/>
            @endif
        @endforeach
    @else
      {{-- <link rel="canonical" href="{{ request()->url() }}"> --}}
    @endif

    @include('frontend.layouts.parts.meta')
    @include('frontend.layouts.parts.icons')

<!-- Styles -->
    <style>
        .preloader {
            position: fixed;
            left: 0;
            top: 0;
            right: 0;
            bottom: 0;
            width: 100vw;
            height: 100vh;
            background: black;
            z-index: 100500;
        }

        .preloader__spinner {
            width: 100px;
            height: 100px;
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            color: white;
            text-align: center;
        }
    </style>
</head>
<body class="@yield('body_class')">

<!-- Google Tag Manager (noscript) -->
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TG5MSQM"
            height="0" width="0" style="display:none;visibility:hidden">
    </iframe>
</noscript>
<!-- End Google Tag Manager (noscript) -->

<div id="page-preloader" class="preloader">
    <span class="preloader__spinner">
        <svg width="100" height="100">
            <use xlink:href="#icon-logo"></use>
        </svg>
    </span>
</div>

{{ svg_spritesheet() }}

<div id="wrapper" class="wrapper @yield('color', 'white')" data-sticky_parent>

    @include('frontend.parts.header')
    @yield('header')

    @yield('content')

    @include('frontend.parts.footer')
    @yield('footer')

    @include('frontend.parts.sideMenu')
    @include('frontend.parts.sideSearch')
    @include('frontend.parts.start')

    @if (!Cookie::get('first_visit_was'))
        <div id="coocie-popup" class="bottom-popup mfp-hide">
            <div class="content">
                @lang('main.coocie_modal_text', ['url1' => route('about-cookie'), 'url2' => route('privacy-policy')])
            </div>
        </div>
        <a href="#coocie-popup" class="coocie-popup-link" style="position: absolute; left: -9999px;"></a>
    @endif

</div>

<!-- Style -->
<link href="{{ asset('frontend/css/app.css') }}" rel="stylesheet">
<!-- Scripts -->
@yield('script')
@if(app()->getLocale() === 'ru') {{-- TODO fix hard code --}}
<script src="{{ '/frontend/js/lang.js' }}"></script>
@else
    <script src="{{ '/' . app()->getLocale() . '/frontend/js/lang.js' }}"></script>
@endif
<script src="{{ mix('/frontend/js/app.min.js') }}"></script>
</body>
</html>
