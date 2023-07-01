<div class="d-flex row justify-content-between">
    @foreach($most as $key => $item)
        <div class="col-4 my-3 splide {{ $key }}-splide" id="{{ $key }}-splide">
            <div class="card border-0" data-aos="fade-up" data-aos-delay="100">
                <div class="card-header border-0 fw-bold d-flex justify-content-between">
                    <div class="small">{{ $item['header'] }}</div>
                    <div class="splide__arrows">
                        <span class="cursor-pointer custom-arrow bi-arrow-left-short splide__arrow--prev"></span>
                        <span class="cursor-pointer custom-arrow bi-arrow-right-short splide__arrow--next"></span>
                    </div>
                </div>
                <div class="card-body d-flex justify-content-between">

                    <div class="splide__track">
                        <ul class="splide__list">

                            @foreach($item['products'] as $product)
                                <li class="splide__slide my-1" data-splide-interval="5000">
                                    <div class="col-auto">
                                        <a href="{{ route('products.show', $product->slug) }}">
                                            <img src="{{ $product->image() }}" alt="" style="border-radius: 4px; width: auto; height: 70px;">
                                        </a>
                                        <div class="small text-center mt-2" style="font-family: Calibri">
                                            <div class="fw-semibold">{{ number_format($product->price, '2', '.') }} <span class="font-monospace">TMT</span></div>
                                            <div class="text-secondary"> {{ $product->stock }} pieces</div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach

                        </ul>
                    </div>

                </div>
            </div>
        </div>
    @endforeach
    {{--@foreach($topC as $k => $item)--}}
        {{--<div class="col-4 my-3 splide {{ $k }}-splide" id="{{ $k }}-splide">--}}
            {{--<div class="card border-0">--}}
                {{--<div class="card-header border-0 fw-bold d-flex justify-content-between">--}}
                    {{--<div>{{ $item['category'] }}</div>--}}
                    {{--<div class="splide__arrows">--}}
                        {{--<span class="cursor-pointer custom-arrow bi-arrow-left-short splide__arrow--prev"></span>--}}
                        {{--<span class="cursor-pointer custom-arrow bi-arrow-right-short splide__arrow--next"></span>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="card-body d-flex justify-content-between">--}}

                    {{--<div class="splide__track">--}}
                        {{--<ul class="splide__list">--}}

                            {{--@foreach($item['products'] as $product)--}}
                                {{--<li class="splide__slide my-1" data-splide-interval="5000">--}}
                                    {{--<div class="col-auto">--}}
                                        {{--<a href="{{ route('products.show', $product->slug) }}">--}}
                                            {{--<img src="{{ $product->image() }}" alt="" style="border-radius: 4px" width="100" height="100">--}}
                                        {{--</a>--}}
                                        {{--<div class="small text-center mt-2" style="font-family: Calibri">--}}
                                            {{--<div class="fw-semibold">Price: {{ number_format($product->price, '2', '.') }} <span class="font-monospace">TMT</span></div>--}}
                                            {{--<div class="text-secondary"> {{ $product->stock }} pieces</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</li>--}}
                            {{--@endforeach--}}

                        {{--</ul>--}}
                    {{--</div>--}}

                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--@endforeach--}}
</div>
