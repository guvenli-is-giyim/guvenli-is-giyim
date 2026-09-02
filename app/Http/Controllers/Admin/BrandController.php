<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BrandController extends Controller
{

    public function index()
    {
        $brands = Brand::orderBy('id','desc')->get();

        return view('admin.brands.index', compact('brands'));
    }



    public function create()
    {
        return view('admin.brands.create');
    }



    public function store(Request $request)
    {

        $request->validate([

            'name'=>'required|max:255|unique:brands,name',

        ]);



        Brand::create([

            'name'=>$request->name,

            'slug'=>Str::slug($request->name),

            'status'=>$request->has('status'),

        ]);



        return redirect()

            ->route('admin.brands.index')

            ->with('success','Marka başarıyla eklendi.');

    }





    public function edit(Brand $brand)
    {
        return view('admin.brands.edit',compact('brand'));
    }





    public function update(Request $request, Brand $brand)
    {

        $request->validate([

            'name'=>'required|max:255|unique:brands,name,'.$brand->id,

        ]);



        $brand->update([

            'name'=>$request->name,

            'slug'=>Str::slug($request->name),

            'status'=>$request->has('status'),

        ]);



        return redirect()

            ->route('admin.brands.index')

            ->with('success','Marka güncellendi.');

    }





    public function destroy(Brand $brand)
    {

        $brand->delete();


        return redirect()

            ->route('admin.brands.index')

            ->with('success','Marka silindi.');

    }

}