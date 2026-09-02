<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    /**
     * Banner listesi
     */
    public function index()
    {
        $banners = Banner::orderBy('sort_order', 'asc')
            ->orderBy('id', 'desc')
            ->paginate(15);

        return view('admin.banners.index', compact('banners'));
    }

    /**
     * Yeni banner ekleme sayfası
     */
    public function create()
    {
        return view('admin.banners.create');
    }

    /**
     * Yeni banner kaydet
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
            'button_text' => 'nullable|string|max:255',
            'button_link' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')
                ->store('banners', 'public');
        }

        $validated['status'] = $request->has('status');
        $validated['sort_order'] = $request->input('sort_order', 0);

        Banner::create($validated);

        return redirect()
            ->route('admin.banners.index')
            ->with('success', 'Banner başarıyla eklendi.');
    }

    /**
     * Banner düzenleme sayfası
     */
    public function edit(Banner $banner)
    {
        return view('admin.banners.edit', compact('banner'));
    }

    /**
     * Banner güncelle
     */
    public function update(Request $request, Banner $banner)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'button_text' => 'nullable|string|max:255',
            'button_link' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Yeni resim yüklendiyse eski resmi sil
        |--------------------------------------------------------------------------
        */
        if ($request->hasFile('image')) {

            if (
                $banner->image &&
                Storage::disk('public')->exists($banner->image)
            ) {
                Storage::disk('public')->delete($banner->image);
            }

            $validated['image'] = $request->file('image')
                ->store('banners', 'public');
        }

        $validated['status'] = $request->has('status');
        $validated['sort_order'] = $request->input('sort_order', 0);

        $banner->update($validated);

        return redirect()
            ->route('admin.banners.index')
            ->with('success', 'Banner başarıyla güncellendi.');
    }

    /**
     * Banner sil
     */
    public function destroy(Banner $banner)
    {
        if (
            $banner->image &&
            Storage::disk('public')->exists($banner->image)
        ) {
            Storage::disk('public')->delete($banner->image);
        }

        $banner->delete();

        return redirect()
            ->route('admin.banners.index')
            ->with('success', 'Banner başarıyla silindi.');
    }
}