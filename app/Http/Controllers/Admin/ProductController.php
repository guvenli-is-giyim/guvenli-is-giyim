<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
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
            'variants.color',
            'variants.size',
        ])
        ->orderByDesc('id')
        ->get();

        return view(
            'admin.products.index',
            compact('products')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | YENİ ÜRÜN FORMU
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $categories = Category::where('status', 1)
            ->orderBy('name')
            ->get();

        $brands = Brand::where('status', 1)
            ->orderBy('name')
            ->get();

        $colors = Color::where('status', 1)
            ->orderBy('name')
            ->get();

        $sizes = Size::where('status', 1)
            ->orderBy('name')
            ->get();

        return view(
            'admin.products.create',
            compact(
                'categories',
                'brands',
                'colors',
                'sizes'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | ÜRÜN KAYDET
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $validated = $request->validate([

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'category_id' => [
                'required',
                'integer',
                'exists:categories,id',
            ],

            'brand_id' => [
                'nullable',
                'integer',
                'exists:brands,id',
            ],

            'sku' => [
                'nullable',
                'string',
                'max:255',
                'unique:products,sku',
            ],

            'barcode' => [
                'nullable',
                'string',
                'max:255',
            ],

            'price' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'stock' => [
                'nullable',
                'integer',
                'min:0',
            ],

            'short_description' => [
                'nullable',
                'string',
                'max:500',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:4096',
            ],

            'colors' => [
                'nullable',
                'array',
            ],

            'colors.*' => [
                'integer',
                'exists:colors,id',
            ],

            'sizes' => [
                'nullable',
                'array',
            ],

            'sizes.*' => [
                'integer',
                'exists:sizes,id',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | SKU
        |--------------------------------------------------------------------------
        */

        $sku = $request->filled('sku')
            ? $request->sku
            : $this->generateSku();


        /*
        |--------------------------------------------------------------------------
        | GÖRSEL
        |--------------------------------------------------------------------------
        */

        $image = null;

        if ($request->hasFile('image')) {

            $image = $request
                ->file('image')
                ->store('products', 'public');
        }


        /*
        |--------------------------------------------------------------------------
        | ÜRÜN
        |--------------------------------------------------------------------------
        */

        $product = Product::create([

            'category_id' =>
                $request->category_id,

            'brand_id' =>
                $request->brand_id,

            'name' =>
                $request->name,

            'slug' =>
                $this->generateSlug(
                    $request->name
                ),

            'sku' =>
                $sku,

            'barcode' =>
                $request->barcode,

            'short_description' =>
                $request->short_description,

            'description' =>
                $request->description,

            'price' =>
                $request->price ?? 0,

            /*
             * Yeni sistemde gerçek stok
             * varyantlardan hesaplanacak.
             *
             * Buradaki değer yalnızca
             * varyant oluşturulmadan önceki
             * ana ürün stok değeridir.
             */
            'stock' =>
                $request->stock ?? 0,

            'image' =>
                $image,

            'featured' =>
                $request->boolean('featured'),

            'status' =>
                $request->boolean('status'),
        ]);


        /*
        |--------------------------------------------------------------------------
        | RENKLER
        |--------------------------------------------------------------------------
        |
        | SADECE RENK İLİŞKİSİ KAYDEDİLİR.
        |
        | stock BURAYA YAZILMAZ.
        |
        | Stok artık product_variants tablosundadır.
        |
        */

        $product->colors()->sync(
            $request->input('colors', [])
        );


        /*
        |--------------------------------------------------------------------------
        | BEDENLER
        |--------------------------------------------------------------------------
        */

        $product->sizes()->sync(
            $request->input('sizes', [])
        );


        return redirect()
            ->route('admin.products.index')
            ->with(
                'success',
                'Ürün başarıyla eklendi.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | ÜRÜN DÜZENLE
    |--------------------------------------------------------------------------
    */

    public function edit(Product $product)
    {
        $product->load([
            'category',
            'brand',
            'colors',
            'sizes',
            'variants.color',
            'variants.size',
            'attributes',
        ]);


        $categories = Category::where('status', 1)
            ->orderBy('name')
            ->get();

        $brands = Brand::where('status', 1)
            ->orderBy('name')
            ->get();

        $colors = Color::where('status', 1)
            ->orderBy('name')
            ->get();

        $sizes = Size::where('status', 1)
            ->orderBy('name')
            ->get();


        return view(
            'admin.products.edit',
            compact(
                'product',
                'categories',
                'brands',
                'colors',
                'sizes'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | ÜRÜN GÜNCELLE
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        Product $product
    ) {
        $request->validate([

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'category_id' => [
                'required',
                'integer',
                'exists:categories,id',
            ],

            'brand_id' => [
                'nullable',
                'integer',
                'exists:brands,id',
            ],

            'sku' => [
                'required',
                'string',
                'max:255',
                'unique:products,sku,' . $product->id,
            ],

            'barcode' => [
                'nullable',
                'string',
                'max:255',
            ],

            'price' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            /*
             * Ana ürün stok alanı artık
             * varyant toplamından yönetilecek.
             */
            'stock' => [
                'nullable',
                'integer',
                'min:0',
            ],

            'short_description' => [
                'nullable',
                'string',
                'max:500',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:4096',
            ],

            'colors' => [
                'nullable',
                'array',
            ],

            'colors.*' => [
                'integer',
                'exists:colors,id',
            ],

            'sizes' => [
                'nullable',
                'array',
            ],

            'sizes.*' => [
                'integer',
                'exists:sizes,id',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | GÖRSEL
        |--------------------------------------------------------------------------
        */

        $image = $product->image;


        if ($request->hasFile('image')) {

            if (
                $product->image &&
                Storage::disk('public')
                    ->exists($product->image)
            ) {
                Storage::disk('public')
                    ->delete($product->image);
            }


            $image = $request
                ->file('image')
                ->store('products', 'public');
        }


        /*
        |--------------------------------------------------------------------------
        | ÜRÜNÜ GÜNCELLE
        |--------------------------------------------------------------------------
        */

        $product->update([

            'category_id' =>
                $request->category_id,

            'brand_id' =>
                $request->brand_id,

            'name' =>
                $request->name,

            'slug' =>
                $this->generateSlug(
                    $request->name,
                    $product->id
                ),

            'sku' =>
                $request->sku,

            'barcode' =>
                $request->barcode,

            'short_description' =>
                $request->short_description,

            'description' =>
                $request->description,

            'price' =>
                $request->price ?? 0,

            'image' =>
                $image,

            'featured' =>
                $request->boolean('featured'),

            'status' =>
                $request->boolean('status'),
        ]);


        /*
        |--------------------------------------------------------------------------
        | RENKLER
        |--------------------------------------------------------------------------
        |
        | BURADA stock KULLANILMAZ.
        |
        */

        $product->colors()->sync(
            $request->input('colors', [])
        );


        /*
        |--------------------------------------------------------------------------
        | BEDENLER
        |--------------------------------------------------------------------------
        */

        $product->sizes()->sync(
            $request->input('sizes', [])
        );


        /*
        |--------------------------------------------------------------------------
        | ANA ÜRÜN STOĞU
        |--------------------------------------------------------------------------
        |
        | Eğer varyant varsa:
        | toplam stok = tüm varyant stoklarının toplamı
        |
        */

        $variantStock =
            $product->variants()->sum('stock');


        if ($product->variants()->exists()) {

            $product->update([
                'stock' => $variantStock,
            ]);

        } else {

            $product->update([
                'stock' =>
                    $request->stock ?? 0,
            ]);
        }


        return redirect()
            ->route('admin.products.index')
            ->with(
                'success',
                'Ürün başarıyla güncellendi.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | ÜRÜN SİL
    |--------------------------------------------------------------------------
    */

    public function destroy(Product $product)
    {
        /*
        |--------------------------------------------------------------------------
        | GÖRSELİ SİL
        |--------------------------------------------------------------------------
        */

        if (
            $product->image &&
            Storage::disk('public')
                ->exists($product->image)
        ) {
            Storage::disk('public')
                ->delete($product->image);
        }


        /*
        |--------------------------------------------------------------------------
        | ÜRÜNÜ SİL
        |--------------------------------------------------------------------------
        |
        | product_variants migration'ında
        | cascadeOnDelete() olduğu için
        | varyantlar otomatik silinir.
        |
        */

        $product->delete();


        return redirect()
            ->route('admin.products.index')
            ->with(
                'success',
                'Ürün başarıyla silindi.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | SKU OLUŞTUR
    |--------------------------------------------------------------------------
    */

    private function generateSku(): string
    {
        do {

            $sku =
                'SKU-' .
                strtoupper(
                    Str::random(10)
                );

        } while (
            Product::where(
                'sku',
                $sku
            )->exists()
        );


        return $sku;
    }


    /*
    |--------------------------------------------------------------------------
    | SLUG OLUŞTUR
    |--------------------------------------------------------------------------
    */

    private function generateSlug(
        string $name,
        ?int $ignoreId = null
    ): string {

        $baseSlug =
            Str::slug($name);

        $slug =
            $baseSlug;

        $counter = 1;


        while (true) {

            $query =
                Product::where(
                    'slug',
                    $slug
                );


            if ($ignoreId) {

                $query->where(
                    'id',
                    '!=',
                    $ignoreId
                );
            }


            if (!$query->exists()) {
                break;
            }


            $slug =
                $baseSlug .
                '-' .
                $counter;

            $counter++;
        }


        return $slug;
    }
}