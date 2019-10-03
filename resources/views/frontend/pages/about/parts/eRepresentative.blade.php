<div class="eRepresentative">
    <a class="eRepresentative__img">
        <img src="{{ $person->avatarImageUrl }}" alt="">
    </a>
    <h4 class="eRepresentative__title">
        <a href="#">
            {!! $person->translate(App::getLocale())->name !!}
        </a>
    </h4>
    <p class="eRepresentative__text">
        {!! $person->translate(App::getLocale())->post !!}
    </p>
    <p class="eRepresentative__soc row center-xs">
        @if ($person->facebook)
            <span class="col">
                <a href="{{ $person->facebook }}" target="_blank" rel="nofollow">
                    <svg width="10px" height="20px">
                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                             xlink:href="#soc-facebook"></use>
                    </svg>
                </a>
            </span>
        @endif
        @if ($person->viber)
            <span class="col">
                <a href="{{ $person->viber }}" target="_blank" rel="nofollow">
                    <svg width="23px" height="23px">
                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                             xlink:href="#soc-viber"></use>
                    </svg>
                </a>
            </span>
        @endif
        @if ($person->twitter)
            <span class="col">
                <a href="{{ $person->twitter }}" target="_blank" rel="nofollow">
                    <svg width="23px" height="23px">
                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                             xlink:href="#soc-twitter"></use>
                    </svg>
                </a>
            </span>
        @endif
        @if ($person->instagram)
            <span class="col">
                <a href="{{ $person->instagram }}" target="_blank" rel="nofollow">
                    <svg width="23px" height="23px">
                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                             xlink:href="#soc-instagram"></use>
                    </svg>
                </a>
            </span>
        @endif
        @if ($person->google)
            <span class="col">
                <a href="{{ $person->google }}" target="_blank" rel="nofollow">
                    <svg width="23px" height="23px">
                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                             xlink:href="#soc-google"></use>
                    </svg>
                </a>
            </span>
        @endif
    </p>
    @if($person->translate(App::getLocale())->content)
        <p class="eRepresentative__more">
            <a href="#person-{{ $person->id }}" class="eLink--black open-popup-link">
                @lang('main.more')
            </a>
        </p>
        <div id="person-{{ $person->id }}" class="white-popup mfp-hide">
            {!! $person->translate(App::getLocale())->content !!}
        </div>
    @endif
</div>