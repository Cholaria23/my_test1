<div class="eWorkplace">
    <h2 class="eWorkplace__title">
        <a href="{{ route('workplace', ['slug' => $workplace->slug]) }}">
            {{ $workplace->translate(App::getLocale())->title }}
        </a>
    </h2>
    <div class="eWorkplace__date">
        {{ $workplace->created_at }}
    </div>
    <p class="eWorkplace__btn">
        <a href="">
            @lang('main.connect')
        </a>
    </p>
</div>