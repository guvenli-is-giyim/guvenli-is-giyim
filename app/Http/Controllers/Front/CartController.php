<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        $subtotal = 0;

        foreach ($cart as $item) {
            $subtotal +=
                ($item['price'] ?? 0) *
                ($item['quantity'] ?? 1);
        }

        return view(
            'front.cart.index',
            compact('cart', 'subtotal')
        );
    }


    public function add(Request $request, $product)
    {
        $request->validate([
            'variant_id' => 'required|integer',
            'quantity' => 'required|integer|min:1',
        ]);


        $product = Product::findOrFail($product);

        $variant = ProductVariant::with([
            'color',
            'size',
        ])
        ->where('id', $request->variant_id)
        ->where('product_id', $product->id)
        ->first();


        if (!$variant) {

            return back()->with(
                'error',
                'Seçilen renk ve beden kombinasyonu bulunamadı.'
            );
        }


        if (!$variant->status) {

            return back()->with(
                'error',
                'Seçilen varyant satışa kapalı.'
            );
        }


        $quantity = (int) $request->quantity;


        if ($variant->stock <= 0) {

            return back()->with(
                'error',
                'Seçilen renk ve beden tükenmiştir.'
            );
        }


        if ($quantity > $variant->stock) {

            return back()->with(
                'error',
                'Yeterli stok bulunmuyor. Mevcut stok: ' .
                $variant->stock
            );
        }


        $cart = session()->get('cart', []);


        /*
        |--------------------------------------------------------------------------
        | AYNI VARYANTIN SEPET ANAHTARI
        |--------------------------------------------------------------------------
        */

        $cartKey = 'variant_' . $variant->id;


        /*
        |--------------------------------------------------------------------------
        | FİYAT
        |--------------------------------------------------------------------------
        */

        $price = $variant->sale_price !== null
            ? $variant->sale_price
            : (
                $variant->price !== null
                    ? $variant->price
                    : $product->price
            );


        /*
        |--------------------------------------------------------------------------
        | SEPETTE VARSA MİKTARI ARTIR
        |--------------------------------------------------------------------------
        */

        if (isset($cart[$cartKey])) {

            $newQuantity =
                $cart[$cartKey]['quantity'] +
                $quantity;


            if ($newQuantity > $variant->stock) {

                return back()->with(
                    'error',
                    'Sepetteki miktar varyant stok miktarını aşamaz. Mevcut stok: ' .
                    $variant->stock
                );
            }


            $cart[$cartKey]['quantity'] =
                $newQuantity;

        } else {

            $cart[$cartKey] = [

                'id' => $product->id,

                'variant_id' => $variant->id,

                'name' => $product->name,

                'price' => (float) $price,

                'quantity' => $quantity,

                'image' => $product->image,

                'color_id' => $variant->color_id,

                'color_name' =>
                    $variant->color
                        ? $variant->color->name
                        : null,

                'size_id' => $variant->size_id,

                'size_name' =>
                    $variant->size
                        ? $variant->size->name
                        : null,

            ];
        }


        session()->put(
            'cart',
            $cart
        );


        return redirect()
            ->route('cart.index')
            ->with(
                'success',
                'Ürün sepete eklendi.'
            );
    }


    public function update(
        Request $request,
        $product
    ) {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);


        $quantity =
            (int) $request->quantity;


        $cart =
            session()->get('cart', []);


        if (!isset($cart[$product])) {

            return back()->with(
                'error',
                'Ürün sepette bulunamadı.'
            );
        }


        $item =
            $cart[$product];


        /*
        |--------------------------------------------------------------------------
        | VARYANTLI ÜRÜN
        |--------------------------------------------------------------------------
        */

        if (!empty($item['variant_id'])) {

            $variant =
                ProductVariant::find(
                    $item['variant_id']
                );


            if (!$variant) {

                return back()->with(
                    'error',
                    'Ürün varyantı bulunamadı.'
                );
            }


            if (!$variant->status) {

                return back()->with(
                    'error',
                    'Bu varyant satışa kapalı.'
                );
            }


            if ($quantity > $variant->stock) {

                return back()->with(
                    'error',
                    'Yeterli stok bulunmuyor. Mevcut stok: ' .
                    $variant->stock
                );
            }

        } else {

            /*
            |--------------------------------------------------------------------------
            | ESKİ / VARYANTSIZ ÜRÜN
            |--------------------------------------------------------------------------
            */

            $productModel =
                Product::find(
                    $item['id']
                );


            if (!$productModel) {

                return back()->with(
                    'error',
                    'Ürün bulunamadı.'
                );
            }


            if ($quantity > $productModel->stock) {

                return back()->with(
                    'error',
                    'Yeterli stok bulunmuyor. Mevcut stok: ' .
                    $productModel->stock
                );
            }
        }


        $cart[$product]['quantity'] =
            $quantity;


        session()->put(
            'cart',
            $cart
        );


        return back()->with(
            'success',
            'Sepet güncellendi.'
        );
    }


    public function remove($product)
    {
        $cart =
            session()->get('cart', []);


        if (isset($cart[$product])) {

            unset(
                $cart[$product]
            );
        }


        session()->put(
            'cart',
            $cart
        );


        return back()->with(
            'success',
            'Ürün sepetten kaldırıldı.'
        );
    }


    public function clear()
    {
        session()->forget('cart');


        return back()->with(
            'success',
            'Sepet temizlendi.'
        );
    }
}