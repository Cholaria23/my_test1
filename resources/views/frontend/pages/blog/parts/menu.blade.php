<ul class="mHorMenu">
    <li>
        <a href="{{ route('blog') }}" @if(Route::currentRouteName() == 'blog' && Request::route('slug') == null) class="active" @endif>
            @lang('main.all')
            <span class="count">
                {{ $articlesCount }}
            </span>
        </a>
    </li>
    @foreach($categories as $category)
        <li>
            <a href="{{ route('blog', ['slug' => $category->slug]) }}"
               @if((Route::currentRouteName() == 'blog' && Request::route('slug') == $category->slug) || (Route::currentRouteName() == 'article' && $article->category->slug == $category->slug)) class="active" @endif>
                {{ $category->translate(App::getLocale())->title }}
                <span class="count">
                    {{ $category->articles->count() }}
                </span>
            </a>
        </li>
    @endforeach
</ul>
