@extends('customer.layouts.app')
@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Products</li>
@endsection
@section('content')
    <div class="d-flex justify-content-between">
        <div class="col-3">
            @include('customer.app.filter')
        </div>

        <div class="col-11">
            <div class="border-bottom pb-2 ms-2" style="--bs-border-color: orange!important">
                <div class="row justify-content-around">
                    <div class="col-auto ms-2">
                        <a href="javascript:void(0);"
                           class="btn btn-sm btn-primary"
                           onclick="$('form#productFilter').submit();">
                            <i class="bi-search"></i> Filter
                        </a>
                    </div>
                    <div class="col-auto">
                        <a href="{{ route('products.index') }}" class="btn btn-sm btn-outline-danger">Clear <i class="bi-x"></i></a>
                    </div>
                    @foreach(array_keys($orderConfig) as $ordering)
                        <div class="col-auto">
                            <input type="radio" class="btn-check" name="ordering" id="radio-{{ $ordering }}" content="{{ $ordering }}" autocomplete="off" {{ $ordering == $f_order ? 'checked' : '' }}>
                            <label class="btn btn-sm btn-radio" for="radio-{{ $ordering }}">@lang('app.' . $ordering)</label>
                        </div>
                    @endforeach

                </div>
            </div>
            <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 g-4 m-2">
                @foreach($products as $product)
                    <div class="col">
                        <div class="overflow-hidden shadow-sm hover-effect position-relative">
                            @if($product->isNew())
                                <span class="position-absolute top-0 start-0 m-1 ms-0 z-1">
                                    <span class="badge bg-success-subtle text-success-emphasis" style="border-radius: 0 5px 5px 0;">New</span>
                                </span>
                            @endif
                            <span class="position-absolute bottom-0 end-0 m-1 z-1">
                                <a class="btn btn-light btn-sm" data-fancybox="gallery" href="{{ $product->image() }}" data-caption="{{ $product->name }}">
                                    <i class="bi-zoom-in"></i>
                                </a>
                            </span>
                            <a href="{{ route('products.show', $product->slug) }}">
                                <img src="{{ $product->image() }}" data-src="{{ $product->image() }}" alt="{{ $product->name }}" class="temp-image img-fluid">
                            </a>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <div class="h6 text-primary mb-0">
                                {{ $product->price }}
                                <small>TMT</small>
                            </div>
                            <button type="button" class="btn btn-outline-danger btn-sm add-to-cart" value="3596">
                                <i class="bi-basket"></i> Goş        </button>
                        </div>
                        <a href="https://gnbookstore.com.tm/product/celovek-benzopila-kniga-4-vo-sne-nastoiashhaia-zest-3596" class="small link-dark text-decoration-none">
                            Человек-бензопила. Книга 4. Во сне. Настоящая жесть
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="mb-3">
                {{ $products->links() }}
            </div>
        </div>
    </div>
@endsection

{{--<script>--}}
{{--$(window).on("ready load resize", function () {--}}
{{--$("#pageBody").css({"margin-bottom": -$("#pageFooter").height()});--}}
{{--$("#pagePush").css({"height": $("#pageFooter").height()});--}}
{{--let w = this;--}}
{{--$(document).ready(function () {--}}
{{--if (w.matchMedia("(min-width: 992px)").matches) {--}}
{{--$(".slider-splide img").each(function () {--}}
{{--$(this).attr("src", $(this).attr("data-src"));--}}
{{--});--}}
{{--} else {--}}
{{--$(".slider-splide img").each(function () {--}}
{{--$(this).attr("src", $(this).attr("data-src-api"));--}}
{{--});--}}
{{--}--}}
{{--});--}}
{{--});--}}
{{--$('.add-to-cart').click(function () {--}}
{{--let self = $(this);--}}
{{--if (self.val() === "added") {--}}
{{--window.location.href = "https://gnbookstore.com.tm/cart";--}}
{{--} else {--}}
{{--self.attr("disabled", true);--}}
{{--$.ajax({--}}
{{--url: "https://gnbookstore.com.tm/cart/add",--}}
{{--dataType: "json",--}}
{{--type: "POST",--}}
{{--data: {"_token": "s0noOnKxksuQB4K3GRIWDR6uKnX2cp9oRCKqWei8", "id": self.val()},--}}
{{--success: function (result, status, xhr) {--}}
{{--self.val("added");--}}
{{--self.attr("disabled", false);--}}
{{--if (result["cart"] > 0) {--}}
{{--$('#cart').removeClass('invisible').text(result["cart"]);--}}
{{--} else {--}}
{{--$('#cart').addClass('invisible').text(result["cart"]);--}}
{{--}--}}
{{--self.removeClass("btn-outline-danger").addClass("btn-danger").html("<i class='bi-check-circle'></i> Goşuldy");--}}
{{--},--}}
{{--error: function (result, status, xhr) {--}}
{{--self.removeClass("btn-outline-danger").addClass("btn-dark").html("Näsazlyk");--}}
{{--},--}}
{{--});--}}
{{--}--}}
{{--});--}}
{{--function setCartPs() {--}}
{{--let products = [];--}}
{{--$('.add-to-cart').each(function () {--}}
{{--if (products.includes($(this).val())) {--}}
{{--$(this).val("added").removeClass("btn-outline-danger").addClass("btn-danger").html("<i class='bi-check-circle'></i> Goşuldy");--}}
{{--}--}}
{{--});--}}
{{--if (parseInt(0) > 0) {--}}
{{--$('#cart').removeClass('invisible').text(parseInt(0));--}}
{{--}--}}
{{--}--}}
{{--setCartPs();--}}
{{--</script>--}}
{{--</body>--}}
{{--</html>--}}
