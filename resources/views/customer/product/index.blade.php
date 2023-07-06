@extends('customer.layouts.app')
@section('breadcrumb')
    <li class="breadcrumb-item">
        <a class="" href="#">Library</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">Data</li>
@endsection
@section('content')
    <div class="d-flex justify-content-between">
        <div class="col-4 col-lg-3 col-xxl-2" data-bs-spy="scroll" data-bs-target="#scroll">

            <!-- Start filter scroll -->
            <div class="scrollbar px-2" id="scrollbar">

                <!-- Start filter/price scroll -->
                <div class="bg-white border rounded p-2 mb-3">
                    <div class="d-flex justify-content-between cursor-pointer" data-bs-toggle="collapse" data-bs-target="#collapsePrice" aria-expanded="false" aria-controls="collapsePrice">
                        <span class="small"><b>Price</b></span>
                        <span class="bi-caret-down-fill"></span>
                    </div>
                    <div class="collapse show" id="collapsePrice">
                        <div class="d-flex justify-content-between mt-2">
                            <input type="text" class="form-control form-control-sm w-25 bg-light-subtle" name="f_min_price" id="f_min_price" placeholder="{{ '0' }}" value="{{ old('f_min_price') }}">
                            -
                            <input type="text" class="form-control form-control-sm w-25 bg-light-subtle" name="f_max_price" id="f_max_price" placeholder="{{ $maxPrice }}" value="{{ old('f_max_price') }}">
                            <span class="bi-search"></span>
                        </div>
                    </div>
                </div> <!-- End filter/price scroll -->

                <!-- Start filter/Category scroll -->
                <div class="bg-white border rounded p-2 mb-3">
                    <div class="d-flex justify-content-between cursor-pointer" data-bs-toggle="collapse" data-bs-target="#collapseCategory" aria-expanded="false" aria-controls="collapseCategory">
                        <span class="small"><b>Categories</b></span>
                        <span class="bi-caret-down-fill"></span>
                    </div>
                    <div class="collapse show" id="collapseCategory">
                        <div class="mt-2">
                            <input type="text" class="form-control form-control-sm bg-light-subtle" id="search_category" placeholder="..." value="{{ old('search_category') }}">
                        </div>
                        <div class="mt-3 scrollbar" id="categoryScroll" content="category">
                            @foreach($searchCategories as $category)
                                <div class="form-check ms-2 small">
                                    <input class="form-check-input" type="checkbox" value="{{ $category->id }}" id="check-{{ $category->id }}">
                                    <label class="form-check-label" for="check-{{ $category->id }}">
                                        {{ $category->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div> <!-- End filter/Category scroll -->

                <!-- Start filter/Brand scroll -->
                <div class="bg-white border rounded p-2 mb-3">
                    <div class="d-flex justify-content-between cursor-pointer" data-bs-toggle="collapse" data-bs-target="#collapseBrand" aria-expanded="false" aria-controls="collapseBrand">
                        <span class="small"><b>Brands</b></span>
                        <span class="bi-caret-down-fill"></span>
                    </div>
                    <div class="collapse show" id="collapseBrand">
                        <div class="mt-2">
                            <input type="text" class="form-control form-control-sm bg-light-subtle" id="search_brand" placeholder="..." value="{{ old('search_brand') }}">
                        </div>
                        <div class="mt-3 scrollbar" id="brandScroll" content="brand">
                            @foreach($searchBrands as $brand)
                                <div class="form-check ms-2 small">
                                    <input class="form-check-input" type="checkbox" value="{{ $brand->id }}" id="check-{{ $brand->id }}">
                                    <label class="form-check-label" for="check-{{ $brand->id }}">
                                        {{ $brand->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div> <!-- End filter/Brand scroll -->

            @foreach($searchAttrs as $attr)
                <!-- Start filter/{{ $attr->category->name . '/' . $attr->name }} scroll -->
                    <?php $attrSlugged = Illuminate\Support\Str::slug($attr->category->name . '_' . $attr->name, '_') ?>
                    <div class="bg-white border rounded p-2 {{ ! $loop->last ? 'mb-3' : '' }} small">
                        <div class="d-flex justify-content-between cursor-pointer" data-bs-toggle="collapse" data-bs-target="#collapse{{ $attrSlugged }}" aria-expanded="false" aria-controls="collapse{{ $attrSlugged }}">
                            <span><b>{{ $attr->category->name }}</b>{{ '/' . $attr->name }}</span>
                            <span class="bi-caret-down-fill"></span>
                        </div>
                        <div class="collapse show" id="collapse{{ $attrSlugged }}">
                            <div class="mt-2">
                                <input type="text" class="form-control form-control-sm bg-light-subtle" id="search_{{ $attrSlugged }}" placeholder="..." value="{{ old('search_' . $attrSlugged) }}">
                            </div>
                            <div class="mt-3 scrollbar" id="{{ $attrSlugged }}Scroll" content="{{ $attrSlugged }}">
                                @foreach($attr->values as $value)
                                    <div class="form-check ms-2">
                                        <input class="form-check-input" type="checkbox" value="{{ $value->id }}" id="check-{{ $attr->id . '-' . $value->id }}">
                                        <label class="form-check-label" for="check-{{ $attr->id . '-' . $value->id }}">
                                            {{ $value->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div> <!-- End filter/{{ $attr->category->name . '/' . $attr->name }} scroll -->
                @endforeach

            </div> <!-- End filter scroll -->
        </div>

        <div class="col-10 col-lg-11 col-xxl-12">
            <div class="border-bottom pb-2 ms-2" style="--bs-border-color: orange!important">
                <div class="row justify-content-around">
                    <form action="{{ route('products.index') }}" method="GET" id="productFilter">
                    </form>
                    @foreach(array_keys($orderConfig) as $ordering)
                        <div class="col-auto product-border ms-2 {{ $ordering == $f_order ? 'product_link_is_active' : '' }}">
                            <a href="{{ route('products.index', ['ordering' => $ordering]) }}"
                               class="product_link {{ $ordering == $f_order ? 'fw-bold' : '' }}"
                               onclick="$('form#productFilter').submit();">
                                @lang('app.' . $ordering)
                            </a>
                        </div>
                    @endforeach

                </div>
            </div>
            <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 row-cols-xl-6 g-4">
                @foreach($products as $product)
                    <div class="col">
                        <div class="overflow-hidden rounded shadow-sm hover-effect position-relative">
                            @if($product->isNew())
                                <span class="position-absolute top-0 start-0 m-1 z-1">
                                    <span class="badge bg-success-subtle text-success-emphasis">Täze</span>
                                </span>
                            @endif
                            <span class="position-absolute bottom-0 end-0 m-1 z-1">
                                <a class="btn btn-light btn-sm" data-fancybox="gallery" href="/storage/pr/EuJtAZR1UP.jpg" data-caption="Человек-бензопила. Книга 4. Во сне. Настоящая жесть">
                                    <i class="bi-zoom-in"></i>
                                </a>
                            </span>
                            <a href="https://gnbookstore.com.tm/product/celovek-benzopila-kniga-4-vo-sne-nastoiashhaia-zest-3596">
                                <img src="/storage/sm/pr/EuJtAZR1UP.jpg" data-src="/storage/sm/pr/EuJtAZR1UP.jpg" alt="Человек-бензопила. Книга 4. Во сне. Настоящая жесть" class="temp-image img-fluid">
                            </a>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <div class="h6 text-primary mb-0">
                                555.00
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
        </div>
    </div>
@endsection
