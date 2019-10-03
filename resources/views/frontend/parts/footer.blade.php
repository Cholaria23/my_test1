@section('footer')
    <footer class="footer" id="footer">
        <div class="footer__top">
            <div class="container">
                <div class="row middle-xs">
                    <div class="col-xs-12 col-lg-6 col-xl-8">
                        <subscribe-form></subscribe-form>
                    </div>
                    <div class="col-xs-12 col-lg-6 col-xl-4">
                        <div class="ourSocial">
                            <div class="row end-lg middle-xs">
                                <div class="col">
                                    <p class="ourSocial__title">
                                        @lang('main.follow_us')
                                    </p>
                                </div>
                                <div class="col">
                                    <a href="@lang('main.facebook')" target="_blank" rel="nofollow">
                                        <svg width="10px" height="20px">
                                            <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                                 xlink:href="#soc-facebook"></use>
                                        </svg>
                                    </a>
                                </div>
                                {{--<div class="col">--}}
                                {{--<a href="#" target="_blank" rel="nofollow">--}}
                                {{--<svg width="23px" height="23px">--}}
                                {{--<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#soc-viber"></use>--}}
                                {{--</svg>--}}
                                {{--</a>--}}
                                {{--</div>--}}
                                {{--<div class="col">--}}
                                {{--<a href="#" target="_blank" rel="nofollow">--}}
                                {{--<svg width="23px" height="23px">--}}
                                {{--<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#soc-twitter"></use>--}}
                                {{--</svg>--}}
                                {{--</a>--}}
                                {{--</div>--}}
                                <div class="col">
                                    <a href="@lang('main.instagram')" target="_blank" rel="nofollow">
                                        <svg width="23px" height="23px">
                                            <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                                 xlink:href="#soc-instagram"></use>
                                        </svg>
                                    </a>
                                </div>
                                {{--<div class="col">--}}
                                {{--<a href="#" target="_blank" rel="nofollow">--}}
                                {{--<svg width="23px" height="23px">--}}
                                {{--<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#soc-google"></use>--}}
                                {{--</svg>--}}
                                {{--</a>--}}
                                {{--</div>--}}
                                <div class="col">
                                    <a href="https://www.youtube.com/user/staleksvideo" target="_blank" rel="nofollow">
                                        <svg version="1.1"
                                             xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                             x="0px" y="0px" width="23px" height="23px" viewBox="0 0 23 23" style="enable-background:new 0 0 23 23;" xml:space="preserve">
                                            <g fill="currentColor">
                                                <polygon points="9.7,14.1 14.1,11.5 9.7,8.9 	"/>
                                                <path d="M11.5,0C5.1,0,0,5.1,0,11.5S5.1,23,11.5,23S23,17.9,23,11.5C23,5.1,17.9,0,11.5,0z M18.5,12.1
		c0,1.2-0.1,2.4-0.1,2.4s-0.1,1-0.6,1.5c-0.5,0.6-1.1,0.6-1.4,0.6c-2,0.2-4.9,0.2-4.9,0.2s-3.7,0-4.8-0.2c-0.3-0.1-1,0-1.6-0.6
		c-0.4-0.5-0.6-1.5-0.6-1.5s-0.1-1.2-0.1-2.4v-1.1c0-1.2,0.1-2.4,0.1-2.4s0.1-1,0.6-1.5c0.5-0.6,1.1-0.6,1.4-0.6
		c2-0.2,4.9-0.2,4.9-0.2h0c0,0,3,0,4.9,0.2c0.3,0,0.9,0,1.4,0.6c0.4,0.5,0.6,1.5,0.6,1.5s0.1,1.2,0.1,2.4L18.5,12.1L18.5,12.1z"/>
                                            </g>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer__bottom">
            <div class="container">
                <div class="row reverse">
                    <div class="col-xs-12 col-lg-3">
                        <div class="row end-lg">
                            <div class="col">
                                <p>
                                    <a href="{{ route('home') }}" class="footer__logo">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             xmlns:xlink="http://www.w3.org/1999/xlink" width="244px" height="40px"
                                             viewBox="0 0 244.02 40.54">
                                            <defs>
                                                <clipPath id="clippath2">
                                                    <path
                                                        d="M16.19,32.76h0Zm0-18.84a2.19,2.19,0,0,0,1.2,2l6.85,3.46A1.13,1.13,0,0,1,24.65,21L16.19,32.76v7.78l14.43-7.28a3.2,3.2,0,0,0,1.76-2.86V17.61a3.2,3.2,0,0,0-1.76-2.86L16.19,7.47ZM15.58,0,1.76,7A3.2,3.2,0,0,0,0,9.83V22.62a3.2,3.2,0,0,0,1.76,2.86l14.43,7.28V26.32a2.19,2.19,0,0,0-1.2-2L8.13,20.91a1.13,1.13,0,0,1-.41-1.67L16.19,7.48V0Z"
                                                        fill="currentColor"/>
                                                </clipPath>
                                            </defs>
                                            <title>logo</title>
                                            <g>
                                                <path
                                                    d="M60,19.49a10.12,10.12,0,0,0-3.25-.82l-4.67-.54a7.5,7.5,0,0,1-1.56-.31,1.72,1.72,0,0,1-1-.74,1.77,1.77,0,0,1-.11-1.25,1.89,1.89,0,0,1,1.06-1.15A7.05,7.05,0,0,1,53,14.16a13.73,13.73,0,0,1,5,.56A11.21,11.21,0,0,1,60.57,16q.74-1.12,1.46-2.24a11.79,11.79,0,0,0-4.3-1.91,17.07,17.07,0,0,0-3.36-.37h-.71a12.41,12.41,0,0,0-3.82.64,5.52,5.52,0,0,0-2.8,2,4.48,4.48,0,0,0-.56,3.44,3.62,3.62,0,0,0,1.08,1.92,5.34,5.34,0,0,0,2.11,1.13,13.25,13.25,0,0,0,2.47.45l4.62.51a6.32,6.32,0,0,1,1.76.36,1.79,1.79,0,0,1,1,.87,2,2,0,0,1-.22,2,3.46,3.46,0,0,1-1.76,1,12.74,12.74,0,0,1-4.6.25,12.06,12.06,0,0,1-5.65-2.12c-.48.79-1,1.57-1.44,2.37a12.73,12.73,0,0,0,4.33,2,16.46,16.46,0,0,0,3.8.47h.6A12.6,12.6,0,0,0,60,27.65a4.59,4.59,0,0,0,2.4-2.76A4.84,4.84,0,0,0,62,21.23a4.5,4.5,0,0,0-2-1.75"
                                                    fill="currentColor"/>
                                                <path
                                                    d="M173.28,21.35a4.34,4.34,0,0,0-1.88-1.76,9.77,9.77,0,0,0-3.45-.91l-4.67-.54a5.86,5.86,0,0,1-1.94-.47,1.39,1.39,0,0,1-.74-.86,1.78,1.78,0,0,1,.12-1.25,2.12,2.12,0,0,1,1.11-.93,7.79,7.79,0,0,1,2.56-.47,14.49,14.49,0,0,1,4.11.36A10.91,10.91,0,0,1,171.76,16l1.46-2.24a11.89,11.89,0,0,0-3.34-1.65,15.56,15.56,0,0,0-4.32-.62h-.71a11.81,11.81,0,0,0-4.26.8,5.19,5.19,0,0,0-2.41,1.9,4.55,4.55,0,0,0-.44,3.66,3.67,3.67,0,0,0,1.69,2.14,8.77,8.77,0,0,0,3.46,1l5.26.58A4.83,4.83,0,0,1,170,22a1.62,1.62,0,0,1,.75.86,2,2,0,0,1-.2,1.77,3,3,0,0,1-1.44,1,9.35,9.35,0,0,1-3,.47,13.68,13.68,0,0,1-4.39-.6,12.72,12.72,0,0,1-3.24-1.61c-.48.79-1,1.57-1.44,2.37A13.14,13.14,0,0,0,160.37,28a15.29,15.29,0,0,0,4.78.76h.6a13.4,13.4,0,0,0,5.07-1,5.07,5.07,0,0,0,2.46-2.14,4.66,4.66,0,0,0,.52-2.35,4.41,4.41,0,0,0-.51-2"
                                                    fill="currentColor"/>
                                                <path
                                                    d="M106.37,11.86l0,0c-1,0-2,0-3,0,0,.33,0,.66,0,1q0,7.78,0,15.56h15q0-1.38,0-2.75H106.37q0-6.88,0-13.75"
                                                    fill="currentColor"/>
                                                <path
                                                    d="M150.42,19.36c1.72-2.51,3.46-5,5.17-7.53h-3.46c-.16.11-.23.31-.35.46-1.35,2-2.71,4-4.05,5.94H142c0-2.14,0-4.27,0-6.41-1,0-2,0-3,0q0,8.27,0,16.55h3V21h5.87l4.61,7.39H156l-5.65-8.83c-.06-.06,0-.12.05-.18"
                                                    fill="currentColor"/>
                                                <path
                                                    d="M81.51,14.58V11.83H64.4c0,.92,0,1.84,0,2.75,2.34,0,4.68,0,7,0q0,6.89,0,13.78h3.05c0-4.6,0-9.2,0-13.8,2.35,0,4.69,0,7,0"
                                                    fill="currentColor"/>
                                                <path
                                                    d="M123.79,25.6c0-1.44,0-3.52,0-3.52l10.6-3.27H123.79c0-1.33,0-2.91,0-4.23h11.76c0-.92,0-1.84,0-2.75H120.74c0,5.52,0,11,0,16.55H136c0-.93,0-1.85,0-2.78q-6.1,0-12.21,0"
                                                    fill="currentColor"/>
                                                <path
                                                    d="M88,11.82q-3.63,8.27-7.24,16.55H84l1.21-2.81,9.8-3H86.46c.86-2.06,2.49-6,3.34-8,.63,0,1.26,0,1.9,0,1.16,2.84,5.45,12.95,5.83,13.82,1.07,0,2.14,0,3.21,0q-3.52-8.28-7-16.55-2.87,0-5.73,0"
                                                    fill="currentColor"/>
                                                <g>
                                                    <path
                                                        d="M16.19,32.76h0Zm0-18.84a2.19,2.19,0,0,0,1.2,2l6.85,3.46A1.13,1.13,0,0,1,24.65,21L16.19,32.76v7.78l14.43-7.28a3.2,3.2,0,0,0,1.76-2.86V17.61a3.2,3.2,0,0,0-1.76-2.86L16.19,7.47ZM15.58,0,1.76,7A3.2,3.2,0,0,0,0,9.83V22.62a3.2,3.2,0,0,0,1.76,2.86l14.43,7.28V26.32a2.19,2.19,0,0,0-1.2-2L8.13,20.91a1.13,1.13,0,0,1-.41-1.67L16.19,7.48V0Z"/>
                                                    <g clip-path="url(#clippath2)">
                                                        <rect width="32.37" height="40.54" fill="currentColor"/>
                                                    </g>
                                                </g>
                                                <g class="pro">
                                                    <path
                                                        d="M201.21,16.53c0,1.73-1.09,2.57-3.34,2.57H190V13.89H198c2.06,0,3.24,1,3.24,2.64M198,11.82h-10.4V28.37H190V21.21h8.27c3.25,0,5.43-2,5.43-4.86s-2.14-4.53-5.73-4.53"
                                                        fill="currentColor"/>
                                                    <path
                                                        d="M220.3,16.53c0,1.73-1.09,2.57-3.34,2.57h-7.84V13.89h7.94c2.06,0,3.24,1,3.24,2.64m2.53-.06c0-3-2.09-4.65-5.73-4.65H206.7V28.37h2.43V21.21h6.82l4.5,7.16h2.69l-4.52-7.22a4.75,4.75,0,0,0,4.21-4.68"
                                                        fill="currentColor"/>
                                                    <path
                                                        d="M241.49,20.14c0,3.8-2.9,6.55-6.91,6.55s-6.91-2.75-6.91-6.55,2.9-6.58,6.91-6.58,6.91,2.77,6.91,6.58m-6.91-8.68c-5.45,0-9.4,3.65-9.4,8.68s4,8.65,9.4,8.65S244,25.15,244,20.14s-4-8.68-9.43-8.68"
                                                        fill="currentColor"/>
                                                </g>
                                            </g>
                                        </svg>
                                    </a>
                                </p>
                                <p class="footer__copyright">
                                    ©STALEKS 2018. All Rights Reserved
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-lg-9">
                        <div class="row">
                            @if(App::getLocale() === 'en' || App::getLocale() === 'pt' || App::getLocale() === 'es'  )
                                <div class="col-xs-12 col-md-3">
                                    <h3 class="footer__title">
                                        @lang('main.about')
                                        <span class="icon">
                                        <svg width="16px" height="10px">
                                            <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                                 xlink:href="#icon-arrow-drop-bottom"></use>
                                        </svg>
                                    </span>
                                    </h3>
                                    <ul class="footer__menu">
                                        <li>
                                            <a href="{{ route('about') }}">
                                                @lang('main.about__company')
                                            </a>
                                        </li>
                                        {{--<li>--}}
                                        {{--<a href="{{ route('service') }}">--}}
                                        {{--@lang('main.for_professionals')--}}
                                        {{--</a>--}}
                                        {{--</li>--}}
                                        <li>
                                            <a href="{{ route('blog') }}">
                                                @lang('main.staleks_world')
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('faq') }}">
                                                @lang('main.faq') (F.A.Q.)
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('contacts') }}">
                                                @lang('main.contacts')
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-xs-12 col-md-3">
                                    <h3 class="footer__title">
                                       @lang('main.department_europe')
                                        <span class="icon">
                                            <svg width="16px" height="10px">
                                                <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                                     xlink:href="#icon-arrow-drop-bottom"></use>
                                            </svg>
                                        </span>
                                    </h3>
                                    <ul class="footer__menu">
                                        <li>
                                            <a href="tel:+37064119349">
                                                +37064119349
                                            </a>
                                        </li>
                                        <li>
                                            <a href="mailto:sales.eu@staleks.com">
                                                sales.eu@staleks.com
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-xs-12 col-md-3">
                                    <h3 class="footer__title">
                                        @lang('main.department_world')
                                        <span class="icon">
                                            <svg width="16px" height="10px">
                                                <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                                     xlink:href="#icon-arrow-drop-bottom"></use>
                                            </svg>
                                        </span>
                                    </h3>
                                    <ul class="footer__menu">
                                        <li>
                                            <a href="tel:+380992004668">
                                                +38 099 200 46 68
                                            </a>
                                        </li>
                                        <li>
                                            <a href="mailto:sales@staleks.com">
                                                sales@staleks.com
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-xs-12 col-md-3">
                                    <h3 class="footer__title">
                                        @lang('main.department_usa')
                                        <span class="icon">
                                            <svg width="16px" height="10px">
                                                <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                                     xlink:href="#icon-arrow-drop-bottom"></use>
                                            </svg>
                                        </span>
                                    </h3>
                                    <ul class="footer__menu">
                                        <li>
                                            <a href="tel:+19293256275">
                                                +1 929 325 6275
                                            </a>
                                        </li>
                                        <li>
                                            <a href="tel:+13478096375">
                                                +1 347 809 6375
                                            </a>
                                        </li>
                                        <li>
                                            <a href="mailto:info@staleks.com">
                                                info@staleks.com
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://staleks.us" target="_blank" rel="nofollow">
                                                Official Online Shop
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            @else
                                <div class="col-xs-12 col-md-4">
                                    <h3 class="footer__title">
                                        @lang('main.about')
                                        <span class="icon">
                                        <svg width="16px" height="10px">
                                            <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                                 xlink:href="#icon-arrow-drop-bottom"></use>
                                        </svg>
                                    </span>
                                    </h3>
                                    <ul class="footer__menu">
                                        <li>
                                            <a href="{{ route('about') }}">
                                                @lang('main.about__company')
                                            </a>
                                        </li>
                                        {{--<li>--}}
                                        {{--<a href="{{ route('service') }}">--}}
                                        {{--@lang('main.for_professionals')--}}
                                        {{--</a>--}}
                                        {{--</li>--}}
                                        <li>
                                            <a href="{{ route('blog') }}">
                                                @lang('main.staleks_world')
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('faq') }}">
                                                @lang('main.faq') (F.A.Q.)
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('contacts') }}">
                                                @lang('main.contacts')
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-xs-12 col-md-4">
                                    <h3 class="footer__title">
                                        @lang('main.company_stores')
                                        <span class="icon">
                                            <svg width="16px" height="10px">
                                                <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                                     xlink:href="#icon-arrow-drop-bottom"></use>
                                            </svg>
                                        </span>
                                    </h3>
                                    <ul class="footer__menu">
                                        <li>
                                            <a href="https://staleks.ua/" target="_blank" rel="nofollow">
                                                Staleks.ua @if(App::getLocale() === 'ru') (Украина) @elseif(App::getLocale() === 'ua') (Україна) @endif
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://staleks.su/" target="_blank" rel="nofollow">
                                                Staleks.su @if(App::getLocale() === 'ru') (Россия) @elseif(App::getLocale() === 'ua') (Росія) @endif
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://staleks.us/" target="_blank" rel="nofollow">
                                                Staleks.tools (США)
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-xs-12 col-md-4">
                                    <h3 class="footer__title">
                                        @lang('main.company_shops')
                                        <span class="icon">
                                            <svg width="16px" height="10px">
                                                <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                                     xlink:href="#icon-arrow-drop-bottom"></use>
                                            </svg>
                                        </span>
                                    </h3>
                                    <ul class="footer__menu">
                                        <li>
                                            <a href="http://staleks.com/shop-and-service">
                                                Staleks Shop & Service (Киев)
                                            </a>
                                        </li>
                                        <li>
                                            <a href="http://staleks.com/shop-and-service">
                                                Staleks Shop & Service (Харьков)
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            @endif
                        </div>
                        <div class="footer__links">
                            <div class="row">
                                <div class="col-xs-12 @if(App::getLocale() == 'en') col-md-3 @else col-md-4 @endif">
                                    <a href="{{ route('agreement') }}">
                                        @lang('main.agreement')
                                    </a>
                                </div>
                                <div class="col-xs-12 @if(App::getLocale() == 'en') col-md-3 @else col-md-4 @endif">
                                    <a href="{{ route('privacy-policy') }}">
                                        @lang('main.privacy_policy')
                                    </a>
                                </div>
                                <div class="col-xs-12 @if(App::getLocale() == 'en') col-md-3 @else col-md-4 @endif">
                                    <a href="{{ route('about-cookie') }}">
                                        @lang('main.about_cookie')
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer__wrap">
            <div class="container">
                <div class="footer__box">
                    <div class="footer__bg">
                        <svg version="1.1"
                             xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                             x="0px" y="0px" width="575px" height="330px" viewBox="0 0 575 330"
                             style="enable-background:new 0 0 575 330;"
                             xml:space="preserve">
                        <path class="st0"
                              d="M565,0H10H0v330h10c13.5-6.5,24.7-17.3,31.7-31.1l109-216.2c9.9-19.6,34.9-25.7,52.7-12.9L565,330h10V0H565z"/>
                    </svg>
                    </div>
                    <div class="footer__img"></div>
                </div>
            </div>
        </div>
    </footer>
@endsection
