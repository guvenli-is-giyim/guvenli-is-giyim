@extends('admin.layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">

        <div>
            <h2 class="fw-bold mb-1">
                Ürün Düzenle
            </h2>

            <p class="text-muted mb-0">
                {{ $product->name }}
            </p>
        </div>

        <div class="d-flex gap-2 mt-3 mt-md-0">

            <a
                href="{{ route('admin.products.variants.index', $product) }}"
                class="btn btn-primary"
            >
                <i class="bi bi-grid-3x3-gap me-1"></i>
                Varyantlar
            </a>

            <a
                href="{{ route('admin.products.index') }}"
                class="btn btn-outline-secondary"
            >
                <i class="bi bi-arrow-left me-1"></i>
                Ürünlere Dön
            </a>

        </div>

    </div>


    {{-- HATALAR --}}

    @if($errors->any())

        <div class="alert alert-danger">

            <strong>
                Lütfen aşağıdaki hataları düzeltin:
            </strong>

            <ul class="mb-0 mt-2">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    <form
        action="{{ route('admin.products.update', $product) }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf
        @method('PUT')


        {{-- ====================================================== --}}
        {{-- ANA ÜRÜN --}}
        {{-- ====================================================== --}}

        <div class="card border-0 shadow-sm mb-4">

            <div class="card-header bg-white py-3">

                <h5 class="fw-bold mb-0">

                    <i class="bi bi-box-seam me-2 text-primary"></i>

                    Ürün Bilgileri

                </h5>

            </div>


            <div class="card-body">

                <div class="row g-4">


                    {{-- ÜRÜN ADI --}}

                    <div class="col-md-8">

                        <label class="form-label fw-semibold">
                            Ürün Adı
                            <span class="text-danger">*</span>
                        </label>

                        <input
                            type="text"
                            name="name"
                            class="form-control"
                            value="{{ old('name', $product->name) }}"
                            required
                        >

                    </div>


                    {{-- SKU --}}

                    <div class="col-md-4">

                        <label class="form-label fw-semibold">
                            SKU
                        </label>

                        <input
                            type="text"
                            name="sku"
                            class="form-control"
                            value="{{ old('sku', $product->sku) }}"
                            required
                        >

                    </div>


                    {{-- KATEGORİ --}}

                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Kategori
                            <span class="text-danger">*</span>
                        </label>

                        <select
                            name="category_id"
                            class="form-select"
                            required
                        >

                            <option value="">
                                Kategori Seçiniz
                            </option>

                            @foreach($categories as $category)

                                <option
                                    value="{{ $category->id }}"
                                    @selected(
                                        old(
                                            'category_id',
                                            $product->category_id
                                        ) == $category->id
                                    )
                                >
                                    {{ $category->name }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- MARKA --}}

                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Marka
                        </label>

                        <select
                            name="brand_id"
                            class="form-select"
                        >

                            <option value="">
                                Seçiniz
                            </option>

                            @foreach($brands as $brand)

                                <option
                                    value="{{ $brand->id }}"
                                    @selected(
                                        old(
                                            'brand_id',
                                            $product->brand_id
                                        ) == $brand->id
                                    )
                                >
                                    {{ $brand->name }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- FİYAT --}}

                    <div class="col-md-4">

                        <label class="form-label fw-semibold">
                            Fiyat
                        </label>

                        <div class="input-group">

                            <input
                                type="number"
                                name="price"
                                class="form-control"
                                value="{{ old('price', $product->price) }}"
                                min="0"
                                step="0.01"
                            >

                            <span class="input-group-text">
                                ₺
                            </span>

                        </div>

                    </div>


                    {{-- STOK --}}

                    <div class="col-md-4">

                        <label class="form-label fw-semibold">
                            Toplam Stok
                        </label>

                        <input
                            type="number"
                            name="stock"
                            class="form-control"
                            value="{{ old('stock', $product->stock) }}"
                            min="0"
                        >

                        @if($product->variants->count())

                            <div class="form-text text-primary">

                                Varyant stokları mevcut.
                                Toplam stok varyantlardan hesaplanır.

                            </div>

                        @else

                            <div class="form-text">

                                Henüz varyant oluşturulmadı.

                            </div>

                        @endif

                    </div>


                    {{-- BARKOD --}}

                    <div class="col-md-4">

                        <label class="form-label fw-semibold">
                            Barkod
                        </label>

                        <input
                            type="text"
                            name="barcode"
                            class="form-control"
                            value="{{ old('barcode', $product->barcode) }}"
                        >

                    </div>


                    {{-- KISA AÇIKLAMA --}}

                    <div class="col-12">

                        <label class="form-label fw-semibold">
                            Kısa Açıklama
                        </label>

                        <input
                            type="text"
                            name="short_description"
                            class="form-control"
                            value="{{ old(
                                'short_description',
                                $product->short_description
                            ) }}"
                            maxlength="500"
                        >

                    </div>


                    {{-- AÇIKLAMA --}}

                    <div class="col-12">

                        <label class="form-label fw-semibold">
                            Açıklama
                        </label>

                        <textarea
                            name="description"
                            rows="5"
                            class="form-control"
                        >{{ old('description', $product->description) }}</textarea>

                    </div>

                </div>

            </div>

        </div>


        {{-- ====================================================== --}}
        {{-- RENKLER --}}
        {{-- ====================================================== --}}

        <div class="card border-0 shadow-sm mb-4">

            <div class="card-header bg-white py-3">

                <h5 class="fw-bold mb-0">

                    <i class="bi bi-palette me-2 text-primary"></i>

                    Renkler

                </h5>

            </div>


            <div class="card-body">

                <p class="text-muted mb-3">

                    Üründe kullanılabilecek renkleri seçin.
                    Renk stokları varyantlar üzerinden tutulur.

                </p>


                @if($colors->count())

                    @php

                        $selectedColors = old(
                            'colors',
                            $product->colors
                                ->pluck('id')
                                ->toArray()
                        );

                    @endphp


                    <div class="row g-3">

                        @foreach($colors as $color)

                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">

                                <div class="form-check border rounded p-3">

                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        name="colors[]"
                                        value="{{ $color->id }}"
                                        id="color_{{ $color->id }}"
                                        @checked(
                                            in_array(
                                                $color->id,
                                                $selectedColors
                                            )
                                        )
                                    >

                                    <label
                                        class="form-check-label fw-semibold"
                                        for="color_{{ $color->id }}"
                                    >

                                        {{ $color->name }}

                                    </label>

                                </div>

                            </div>

                        @endforeach

                    </div>

                @else

                    <div class="alert alert-light border">

                        Henüz aktif renk bulunmuyor.

                        <a
                            href="{{ route('admin.colors.index') }}"
                            class="ms-2"
                        >
                            Renk Ekle
                        </a>

                    </div>

                @endif

            </div>

        </div>


        {{-- ====================================================== --}}
        {{-- BEDENLER --}}
        {{-- ====================================================== --}}

        <div class="card border-0 shadow-sm mb-4">

            <div class="card-header bg-white py-3">

                <h5 class="fw-bold mb-0">

                    <i class="bi bi-rulers me-2 text-primary"></i>

                    Bedenler

                </h5>

            </div>


            <div class="card-body">

                <p class="text-muted mb-3">

                    Üründe kullanılabilecek bedenleri seçin.
                    Beden stokları renk + beden varyantı üzerinden tutulur.

                </p>


                @if($sizes->count())

                    @php

                        $selectedSizes = old(
                            'sizes',
                            $product->sizes
                                ->pluck('id')
                                ->toArray()
                        );

                    @endphp


                    <div class="row g-3">

                        @foreach($sizes as $size)

                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">

                                <div class="form-check border rounded p-3">

                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        name="sizes[]"
                                        value="{{ $size->id }}"
                                        id="size_{{ $size->id }}"
                                        @checked(
                                            in_array(
                                                $size->id,
                                                $selectedSizes
                                            )
                                        )
                                    >

                                    <label
                                        class="form-check-label fw-semibold"
                                        for="size_{{ $size->id }}"
                                    >

                                        {{ $size->name }}

                                    </label>

                                </div>

                            </div>

                        @endforeach

                    </div>

                @else

                    <div class="alert alert-light border">

                        Henüz aktif beden bulunmuyor.

                        <a
                            href="{{ route('admin.sizes.index') }}"
                            class="ms-2"
                        >
                            Beden Ekle
                        </a>

                    </div>

                @endif

            </div>

        </div>


        {{-- ====================================================== --}}
        {{-- MEVCUT VARYANT ÖZETİ --}}
        {{-- ====================================================== --}}

        @if($product->variants->count())

            <div class="card border-0 shadow-sm mb-4">

                <div class="card-header bg-white py-3">

                    <h5 class="fw-bold mb-0">

                        <i class="bi bi-grid-3x3-gap me-2 text-primary"></i>

                        Mevcut Varyantlar

                    </h5>

                </div>


                <div class="card-body p-0">

                    <div class="table-responsive">

                        <table class="table table-bordered mb-0">

                            <thead>

                                <tr>

                                    <th>Renk</th>
                                    <th>Beden</th>
                                    <th>Stok</th>
                                    <th>Fiyat</th>
                                    <th>SKU</th>

                                </tr>

                            </thead>


                            <tbody>

                                @foreach($product->variants as $variant)

                                    <tr>

                                        <td>
                                            {{ $variant->color?->name ?? '-' }}
                                        </td>

                                        <td>
                                            {{ $variant->size?->name ?? '-' }}
                                        </td>

                                        <td>
                                            <strong>
                                                {{ $variant->stock }}
                                            </strong>
                                        </td>

                                        <td>

                                            @if($variant->price !== null)

                                                {{ number_format(
                                                    $variant->price,
                                                    2,
                                                    ',',
                                                    '.'
                                                ) }} ₺

                                            @else

                                                Ürün fiyatı

                                            @endif

                                        </td>

                                        <td>
                                            {{ $variant->sku }}
                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        @endif


        {{-- ====================================================== --}}
        {{-- GÖRSEL + DURUM --}}
        {{-- ====================================================== --}}

        <div class="row g-4 mb-4">


            {{-- GÖRSEL --}}

            <div class="col-lg-8">

                <div class="card border-0 shadow-sm h-100">

                    <div class="card-header bg-white py-3">

                        <h5 class="fw-bold mb-0">

                            <i class="bi bi-image me-2 text-primary"></i>

                            Ürün Görseli

                        </h5>

                    </div>


                    <div class="card-body">

                        @if($product->image)

                            <div class="mb-3">

                                <img
                                    src="{{ asset(
                                        'storage/' . $product->image
                                    ) }}"
                                    alt="{{ $product->name }}"
                                    style="
                                        max-width:180px;
                                        max-height:180px;
                                        object-fit:contain;
                                    "
                                    class="border rounded p-2"
                                >

                            </div>

                        @endif


                        <input
                            type="file"
                            name="image"
                            class="form-control"
                            accept=".jpg,.jpeg,.png,.webp"
                        >

                        <div class="form-text">

                            Yeni görsel seçerseniz mevcut görsel değiştirilir.

                        </div>

                    </div>

                </div>

            </div>


            {{-- DURUM --}}

            <div class="col-lg-4">

                <div class="card border-0 shadow-sm h-100">

                    <div class="card-header bg-white py-3">

                        <h5 class="fw-bold mb-0">

                            <i class="bi bi-toggle-on me-2 text-primary"></i>

                            Durum

                        </h5>

                    </div>


                    <div class="card-body">


                        <div class="form-check form-switch mb-3">

                            <input
                                class="form-check-input"
                                type="checkbox"
                                name="status"
                                id="status"
                                value="1"
                                @checked(
                                    old(
                                        'status',
                                        $product->status
                                    )
                                )
                            >

                            <label
                                class="form-check-label fw-semibold"
                                for="status"
                            >
                                Aktif
                            </label>

                        </div>


                        <div class="form-check form-switch">

                            <input
                                class="form-check-input"
                                type="checkbox"
                                name="featured"
                                id="featured"
                                value="1"
                                @checked(
                                    old(
                                        'featured',
                                        $product->featured
                                    )
                                )
                            >

                            <label
                                class="form-check-label fw-semibold"
                                for="featured"
                            >
                                Öne Çıkan Ürün
                            </label>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- ====================================================== --}}
        {{-- BUTONLAR --}}
        {{-- ====================================================== --}}

        <div class="d-flex justify-content-end gap-2 mb-5">

            <a
                href="{{ route('admin.products.index') }}"
                class="btn btn-outline-secondary px-4"
            >

                <i class="bi bi-x-lg me-1"></i>

                Vazgeç

            </a>


            <a
                href="{{ route(
                    'admin.products.variants.index',
                    $product
                ) }}"
                class="btn btn-primary px-4"
            >

                <i class="bi bi-grid-3x3-gap me-1"></i>

                Varyantları Yönet

            </a>


            <button
                type="submit"
                class="btn btn-success px-4"
            >

                <i class="bi bi-check-lg me-1"></i>

                Değişiklikleri Kaydet

            </button>

        </div>


    </form>

</div>

@endsection