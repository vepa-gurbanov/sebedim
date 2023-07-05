<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request) {
        $orderConfig = config()->get('settings.ordering');
        $validation = $request->validate([
            'q' => ['nullable', 'string', 'max:50'],
            'f_min_price' => ['nullable', 'integer', 'min:0', 'max:f_max_price', 'between:0,f_max_price'],
            'f_max_price' => [
                'nullable',
                'integer',
                'min:f_min_price',
                'max:' . Product::orderByDesc('price')->first()->price,
                'between:f_min_price,' . Product::orderByDesc('price')->first()->price,
                'ordering' => 'nullable|string|in:' . implode(',', array_keys($orderConfig)),
            ],
        ]);


        $q = isset($validation['q']) ?: null;
        $f_min_price = isset($validation['f_min_price']) ? Product::orderByDesc('price')->first()->price : null;
        $f_max_price = isset($validation['f_max_price']) ? Product::orderByAsc('price')->first()->price : null;
        $f_order = isset($validation['ordering']) ?: null;

        $order = isset($f_order) ?  $orderConfig[$f_order] : null;
        $products = Product::orderByDesc('id')
            ->when($f_order, function ($query) use ($f_min_price, $f_max_price) {
                $query->whereBetween('price', [$f_min_price, $f_max_price]);
            })
            ->when($order, function ($query, $order) {
                return $query->orderBy($order[0], $order[1]);
            }, function ($query) {
                return $query->orderByDesc('id');
            })
            ->get();

//        return $products;
        $maxPrice = Product::orderByDesc('price')->first()->price;
        $searchCategories = Category::orderBy('id')
            ->get(['id', 'name']);

        $searchBrands = Brand::orderBy('id')
            ->get(['id', 'name']);

        $searchAttrs = Attribute::orderBy('order_by')
            ->orderBy('id')
            ->with('values:id,attribute_id,name', 'category:id,name')
            ->get(['id','category_id', 'name']);

//        return $searchAttrs;

        $data = [
            'f_min_price' => $f_min_price,
            'f_max_price' => $f_max_price,
            'maxPrice' => $maxPrice,
            'searchCategories' => $searchCategories,
            'searchBrands' => $searchBrands,
            'searchAttrs' => $searchAttrs,
        ];

        return view('customer.product.index')
            ->with($data);
    }


    public function create() {
        return view('customer.product.create');
    }


    public function store(Request $request) {
        return to_route('products');
    }


    public function show($slug) {
        $product = Product::where('slug', $slug)->firstOr(function () {
            $data = ['error' => 'Sorry, Something went wrong!'];
            return back()->with($data);
        });

        $data = [
            'product' => $product,
        ];
        return view('customer.product.show')
            ->with($data);
    }
}
