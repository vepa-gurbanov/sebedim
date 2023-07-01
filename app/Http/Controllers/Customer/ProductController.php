<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request) {
        return view('customer.product.index');
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
