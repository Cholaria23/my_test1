@php($product_route = $product->is_pro === 'pro' ? 'product-pro' : 'product')
<div class="eProduct">
    <div class="eProduct__header">
        <div class="row middle-xs between-xs">
            <div class="col">
                <a class="eProduct__line">
                    {{ $product->model }}
                </a>
            </div>
            <div class="col">
                <div class="row">
                    @foreach($product->appointments as $appointment)
                        <div class="col">
                            <a href="{{ route($product->is_pro === 'pro' ? 'catalog-pro-appointment' : 'catalog-appointment', ['slug' => $appointment->slug]) }}"
                               class="eProduct__type checkAppointment"
                                 data-id="{{ $appointment->id }}"
                                 title="{{ $appointment->translate(App::getLocale())->title }}">
                                <svg width="10px" height="15px" class="{{ $appointment->icon_color }}">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-logo-small"></use>
                                </svg>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <a href="{{ route($product_route, ['slug' => $product->slug]) }}" class="eProduct__image">
        <span class="image1">
            <img src="{{ $product->thumbPreviewImage1Url }}" alt="{{ $product->translate(App::getLocale())->title }}">
        </span>
        <span class="image2">
            <img src="{{ $product->thumbPreviewImage2Url }}" alt="{{ $product->translate(App::getLocale())->title }}">
        </span>
    </a>
    <h2 class="eProduct__title">
        <a href="{{ route($product_route, ['slug' => $product->slug]) }}">
            {{ $product->translate(App::getLocale())->title }}
        </a>
    </h2>
    <div class="eProduct__footer">
        <div class="row middle-xs between-xs">
            <div class="col">
                <p class="eProduct__sku">
                    {{ $product->sku }}
                </p>
            </div>
            <div class="col">
                @if($product->is_new)
                    <p class="pProduct__label--purple">
                        @lang('main.is_new')
                    </p>
                @elseif($product->is_old)
                    <p class="pProduct__label--red">
                        @lang('main.is_old')
                    </p>
                @endif
            </div>
        </div>
    </div>
</div>