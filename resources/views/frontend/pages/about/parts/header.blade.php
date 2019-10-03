@php($headerImg = isset($headerImg) ? '/frontend/img/about/' . $headerImg : '/frontend/img/about/aboutImg.jpg')

<div class="pAboutHeader">
    <div class="pAboutHeader__wrap">
        <div class="pAboutHeader__bg" style="background-image: url('{{ asset($headerImg) }}');"></div>
    </div>
    <div class="pAboutHeader__box">
        <h2 class="pAboutHeader__title">
            @if (in_array(Route::currentRouteName(), ['service', 'maintenance', 'education']))
                @lang('main.for_professionals')
            @else
                @lang('main.about')
            @endif
        </h2>
        @if (isset($pages))
            <div class="pAboutHeader__menu">
                @foreach($pages->toArray() as $pageItem)
                    <li>
                        <a href="{{ route($pageItem['slug']) }}" @if(Route::currentRouteName() == $pageItem['slug']) class="active" @endif>
                            {{ $pageItem['title'] }}
                        </a>
                    </li>
                @endforeach
            </div>
        @endif
    </div>
</div>