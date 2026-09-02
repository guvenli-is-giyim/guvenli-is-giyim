<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('customer')
            ->latest()
            ->paginate(20);

        return view(
            'admin.orders.index',
            compact('orders')
        );
    }


    public function show(Order $order)
    {
        $order->load([
            'customer',
            'items.product',
            'items.variant.color',
            'items.variant.size'
        ]);

        return view(
            'admin.orders.show',
            compact('order')
        );
    }


    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,shipped,completed,cancelled',
        ]);


        $newStatus = $request->status;

        $oldStatus = $order->status;


        /*
        |--------------------------------------------------------------------------
        | Sipariş iptal ediliyorsa stokları geri ekle
        |--------------------------------------------------------------------------
        */

        if (
            $newStatus === 'cancelled' &&
            $oldStatus !== 'cancelled'
        ) {

            DB::transaction(function () use ($order, $newStatus) {

                $order->load('items');

                foreach ($order->items as $item) {

                    $product = Product::find($item->product_id);

                    if ($product) {

                        $product->increment(
                            'stock',
                            $item->quantity
                        );

                    }
                }


                $order->update([
                    'status' => $newStatus
                ]);

            });

        } else {

            $order->update([
                'status' => $newStatus
            ]);

        }


        return back()->with(
            'success',
            'Sipariş durumu güncellendi.'
        );
    }


    public function destroy(Order $order)
    {
        $order->delete();

        return back()->with(
            'success',
            'Sipariş silindi.'
        );
    }
}