@extends('admin.layouts.app')

@section('content')

<div class="container-fluid">

    {{-- Sayfa Başlığı --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">

        <div>
            <h2 class="fw-bold mb-1">
                Ürünler
            </h2>

            <p class="text-muted mb-0">
                Mağazanızdaki ürünleri yönetin.
            </p>
        </div>

        <a href="{{ route('admin.products.create') }}"
           class="btn btn-primary mt-3 mt-md-0">

            <i class="bi bi-plus-lg me-1"></i>

            Yeni Ürün

        </a>

    </div>


    {{-- Mesajlar --}}
    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show" role="alert">

            <i class="bi bi-check-circle me-2"></i>

            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    @if(session('error'))

        <div class="alert alert-danger alert-dismissible fade show" role="alert">

            <i class="bi bi-exclamation-triangle me-2"></i>

            {{ session('error') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    {{-- Ürün Tablosu --}}
    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">

                        <tr>

                            <th style="width: 70px;">
                                ID
                            </th>

                            <th style="width: 90px;">
                                Görsel
                            </th>

                            <th>
                                Ürün
                            </th>

                            <th>
                                SKU
                            </th>

                            <th>
                                Kategori
                            </th>

                            <th>
                                Fiyat
                            </th>

                            <th>
                                Stok
                            </th>

                            <th>
                                Durum
                            </th>

                            <th style="width: 160px;">
                                İşlem
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                    @forelse($products as $product)

                        <tr>

                            {{-- ID --}}
                            <td>

                                <span class="text-muted">
                                    #{{ $product->id }}
                                </span>

                            </td>


                            {{-- GÖRSEL --}}
                            <td>

                                @if($product->image)

                                    <img
                                        src="{{ asset('storage/' . $product->image) }}"
                                        alt="{{ $product->name }}"
                                        style="
                                            width:60px;
                                            height:60px;
                                            object-fit:cover;
                                            border-radius:8px;
                                            border:1px solid #dee2e6;
                                        "
                                    >

                                @else

                                    <div
                                        class="d-flex align-items-center justify-content-center bg-light"
                                        style="
                                            width:60px;
                                            height:60px;
                                            border-radius:8px;
                                            border:1px solid #dee2e6;
                                        "
                                    >

                                        <i class="bi bi-image text-muted fs-4"></i>

                                    </div>

                                @endif

                            </td>


                            {{-- ÜRÜN --}}
                            <td>

                                <div class="fw-semibold">
                                    {{ $product->name }}
                                </div>

                                @if($product->description)

                                    <small class="text-muted">

                                        {{ \Illuminate\Support\Str::limit($product->description, 50) }}

                                    </small>

                                @endif

                            </td>


                            {{-- SKU --}}
                            <td>

                                <span class="badge bg-light text-dark border">

                                    {{ $product->sku ?? '-' }}

                                </span>

                            </td>


                            {{-- KATEGORİ --}}
                            <td>

                                {{ $product->category->name ?? '-' }}

                            </td>


                            {{-- FİYAT --}}
                            <td>

                                @if(isset($product->price))

                                    <strong>
                                        {{ number_format($product->price, 2, ',', '.') }}
                                    </strong>

                                    <span class="text-muted">
                                        ₺
                                    </span>

                                @else

                                    <span class="text-muted">
                                        -
                                    </span>

                                @endif

                            </td>


                            {{-- STOK --}}
                            <td>

                                @php
                                    $stock = $product->stock ?? 0;
                                @endphp


                                @if($stock <= 0)

                                    <span class="badge bg-danger">

                                        <i class="bi bi-x-circle me-1"></i>

                                        Stok Yok

                                    </span>

                                @elseif($stock <= 5)

                                    <span class="badge bg-warning text-dark">

                                        <i class="bi bi-exclamation-triangle me-1"></i>

                                        {{ $stock }} adet

                                    </span>

                                @else

                                    <span class="badge bg-success">

                                        <i class="bi bi-check-circle me-1"></i>

                                        {{ $stock }} adet

                                    </span>

                                @endif

                            </td>


                            {{-- DURUM --}}
                            <td>

                                @if($product->status)

                                    <span class="badge bg-success">

                                        <i class="bi bi-check-circle me-1"></i>

                                        Aktif

                                    </span>

                                @else

                                    <span class="badge bg-secondary">

                                        <i class="bi bi-pause-circle me-1"></i>

                                        Pasif

                                    </span>

                                @endif

                            </td>


                            {{-- İŞLEMLER --}}
                            <td>

                                <div class="d-flex gap-1">

                                    <a
                                        href="{{ route('admin.products.edit', $product) }}"
                                        class="btn btn-warning btn-sm"
                                        title="Düzenle"
                                    >

                                        <i class="bi bi-pencil"></i>

                                    </a>


                                    <form
                                        action="{{ route('admin.products.destroy', $product) }}"
                                        method="POST"
                                        onsubmit="return confirm('Bu ürünü silmek istediğinizden emin misiniz?');"
                                    >

                                        @csrf

                                        @method('DELETE')

                                  <button
    type="submit"
    class="btn btn-danger btn-sm"
    onclick="return confirm('Bu ürünü silmek istediğinizden emin misiniz?');">

    Sil

</button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="9">

                                <div class="text-center py-5">

                                    <div class="mb-3">

                                        <i class="bi bi-box-seam text-muted"
                                           style="font-size:50px;">
                                        </i>

                                    </div>

                                    <h5 class="fw-semibold">
                                        Henüz ürün bulunmuyor
                                    </h5>

                                    <p class="text-muted mb-3">
                                        Mağazanıza ilk ürününüzü ekleyebilirsiniz.
                                    </p>

                                    <a
                                        href="{{ route('admin.products.create') }}"
                                        class="btn btn-primary"
                                    >

                                        <i class="bi bi-plus-lg me-1"></i>

                                        İlk Ürünü Ekle

                                    </a>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection