{{--<div class="pStart" @if(is_null(Cookie::get('country_id'))) style="display: block;" @else style="display: none;"  @endif>--}}
<div class="pStart" style="display: none;">
    <div class="pStart__bg--left"></div>
    <div class="pStart__bg--right"></div>
    <div class="container">
        <div class="pStart__wrap">

            <form action="{{ route('select-country-and-language') }}" method="post" class="pStart__form">
                <p class="pStart__logo">
                    <svg width="244px" height="40px">
                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#logo"></use>
                    </svg>
                </p>
                <p>
                    <label for="country_select">@lang('main.country')</label>
                    <select name="country_id" id="country_select">
                        @foreach($total_countries as $country)
                            <option value="{{ $country->id }}" @if(Cookie::get('country_id') == $country->id) selected @endif>
                                {{ $country->translate(app()->getLocale())->title }}
                            </option>
                        @endforeach
                    </select>
                </p>
               {{--   --}}
                <p>
                    <label for="language_select">
                        @lang('main.language')
                    </label>
                    <select name="language_id" id="language_select">
                       @foreach($total_languages as $lang) 
                            <option value="{{ $lang->id }}" @if(Cookie::get('language_id') == $lang->id) selected @endif>
                                {{ $lang->title }}
                            </option>
                       @endforeach 
                    </select>
                </p>
                {{--    --}}
                <div class="row between-xs middle-xs">
                    <div class="col">
                        @if(!is_null(Cookie::get('country_id')))
                            <a class="eLink--black langSwitcher__close">
                                @lang('main.cancel')
                            </a>
                        @endif
                    </div>
                    <div class="col">
                        <button class="eBtn--black" type="submit">
                            @lang('main.next')
                        </button>
                    </div>
                </div>
                <p>
                </p>
            </form>

        </div>
    </div>
</div>
