<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::with([
            'images',
            'brand',
            'category'
        ])
        ->where('status', 1)
        ->where('featured', 1)
        ->take(8)
        ->get();

        $categories = Category::where('status', 1)->get();

        return view('front.home', compact(
            'featuredProducts',
            'categories'
        ));
    }
}