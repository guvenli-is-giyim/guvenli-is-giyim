<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with([
            'images',
            'brand',
            'category'
        ])->where('status',1);

        if($request->category){

            $query->where(
                'category_id',
                $request->category
            );

        }

        $products = $query->paginate(12);

        $categories = Category::where('status',1)->get();

        return view('front.shop.index', compact(
            'products',
            'categories'
        ));
    }
}