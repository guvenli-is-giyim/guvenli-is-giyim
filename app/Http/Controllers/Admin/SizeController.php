<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{

    public function index()
    {
        $sizes = Size::orderBy('id','desc')->get();

        return view('admin.sizes.index',compact('sizes'));
    }



    public function create()
    {
        return view('admin.sizes.create');
    }




    public function store(Request $request)
    {

        $request->validate([

            'name'=>'required|max:255',

        ]);



        Size::create([

            'name'=>$request->name,

            'status'=>$request->has('status'),

        ]);



        return redirect()

            ->route('admin.sizes.index')

            ->with('success','Beden eklendi.');

    }




    public function edit(Size $size)
    {
        return view('admin.sizes.edit',compact('size'));
    }





    public function update(Request $request, Size $size)
    {

        $size->update([

            'name'=>$request->name,

            'status'=>$request->has('status'),

        ]);



        return redirect()

            ->route('admin.sizes.index')

            ->with('success','Beden güncellendi.');

    }





    public function destroy(Size $size)
    {

        $size->delete();


        return redirect()

            ->route('admin.sizes.index')

            ->with('success','Beden silindi.');

    }

}