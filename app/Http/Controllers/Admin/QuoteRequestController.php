<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\QuoteRequest;
use Illuminate\Http\Request;

class QuoteRequestController extends Controller
{

    public function index()
    {

        $quoteRequests = QuoteRequest::orderBy('id','desc')
            ->get();


        return view(
            'admin.quote-requests.index',
            compact('quoteRequests')
        );

    }




    public function update(Request $request, QuoteRequest $quoteRequest)
    {

        $quoteRequest->update([

            'status'=>$request->status

        ]);



        return redirect()

            ->route('admin.quote-requests.index')

            ->with(
                'success',
                'Teklif durumu güncellendi.'
            );

    }





    public function destroy(QuoteRequest $quoteRequest)
    {

        $quoteRequest->delete();


        return redirect()

            ->route('admin.quote-requests.index')

            ->with(
                'success',
                'Teklif silindi.'
            );

    }


}