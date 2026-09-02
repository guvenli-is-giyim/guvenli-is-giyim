<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'Sepetiniz boş.');
        }

        $total = 0;

        foreach ($cart as $item) {
            $total +=
                ($item['price'] ?? 0) *
                ($item['quantity'] ?? 1);
        }

        return view(
            'front.checkout.index',
            compact('cart', 'total')
        );
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'surname' => 'required|string|max:100',
            'phone' => 'required|string|max:30',
            'email' => 'required|email|max:150',
            'address' => 'required|string',
            'payment_method' => 'required|string',
        ]);


        $cart = session()->get('cart', []);


        if (empty($cart)) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'Sepetiniz boş.');
        }


        $order = null;


        DB::transaction(function () use (
            $request,
            $cart,
            &$order
        ) {

            $subtotal = 0;


            /*
            |--------------------------------------------------------------------------
            | TÜM ÜRÜNLERİ VE VARYANT STOKLARINI KONTROL ET
            |--------------------------------------------------------------------------
            */

            foreach ($cart as $item) {

                $quantity =
                    (int) ($item['quantity'] ?? 1);


                $product =
                    Product::find(
                        $item['id']
                    );


                if (!$product) {

                    throw new \RuntimeException(
                        'Sepette bulunan ürün artık mevcut değil.'
                    );
                }


                /*
                |--------------------------------------------------------------------------
                | VARYANTLI ÜRÜN
                |--------------------------------------------------------------------------
                */

                if (!empty($item['variant_id'])) {

                    $variant =
                        ProductVariant::with([
                            'color',
                            'size',
                        ])
                        ->lockForUpdate()
                        ->find(
                            $item['variant_id']
                        );


                    if (
                        !$variant ||
                        $variant->product_id != $product->id
                    ) {

                        throw new \RuntimeException(
                            $product->name .
                            ' için seçilen varyant bulunamadı.'
                        );
                    }


                    if (!$variant->status) {

                        throw new \RuntimeException(
                            $product->name .
                            ' için seçilen varyant satışa kapalı.'
                        );
                    }


                    if ($variant->stock < $quantity) {

                        $colorName =
                            $variant->color
                                ? $variant->color->name
                                : 'Renk belirtilmemiş';


                        $sizeName =
                            $variant->size
                                ? $variant->size->name
                                : 'Beden belirtilmemiş';


                        throw new \RuntimeException(
                            $product->name .
                            ' / ' .
                            $colorName .
                            ' / ' .
                            $sizeName .
                            ' için yeterli stok bulunmuyor.'
                        );
                    }


                    $price =
                        $variant->sale_price !== null
                            ? (float) $variant->sale_price
                            : (
                                $variant->price !== null
                                    ? (float) $variant->price
                                    : (float) $product->price
                            );

                } else {

                    /*
                    |--------------------------------------------------------------------------
                    | VARYANTSIZ ÜRÜN
                    |--------------------------------------------------------------------------
                    */

                    $product =
                        Product::lockForUpdate()
                            ->find($product->id);


                    if (!$product) {

                        throw new \RuntimeException(
                            'Ürün bulunamadı.'
                        );
                    }


                    if ($product->stock < $quantity) {

                        throw new \RuntimeException(
                            $product->name .
                            ' için yeterli stok bulunmuyor.'
                        );
                    }


                    $price =
                        (float) $product->price;
                }


                $subtotal +=
                    $price * $quantity;
            }


            /*
            |--------------------------------------------------------------------------
            | MÜŞTERİ
            |--------------------------------------------------------------------------
            */

            $customer = Customer::create([

                'name' =>
                    $request->name,

                'surname' =>
                    $request->surname,

                'phone' =>
                    $request->phone,

                'email' =>
                    $request->email,

                'password' =>
                    bcrypt('123456'),

                'address' =>
                    $request->address,

            ]);


            /*
            |--------------------------------------------------------------------------
            | SİPARİŞ
            |--------------------------------------------------------------------------
            */

            $order = Order::create([

                'customer_id' =>
                    $customer->id,

                'order_no' =>
                    'ORD-' .
                    strtoupper(
                        Str::random(8)
                    ),

                'subtotal' =>
                    $subtotal,

                'shipping' =>
                    0,

                'discount' =>
                    0,

                'total' =>
                    $subtotal,

                'status' =>
                    'pending',

                'payment_status' =>
                    'unpaid',

                'payment_method' =>
                    $request->payment_method,

                'note' =>
                    $request->note,

            ]);


            /*
            |--------------------------------------------------------------------------
            | SİPARİŞ ÜRÜNLERİ VE STOK DÜŞME
            |--------------------------------------------------------------------------
            */

            foreach ($cart as $item) {

                $quantity =
                    (int) ($item['quantity'] ?? 1);


                $product =
                    Product::find(
                        $item['id']
                    );


                if (!$product) {
                    continue;
                }


                if (!empty($item['variant_id'])) {

                    $variant =
                        ProductVariant::lockForUpdate()
                            ->find(
                                $item['variant_id']
                            );


                    if (!$variant) {

                        throw new \RuntimeException(
                            'Sipariş varyantı bulunamadı.'
                        );
                    }


                    $price =
                        $variant->sale_price !== null
                            ? (float) $variant->sale_price
                            : (
                                $variant->price !== null
                                    ? (float) $variant->price
                                    : (float) $product->price
                            );


                    $itemTotal =
                        $price * $quantity;


                    OrderItem::create([

                        'order_id' =>
                            $order->id,

                        'product_id' =>
                            $product->id,

                        'variant_id' =>
                            $variant->id,

                        'quantity' =>
                            $quantity,

                        'price' =>
                            $price,

                        'total' =>
                            $itemTotal,

                    ]);


                    /*
                    |--------------------------------------------------------------------------
                    | VARYANT STOĞUNU DÜŞ
                    |--------------------------------------------------------------------------
                    */

                    $variant->decrement(
                        'stock',
                        $quantity
                    );

                } else {

                    /*
                    |--------------------------------------------------------------------------
                    | VARYANTSIZ ÜRÜN
                    |--------------------------------------------------------------------------
                    */

                    $price =
                        (float) $product->price;


                    $itemTotal =
                        $price * $quantity;


                    OrderItem::create([

                        'order_id' =>
                            $order->id,

                        'product_id' =>
                            $product->id,

                        'variant_id' =>
                            null,

                        'quantity' =>
                            $quantity,

                        'price' =>
                            $price,

                        'total' =>
                            $itemTotal,

                    ]);


                    $product->decrement(
                        'stock',
                        $quantity
                    );
                }
            }
        });


        /*
        |--------------------------------------------------------------------------
        | SEPETİ TEMİZLE
        |--------------------------------------------------------------------------
        */

        session()->forget('cart');


        /*
        |--------------------------------------------------------------------------
        | BAŞARILI
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'checkout.success',
                $order->id
            );
    }


    public function success(Order $order)
    {
        $order->load([
            'customer',
            'items.product',
            'items.variant.color',
            'items.variant.size',
        ]);


        return view(
            'front.checkout.success',
            compact('order')
        );
    }
}