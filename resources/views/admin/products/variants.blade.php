@extends('admin.layouts.app')

@section('content')

<div class="container-fluid">

    {{-- BAŞLIK --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">

        <div>

            <h2 class="fw-bold mb-1">
                {{ $product->name }} - Varyantlar
            </h2>

            <p class="text-muted mb-0">
                Her renk + beden kombinasyonu için ayrı stok belirleyin.
            </p>

        </div>

        <div class="d-flex gap-2">

            <a
                href="{{ route('admin.products.edit', $product) }}"
                class="btn btn-outline-secondary"
            >
                <i class="bi bi-arrow-left me-1"></i>
                Ürüne Dön
            </a>

        </div>

    </div>


    {{-- BAŞARI MESAJI --}}

    @if(session('success'))

        <div class="alert alert-success">
            <i class="bi bi-check-circle me-2"></i>
            {{ session('success') }}
        </div>

    @endif


    {{-- HATALAR --}}

    @if($errors->any())

        <div class="alert alert-danger">

            <strong>
                Lütfen hataları düzeltin:
            </strong>

            <ul class="mb-0 mt-2">

                @foreach($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- ========================================================== --}}
    {{-- YENİ VARYANT --}}
    {{-- ========================================================== --}}

    <div class="card border-0 shadow-sm mb-4">

        <div class="card-header bg-white py-3">

            <h5 class="fw-bold mb-0">

                <i class="bi bi-plus-circle me-2 text-primary"></i>

                Yeni Varyant Ekle

            </h5>

        </div>


        <div class="card-body">

            <form
                action="{{ route(
                    'admin.products.variants.store',
                    $product
                ) }}"
                method="POST"
            >

                @csrf


                <div class="row g-3">


                    {{-- RENK --}}

                    <div class="col-lg-3 col-md-6">

                        <label class="form-label fw-semibold">
                            Renk
                        </label>

                        <select
                            name="color_id"
                            class="form-select"
                        >

                            <option value="">
                                Renk Seçiniz
                            </option>

                            @foreach($colors as $color)

                                <option
                                    value="{{ $color->id }}"
                                    @selected(
                                        old('color_id') == $color->id
                                    )
                                >
                                    {{ $color->name }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- BEDEN --}}

                    <div class="col-lg-3 col-md-6">

                        <label class="form-label fw-semibold">
                            Beden
                        </label>

                        <select
                            name="size_id"
                            class="form-select"
                        >

                            <option value="">
                                Beden Seçiniz
                            </option>

                            @foreach($sizes as $size)

                                <option
                                    value="{{ $size->id }}"
                                    @selected(
                                        old('size_id') == $size->id
                                    )
                                >
                                    {{ $size->name }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- STOK --}}

                    <div class="col-lg-2 col-md-4">

                        <label class="form-label fw-semibold">
                            Stok
                        </label>

                        <input
                            type="number"
                            name="stock"
                            class="form-control"
                            value="{{ old('stock', 0) }}"
                            min="0"
                            required
                        >

                        <div class="form-text">
                            Bu kombinasyona ait adet.
                        </div>

                    </div>


                    {{-- FİYAT --}}

                    <div class="col-lg-2 col-md-4">

                        <label class="form-label fw-semibold">
                            Fiyat
                        </label>

                        <input
                            type="number"
                            name="price"
                            class="form-control"
                            value="{{ old('price') }}"
                            min="0"
                            step="0.01"
                        >

                        <div class="form-text">
                            Boşsa ana ürün fiyatı.
                        </div>

                    </div>


                    {{-- EKLE --}}

                    <div class="col-lg-2 col-md-4 d-flex align-items-end">

                        <button
                            type="submit"
                            class="btn btn-success w-100"
                        >

                            <i class="bi bi-plus-lg me-1"></i>

                            Varyant Ekle

                        </button>

                    </div>

                </div>


                {{-- GELİŞMİŞ ALANLAR --}}

                <div class="row g-3 mt-2">


                    {{-- BARKOD --}}

                    <div class="col-md-4">

                        <label class="form-label fw-semibold">
                            Barkod
                        </label>

                        <input
                            type="text"
                            name="barcode"
                            class="form-control"
                            value="{{ old('barcode') }}"
                        >

                    </div>


                    {{-- İNDİRİMLİ FİYAT --}}

                    <div class="col-md-4">

                        <label class="form-label fw-semibold">
                            İndirimli Fiyat
                        </label>

                        <input
                            type="number"
                            name="sale_price"
                            class="form-control"
                            value="{{ old('sale_price') }}"
                            min="0"
                            step="0.01"
                        >

                    </div>


                    {{-- DURUM --}}

                    <div class="col-md-4">

                        <label class="form-label fw-semibold d-block">
                            Durum
                        </label>

                        <div class="form-check form-switch mt-2">

                            <input
                                class="form-check-input"
                                type="checkbox"
                                name="status"
                                value="1"
                                id="variant_status"
                                @checked(old('status', true))
                            >

                            <label
                                class="form-check-label fw-semibold"
                                for="variant_status"
                            >
                                Aktif
                            </label>

                        </div>

                    </div>

                </div>

            </form>

        </div>

    </div>


    {{-- ========================================================== --}}
    {{-- VARYANTLAR --}}
    {{-- ========================================================== --}}

    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white py-3">

            <div class="d-flex justify-content-between align-items-center">

                <h5 class="fw-bold mb-0">

                    <i class="bi bi-grid-3x3-gap me-2 text-primary"></i>

                    Tanımlı Varyantlar

                </h5>


                <span class="badge bg-primary">

                    {{ $product->variants->count() }} varyant

                </span>

            </div>

        </div>


        <div class="card-body p-0">

            @if($product->variants->count())

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead class="table-light">

                            <tr>

                                <th class="px-3">
                                    Renk
                                </th>

                                <th>
                                    Beden
                                </th>

                                <th>
                                    Stok
                                </th>

                                <th>
                                    Fiyat
                                </th>

                                <th>
                                    İndirimli Fiyat
                                </th>

                                <th>
                                    SKU
                                </th>

                                <th>
                                    Durum
                                </th>

                                <th class="text-end px-3">
                                    İşlem
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @foreach($product->variants as $variant)

                                <tr>


                                    {{-- RENK --}}

                                    <td class="px-3">

                                        <strong>

                                            {{ $variant->color?->name ?? '-' }}

                                        </strong>

                                    </td>


                                    {{-- BEDEN --}}

                                    <td>

                                        {{ $variant->size?->name ?? '-' }}

                                    </td>


                                    {{-- STOK --}}

                                    <td>

                                        @if($variant->stock > 0)

                                            <span class="badge bg-success">

                                                {{ $variant->stock }} adet

                                            </span>

                                        @else

                                            <span class="badge bg-danger">

                                                Tükendi

                                            </span>

                                        @endif

                                    </td>


                                    {{-- FİYAT --}}

                                    <td>

                                        @if($variant->price !== null)

                                            {{ number_format(
                                                $variant->price,
                                                2,
                                                ',',
                                                '.'
                                            ) }}

                                            ₺

                                        @else

                                            {{ number_format(
                                                $product->price,
                                                2,
                                                ',',
                                                '.'
                                            ) }}

                                            ₺

                                        @endif

                                    </td>


                                    {{-- İNDİRİMLİ FİYAT --}}

                                    <td>

                                        @if($variant->sale_price !== null)

                                            {{ number_format(
                                                $variant->sale_price,
                                                2,
                                                ',',
                                                '.'
                                            ) }}

                                            ₺

                                        @else

                                            -

                                        @endif

                                    </td>


                                    {{-- SKU --}}

                                    <td>

                                        <code>
                                            {{ $variant->sku }}
                                        </code>

                                    </td>


                                    {{-- DURUM --}}

                                    <td>

                                        @if($variant->status)

                                            <span class="badge bg-success">
                                                Aktif
                                            </span>

                                        @else

                                            <span class="badge bg-secondary">
                                                Pasif
                                            </span>

                                        @endif

                                    </td>


                                    {{-- SİL --}}

                                    <td class="text-end px-3">

                                        <form
                                            action="{{ route(
                                                'admin.products.variants.destroy',
                                                $variant
                                            ) }}"
                                            method="POST"
                                            onsubmit="return confirm(
                                                'Bu varyantı silmek istediğinize emin misiniz?'
                                            );"
                                        >

                                            @csrf

                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn btn-sm btn-outline-danger"
                                            >

                                                <i class="bi bi-trash"></i>

                                                Sil

                                            </button>

                                        </form>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="text-center py-5">

                    <i
                        class="bi bi-box-seam fs-1 text-muted"
                    ></i>

                    <h5 class="mt-3">
                        Henüz varyant oluşturulmadı.
                    </h5>

                    <p class="text-muted mb-0">

                        Yukarıdaki formdan renk + beden
                        kombinasyonu ekleyebilirsiniz.

                    </p>

                </div>

            @endif

        </div>

    </div>


    {{-- ========================================================== --}}
    {{-- BİLGİ --}}
    {{-- ========================================================== --}}

    <div class="alert alert-info mt-4">

        <i class="bi bi-info-circle me-2"></i>

        <strong>Stok mantığı:</strong>

        Her renk + beden kombinasyonunun stoğu ayrı tutulur.

        Örneğin:

        <strong>Siyah / M = 100</strong>,

        <strong>Beyaz / M = 50</strong>.

        Ana ürün stoğu bu varyantların toplamı olarak hesaplanır.

    </div>

</div>

@endsection