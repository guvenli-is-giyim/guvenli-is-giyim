<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class ShopController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | ÜRÜN LİSTESİ
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $products = Product::with([
            'category',
            'brand',
            'colors',
            'sizes',
            'variants.color',
            'variants.size',
        ])
            ->where('status', 1)
            ->latest()
            ->paginate(12);

        $categories = Category::where('status', 1)
            ->whereNull('parent_id')
            ->with('children')
            ->orderBy('name')
            ->get();

        return view(
            'front.shop.index',
            compact(
                'products',
                'categories'
            )
        );
    }

    /*
    |--------------------------------------------------------------------------
    | ÜRÜN DETAY
    |--------------------------------------------------------------------------
    */

    public function show(Product $product)
    {
        $product->load([
            'category',
            'brand',
            'colors',
            'sizes',
            'variants.color',
            'variants.size',
        ]);

        return view(
            'front.shop.show',
            compact('product')
        );
    }
}