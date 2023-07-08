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
            'f_min_price' => ['nullable', 'integer', 'min:0',],
            'f_max_price' => ['nullable', 'integer', 'max:' . Product::orderByDesc('price')->first()->price,],
            'ordering' => ['nullable', 'string', 'in:' . implode(',', array_keys($orderConfig)),],
            'b' => ['nullable','array'], // brands => b
            'b.*' => ['nullable','integer','min:1','distinct'], // brands[] => b.*
            'c' => ['nullable','array'], // categories => c
            'c.*' => ['nullable','integer','min:1','distinct'], // categories[] => c.*
            'v' => ['nullable', 'array'], // values => v
            'v.*' => ['nullable', 'array'], // values[] => v.*
            'v.*.*' => ['nullable', 'integer', 'min:1', 'distinct'], // values[][] => v.*.*
        ]);


        $q = isset($validation['q']) ?: null;
        $f_min_price = isset($validation['f_min_price']) ? $validation['f_min_price'] : null;
        $f_max_price = isset($validation['f_max_price']) ? $validation['f_max_price'] : null;
        $f_order = isset($validation['ordering']) ? $validation['ordering'] : null;
        $f_brands = $request->has('b') ? $request->b : [];
        $f_categories = $request->has('c') ? $request->c : [];
        $f_values = $request->has('v') ? $request->v : [];

        $price = [
            'min' => isset($f_min_price) ? $f_min_price : Product::orderByDesc('price')->first()->price,
            'max' => isset($f_max_price) ? $f_max_price : Product::orderBy('price')->first()->price,
        ];
//        return $price;
        $order = isset($f_order) ?  $orderConfig[$f_order] : null;

        $products = Product::when(($f_min_price or $f_max_price), function ($query) use ($price) {
                $query->whereBetween('price', [$price['min'], $price['max']]);
            })
            ->when($order, function ($query, $order) {
                return $query->orderBy($order[0], $order[1]);
            }, function ($query) {
                return $query->orderByDesc('id');
            })
            ->when($f_brands, function ($query, $f_brands) {
                return $query->whereIn('brand_id', $f_brands);
            })
            ->when($f_categories, function ($query, $f_categories) {
                return $query->whereIn('category_id', $f_categories);
            })
            ->when($f_values, function ($query, $f_values) {
                return $query->where(function ($query1) use ($f_values) {
                    foreach ($f_values as $f_value) {
                        $query1->whereHas('attributeValues', function ($query2) use ($f_value) {
                            $query2->whereIn('id', $f_value);
                        });
                    }
                });
            })
            ->orderByDesc('id')
            ->with('category', 'brand')
            ->paginate(18)
            ->withQueryString();

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

//        return $f_categories;

        $data = [
            'f_min_price' => $f_min_price,
            'f_max_price' => $f_max_price,
            'f_order' => $f_order,
            'f_categories' => collect($f_categories),
            'f_brands' => collect($f_brands),
            'f_values' => collect($f_values)->collapse(),
            'maxPrice' => $maxPrice,
            'searchCategories' => $searchCategories,
            'searchBrands' => $searchBrands,
            'searchAttrs' => $searchAttrs,
            'orderConfig' => $orderConfig,
            'products' => $products,
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
