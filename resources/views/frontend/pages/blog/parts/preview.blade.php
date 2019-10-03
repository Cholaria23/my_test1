<div class="eArticle">
    <a href="{{ $article->url }}" class="eArticle__image">
        <img src="{{ $article->thumbImageUrl }}" alt="{{ $article->translate(App::getLocale())->title }}" title="{{ $article->translate(App::getLocale())->title }}">
    </a>
    <p class="eArticle__date">
        <strong>
            {{ $article->created_at->format('d') }}
        </strong>
        {{ $article->created_at->format('m/Y') }}
    </p>
    <h2 class="eArticle__title">
        <a href="{{ route('article', ['slug' => $article->slug]) }}">
            {{ $article->translate(App::getLocale())->title }}
        </a>
    </h2>
    <p class="eArticle__cat">
        <a href="{{ route('blog', ['slug' => $article->category->slug]) }}">
            {{ $article->category->translate(App::getLocale())->title }}
        </a>
    </p>
    {{--<div class="eArticle__intro">--}}
        {{--{{ substr(strip_tags($article->translate(App::getLocale())->content), 0, 100) }}--}}
    {{--</div>--}}
    {{--<p class="eArticle__views">--}}
        {{--{{ $article->views }}--}}
    {{--</p>--}}
</div>