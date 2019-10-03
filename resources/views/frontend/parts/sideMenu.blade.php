<div class="mSidebar">
    <div class="mSidebar__shadow" id="mSidebar__shadow"></div>
    <div class="mSidebar__wrap">
        <div class="mSidebar__line"></div>
        <div class="mSidebar__row">
            <div class="mSidebar__col--header">
                <div class="row middle-xs between-xs">
                    <div class="col">
                        <div class="mSidebar__social">
                            <div class="row middle-xs">
                                <div class="col">
                                    <a class="socIcon" href="@lang('main.facebook')" target="_blank" rel="nofollow">
                                        <svg width="10px" height="20px">
                                            <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                                 xlink:href="#soc-facebook"></use>
                                        </svg>
                                    </a>
                                </div>
                                {{--<div class="col">--}}
                                    {{--<a href="#" target="_blank" rel="nofollow">--}}
                                        {{--<svg width="23px" height="23px">--}}
                                            {{--<use xmlns:xlink="http://www.w3.org/1999/xlink"--}}
                                                 {{--xlink:href="#soc-viber"></use>--}}
                                        {{--</svg>--}}
                                    {{--</a>--}}
                                {{--</div>--}}
                                {{--<div class="col">--}}
                                    {{--<a href="#" target="_blank" rel="nofollow">--}}
                                        {{--<svg width="23px" height="23px">--}}
                                            {{--<use xmlns:xlink="http://www.w3.org/1999/xlink"--}}
                                                 {{--xlink:href="#soc-twitter"></use>--}}
                                        {{--</svg>--}}
                                    {{--</a>--}}
                                {{--</div>--}}
                                <div class="col">
                                    <a class="socIcon" href="@lang('main.instagram')" target="_blank" rel="nofollow">
                                        <svg width="23px" height="23px">
                                            <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                                 xlink:href="#soc-instagram"></use>
                                        </svg>
                                    </a>
                                </div>
                                <div class="col">
                                    <a class="socIcon" href="https://www.youtube.com/user/staleksvideo" target="_blank" rel="nofollow">
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
                                {{--<div class="col">--}}
                                    {{--<a href="#" target="_blank" rel="nofollow">--}}
                                        {{--<svg width="23px" height="23px">--}}
                                            {{--<use xmlns:xlink="http://www.w3.org/1999/xlink"--}}
                                                 {{--xlink:href="#soc-google"></use>--}}
                                        {{--</svg>--}}
                                    {{--</a>--}}
                                {{--</div>--}}
                                <div class="col lang">
                                    <div class="langSwitcher">
                                        <div class="langSwitcher__value">
                                            {{ App::getLocale() }}
                                        </div>
                                        @if (request()->route())
                                            <div class="langSwitcher__drop">
                                                <ul>
                                                    @foreach($total_languages as $lang)
                                                        @if(App::getLocale() != $lang->code)
                                                            <li>
                                                                @if ($lang->code === 'ru')
                                                                    @php($url = str_replace(request()->root() . request()->route()->getPrefix(), request()->root(), request()->url()))
                                                                @else
                                                                    @php($url = str_replace(request()->root() . request()->route()->getPrefix(), request()->root() . '/' . $lang->code, request()->url()))
                                                                @endif
                                                                @php($url = request()->getQueryString() ? $url . '?' . request()->getQueryString() : $url)
                                                                <a href="{{ $url }}">
                                                                    <span class="row middle-xs center-xs">
                                                                        <span class="col">
                                                                            <img src="{{ asset('frontend/img/flags/' . $lang->code . '.jpg') }}" alt="">
                                                                        </span>
                                                                        <span class="col">
                                                                            {{ $lang->code }}
                                                                        </span>
                                                                    </span>
                                                                </a>
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <a href="#" class="mSidebar__close" id="mSidebar__close">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 40 40" width="40px" height="40px"
                                 enable-background="new 0 0 40 40">
                                <line x1="15" y1="15" x2="25" y2="25" stroke="#fff" stroke-width="2.5"
                                      stroke-linecap="round" stroke-miterlimit="10"></line>
                                <line x1="25" y1="15" x2="15" y2="25" stroke="#fff" stroke-width="2.5"
                                      stroke-linecap="round" stroke-miterlimit="10"></line>
                                <path d="M20 1c10.45 0 19 8.55 19 19s-8.55 19-19 19-19-8.55-19-19 8.55-19 19-19z"
                                      class="circle" stroke="#fff" stroke-width="2" stroke-linecap="round"
                                      stroke-miterlimit="10" fill="none"></path>
                                <path d="M20 1c10.45 0 19 8.55 19 19s-8.55 19-19 19-19-8.55-19-19 8.55-19 19-19z"
                                      class="progress" stroke="#000" stroke-width="4" stroke-linecap="round"
                                      stroke-miterlimit="10" fill="none"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            <div class="mSidebar__col--body">
                <ul class="mSidebar__menu">
                    <li>
                        <a href="{{ route('home') }}">
                            @lang('main.main_page')
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('catalog-pro') }}">
                            @lang('main.catalog2') Staleks Pro
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('catalog') }}">
                            @lang('main.catalog2') Staleks
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('about') }}">
                            @lang('main.about')
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('maintenance') }}">
                            @lang('main.for_professionals')
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('blog') }}">
                            @lang('main.staleks_world')
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contacts') }}">
                            @lang('main.contacts')
                        </a>
                    </li>
                </ul>
            </div>
            <div class="mSidebar__col--footer"> 
           {{--     <a href="#" class="mSidebar__switcher">  --}}
           {{--         @lang('main.select_country_lang')  --}}
            {{--   </a> --}}
           </div> 
        </div>
    </div>
</div>
