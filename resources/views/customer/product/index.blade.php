@extends('customer.layouts.app')
@section('content')
    <div class="d-flex justify-content-between">
        <div class="col-4 col-lg-3 col-xxl-2 my-3" data-bs-spy="scroll" data-bs-target="#scroll">

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

        <div class="col-auto my-2">
            <form action="{{ route('products.index') }}" class="row justify-content-between" method="GET" id="productFilter">

                <div class="col-auto">
                    <select class="form-select form-select-sm" name="ordering" id="ordering" size="1" onchange="$('form#productFilter').submit();">
                        <option value>@lang('app.relevance')</option>
                        @foreach(array_keys($orderConfig) as $ordering)
                            <option value="{{ $ordering }}" {{ $ordering == $f_order ? 'selected' : '' }}>
                                @lang('app.' . $ordering)
                            </option>
                        @endforeach
                    </select>
                </div>

            </form>

            <hr>
        </div>
    </div>
@endsection
