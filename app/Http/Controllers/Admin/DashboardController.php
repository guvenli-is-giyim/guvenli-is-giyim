<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\QuoteRequest;
use App\Models\Customer;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        $productCount = Product::count();

        $categoryCount = Category::count();

        $brandCount = Brand::count();

        $quoteCount = QuoteRequest::count();

        $customerCount = Customer::count();

        $orderCount = Order::count();

        $lowStockProducts = Product::where('stock', '<=', 5)
            ->orderBy('stock', 'asc')
            ->take(10)
            ->get();

        $latestProducts = Product::latest()
            ->take(5)
            ->get();

        $latestQuotes = QuoteRequest::latest()
            ->take(5)
            ->get();

        return view(
            'admin.dashboard.index',
            compact(
                'productCount',
                'categoryCount',
                'brandCount',
                'quoteCount',
                'customerCount',
                'orderCount',
                'lowStockProducts',
                'latestProducts',
                'latestQuotes'
            )
        );
    }
}