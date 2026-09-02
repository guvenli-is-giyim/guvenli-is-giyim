<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with([
            'category',
            'brand',
            'images'
        ])
        ->latest()
        ->paginate(15);

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::where('status',1)->get();

        $brands = Brand::where('status',1)->get();

        return view('admin.products.create',compact(
            'categories',
            'brands'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id'=>'required',
            'brand_id'=>'required',
            'name'=>'required|max:255',
            'sku'=>'required|unique:products',
            'images.*'=>'image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $product = Product::create([

            'category_id'=>$request->category_id,

            'brand_id'=>$request->brand_id,

            'name'=>$request->name,

            'slug'=>Str::slug($request->name),

            'sku'=>$request->sku,

            'barcode'=>$request->barcode,

            'short_description'=>$request->short_description,

            'description'=>$request->description,

            'featured'=>$request->has('featured'),

            'status'=>$request->has('status'),

        ]);

        if($request->hasFile('images')){

            foreach($request->file('images') as $image){

                $filename=time().'_'.uniqid().'.'.$image->getClientOriginalExtension();

                $image->move(
                    public_path('uploads/products'),
                    $filename
                );

                $product->images()->create([

                    'image'=>$filename,

                    'sort_order'=>0,

                ]);

            }

        }

        return redirect()
            ->route('admin.products.index')
            ->with('success','Ürün başarıyla eklendi.');
    }
        public function show(Product $product)
    {
        $product->load([
            'category',
            'brand',
            'images',
            'variants.color',
            'variants.size'
        ]);

        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::where('status',1)->get();

        $brands = Brand::where('status',1)->get();

        return view('admin.products.edit', compact(
            'product',
            'categories',
            'brands'
        ));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'category_id'=>'required',
            'brand_id'=>'required',
            'name'=>'required|max:255',
            'sku'=>'required|unique:products,sku,'.$product->id,
            'images.*'=>'image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $product->update([

            'category_id'=>$request->category_id,

            'brand_id'=>$request->brand_id,

            'name'=>$request->name,

            'slug'=>Str::slug($request->name),

            'sku'=>$request->sku,

            'barcode'=>$request->barcode,

            'short_description'=>$request->short_description,

            'description'=>$request->description,

            'featured'=>$request->has('featured'),

            'status'=>$request->has('status'),

        ]);

        if($request->hasFile('images')){

            foreach($request->file('images') as $image){

                $filename=time().'_'.uniqid().'.'.$image->getClientOriginalExtension();

                $image->move(
                    public_path('uploads/products'),
                    $filename
                );

                $product->images()->create([

                    'image'=>$filename,

                    'sort_order'=>0,

                ]);

            }

        }

        return redirect()
            ->route('admin.products.index')
            ->with('success','Ürün güncellendi.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with('success','Ürün silindi.');
    }
        public function variants(Product $product)
    {
        $product->load([
            'variants.color',
            'variants.size'
        ]);

        $colors = Color::orderBy('name')->get();
        $sizes  = Size::orderBy('sort_order')->get();

        return view('admin.products.variants', compact(
            'product',
            'colors',
            'sizes'
        ));
    }

    public function storeVariant(Request $request, Product $product)
    {
        $request->validate([
            'color_id' => 'required|exists:colors,id',
            'size_id'  => 'required|exists:sizes,id',
            'stock'    => 'required|integer|min:0',
            'price'    => 'required|numeric|min:0',
        ]);

        ProductVariant::create([
            'product_id' => $product->id,
            'color_id'   => $request->color_id,
            'size_id'    => $request->size_id,
            'stock'      => $request->stock,
            'price'      => $request->price,
        ]);

        return back()->with('success', 'Varyant eklendi.');
    }

    public function destroyVariant(ProductVariant $variant)
    {
        $product = $variant->product;

        $variant->delete();

        return redirect()
            ->route('admin.products.variants', $product)
            ->with('success', 'Varyant silindi.');
    }
}