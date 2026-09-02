<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::orderBy('id','desc')->get();

        return view('admin.categories.index', compact('categories'));
    }


    public function create()
    {
        return view('admin.categories.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|max:255|unique:categories,name',
            'description'=>'nullable|max:1000',
        ]);


        Category::create([

            'name'=>$request->name,

            'slug'=>Str::slug($request->name),

            'description'=>$request->description,

            'status'=>$request->has('status'),

        ]);


        return redirect()
            ->route('admin.categories.index')
            ->with('success','Kategori başarıyla eklendi.');
    }



    public function edit(Category $category)
    {
        return view('admin.categories.edit',compact('category'));
    }



    public function update(Request $request, Category $category)
    {

        $request->validate([
            'name'=>'required|max:255|unique:categories,name,'.$category->id,
            'description'=>'nullable|max:1000',
        ]);


        $category->update([

            'name'=>$request->name,

            'slug'=>Str::slug($request->name),

            'description'=>$request->description,

            'status'=>$request->has('status'),

        ]);


        return redirect()
            ->route('admin.categories.index')
            ->with('success','Kategori güncellendi.');
    }



    public function destroy(Category $category)
    {

        $category->delete();


        return redirect()
            ->route('admin.categories.index')
            ->with('success','Kategori silindi.');

    }

}