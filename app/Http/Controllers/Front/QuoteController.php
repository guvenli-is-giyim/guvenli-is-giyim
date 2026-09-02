<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\QuoteRequest;
use Illuminate\Http\Request;

class QuoteController extends Controller
{

    public function create(Request $request)
    {

        $product = null;


        if($request->product){

            $product = Product::find($request->product);

        }



        return view(
            'front.quote.create',
            compact('product')
        );

    }





    public function store(Request $request)
    {


        $request->validate([

            'name'=>'required',

            'phone'=>'required',

            'email'=>'nullable|email',

            'message'=>'nullable',

        ]);




        QuoteRequest::create([

            'name'=>$request->name,

            'phone'=>$request->phone,

            'email'=>$request->email,

            'message'=>$request->message,

        ]);



        return redirect()

            ->route('home')

            ->with(
                'success',
                'Teklif talebiniz alındı.'
            );

    }


}