<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | ÜRÜNLER
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $products = Product::with([
            'category',
            'brand',
            'variants.color',
            'variants.size',
        ])
        ->where('status', true)
        ->orderBy('id', 'desc')
        ->paginate(12);

        return view(
            'front.shop.index',
            compact('products')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | ÜRÜN DETAY
    |--------------------------------------------------------------------------
    */

    public function show(Product $product)
    {
        abort_unless(
            $product->status,
            404
        );

        $product->load([
            'category',
            'brand',
            'colors',
            'sizes',
            'variants.color',
            'variants.size',
            'attributes',
        ]);

        return view(
            'front.shop.show',
            compact('product')
        );
    }
}