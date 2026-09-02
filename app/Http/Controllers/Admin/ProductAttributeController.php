<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductAttribute;
use Illuminate\Http\Request;

class ProductAttributeController extends Controller
{
    public function index(Product $product)
    {
        $attributes = $product->attributes;

        return view(
            'admin.products.attributes',
            compact('product','attributes')
        );
    }

    public function store(Request $request, Product $product)
    {
        $request->validate([
            'title'=>'required|max:255',
            'value'=>'required|max:255',
        ]);

        ProductAttribute::create([
            'product_id'=>$product->id,
            'title'=>$request->title,
            'value'=>$request->value,
            'sort_order'=>$request->sort_order ?? 0,
        ]);

        return back()->with('success','Özellik eklendi.');
    }

    public function destroy(ProductAttribute $attribute)
    {
        $attribute->delete();

        return back()->with('success','Silindi.');
    }
}