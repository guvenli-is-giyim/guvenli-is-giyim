<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $banners = Banner::where('status', 1)
            ->orderBy('sort_order')
            ->get();

        $categories = Category::where('status', 1)
            ->orderBy('name')
            ->get();

        $featuredProducts = Product::where('status', 1)
            ->where('featured', 1)
            ->with(['brand', 'category'])
            ->latest()
            ->take(8)
            ->get();

        return view('front.home', compact(
            'banners',
            'categories',
            'featuredProducts'
        ));
    }
}