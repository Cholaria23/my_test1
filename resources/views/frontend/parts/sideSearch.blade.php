<div class="mSearch">
    <div class="mSearch__shadow" id="mSearch__shadow"></div>
    <div class="mSearch__wrap">
        <div class="mSearch__line"></div>
        <div class="mSearch__row">
            <div class="container">
                <form action="{{ route('search') }}" method="get" class="mSearch__form">
                    <input name="search" type="text" class="mSearch__input" placeholder="@lang('main.searchPlaceholder')">
                    <a href="#" class="mSearch__close" id="mSearch__close">
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
                </form>
            </div>
        </div>
    </div>
</div>