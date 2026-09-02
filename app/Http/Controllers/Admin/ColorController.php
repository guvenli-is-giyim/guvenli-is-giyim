<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ColorController extends Controller
{

    public function index()
    {
        $colors = Color::orderBy('id','desc')->get();

        return view('admin.colors.index',compact('colors'));
    }



    public function create()
    {
        return view('admin.colors.create');
    }



    public function store(Request $request)
    {

        $request->validate([

            'name'=>'required|max:255',

        ]);



        Color::create([

            'name'=>$request->name,

            'code'=>$request->code,

            'status'=>$request->has('status'),

        ]);



        return redirect()

            ->route('admin.colors.index')

            ->with('success','Renk eklendi.');

    }





    public function edit(Color $color)
    {
        return view('admin.colors.edit',compact('color'));
    }





    public function update(Request $request, Color $color)
    {

        $color->update([

            'name'=>$request->name,

            'code'=>$request->code,

            'status'=>$request->has('status'),

        ]);



        return redirect()

            ->route('admin.colors.index')

            ->with('success','Renk güncellendi.');

    }





    public function destroy(Color $color)
    {

        $color->delete();


        return redirect()

            ->route('admin.colors.index')

            ->with('success','Renk silindi.');

    }

}