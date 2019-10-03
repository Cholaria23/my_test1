<ul class="mHorMenu">
    @foreach($pages->toArray() as $pageItem)
        <li>
            <a href="{{ route($pageItem['slug']) }}" @if(Route::currentRouteName() == $pageItem['slug']) class="active" @endif>
                {{ $pageItem['title'] }}
            </a>
        </li>
    @endforeach
</ul>
