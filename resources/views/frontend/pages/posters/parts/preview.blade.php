<div class="ePoster">
    <h2 class="ePoster__title">
        {{ $poster->translate(App::getLocale())->title }}
    </h2>
    <div class="ePoster__content">
        {!! $poster->translate(App::getLocale())->content !!}
    </div>
    <p class="ePoster__btn">
        <a href="">
             @lang('main.connect')
        </a>
    </p>
</div>