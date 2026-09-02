@extends('admin.layouts.app')

@section('content')

<div class="container-fluid">

    {{-- Sayfa Başlığı --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Yönetim Paneli</h2>
            <p class="text-muted mb-0">
                Güvenli İş Giyim yönetim paneline hoş geldiniz.
            </p>
        </div>

        <div class="mt-3 mt-md-0">
            <span class="badge bg-light text-dark border px-3 py-2">
                <i class="bi bi-calendar3 me-1"></i>
                {{ now()->format('d.m.Y') }}
            </span>
        </div>
    </div>


    {{-- ÖZET KARTLARI --}}
    <div class="row g-3 mb-4">

        {{-- Ürün --}}
        <div class="col-xl-2 col-md-4 col-sm-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">

                        <div>
                            <div class="text-muted small mb-2">
                                Ürün Sayısı
                            </div>

                            <div class="fs-3 fw-bold">
                                {{ $productCount }}
                            </div>
                        </div>

                        <div class="rounded-circle bg-primary bg-opacity-10 p-3">
                            <i class="bi bi-box-seam text-primary fs-4"></i>
                        </div>

                    </div>
                </div>
            </div>
        </div>


        {{-- Kategori --}}
        <div class="col-xl-2 col-md-4 col-sm-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">

                        <div>
                            <div class="text-muted small mb-2">
                                Kategori
                            </div>

                            <div class="fs-3 fw-bold">
                                {{ $categoryCount }}
                            </div>
                        </div>

                        <div class="rounded-circle bg-success bg-opacity-10 p-3">
                            <i class="bi bi-grid text-success fs-4"></i>
                        </div>

                    </div>
                </div>
            </div>
        </div>


        {{-- Marka --}}
        <div class="col-xl-2 col-md-4 col-sm-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">

                        <div>
                            <div class="text-muted small mb-2">
                                Marka
                            </div>

                            <div class="fs-3 fw-bold">
                                {{ $brandCount }}
                            </div>
                        </div>

                        <div class="rounded-circle bg-warning bg-opacity-10 p-3">
                            <i class="bi bi-tags text-warning fs-4"></i>
                        </div>

                    </div>
                </div>
            </div>
        </div>


        {{-- Müşteri --}}
        <div class="col-xl-2 col-md-4 col-sm-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">

                        <div>
                            <div class="text-muted small mb-2">
                                Müşteri
                            </div>

                            <div class="fs-3 fw-bold">
                                {{ $customerCount }}
                            </div>
                        </div>

                        <div class="rounded-circle bg-info bg-opacity-10 p-3">
                            <i class="bi bi-people text-info fs-4"></i>
                        </div>

                    </div>
                </div>
            </div>
        </div>


        {{-- Sipariş --}}
        <div class="col-xl-2 col-md-4 col-sm-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">

                        <div>
                            <div class="text-muted small mb-2">
                                Sipariş
                            </div>

                            <div class="fs-3 fw-bold">
                                {{ $orderCount }}
                            </div>
                        </div>

                        <div class="rounded-circle bg-danger bg-opacity-10 p-3">
                            <i class="bi bi-cart-check text-danger fs-4"></i>
                        </div>

                    </div>
                </div>
            </div>
        </div>


        {{-- Teklif --}}
        <div class="col-xl-2 col-md-4 col-sm-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">

                        <div>
                            <div class="text-muted small mb-2">
                                Teklif Talebi
                            </div>

                            <div class="fs-3 fw-bold">
                                {{ $quoteCount }}
                            </div>
                        </div>

                        <div class="rounded-circle bg-secondary bg-opacity-10 p-3">
                            <i class="bi bi-chat-left-text text-secondary fs-4"></i>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>


    {{-- DÜŞÜK STOK --}}
    <div class="card border-0 shadow-sm mb-4">

        <div class="card-body">

            <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">

                <div>
                    <h5 class="fw-bold mb-1">
                        <i class="bi bi-exclamation-triangle text-warning me-2"></i>
                        Düşük Stok Uyarısı
                    </h5>

                    <small class="text-muted">
                        Stok miktarı 5 ve altında olan ürünler
                    </small>
                </div>

                <a href="{{ route('admin.products.index') }}"
                   class="btn btn-sm btn-primary mt-2 mt-md-0">

                    <i class="bi bi-box-seam me-1"></i>
                    Ürünlere Git

                </a>

            </div>


            @if($lowStockProducts->count())

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead class="table-light">

                            <tr>

                                <th>Ürün</th>

                                <th>SKU</th>

                                <th>Stok</th>

                                <th>Durum</th>

                            </tr>

                        </thead>

                        <tbody>

                        @foreach($lowStockProducts as $product)

                            <tr>

                                <td>
                                    <strong>
                                        {{ $product->name }}
                                    </strong>
                                </td>

                                <td>
                                    <span class="text-muted">
                                        {{ $product->sku ?? '-' }}
                                    </span>
                                </td>

                                <td>

                                    <strong>
                                        {{ $product->stock ?? 0 }}
                                    </strong>

                                    adet

                                </td>

                                <td>

                                    @if(($product->stock ?? 0) <= 0)

                                        <span class="badge bg-danger">
                                            Stok Yok
                                        </span>

                                    @elseif(($product->stock ?? 0) <= 2)

                                        <span class="badge bg-danger">
                                            Kritik
                                        </span>

                                    @else

                                        <span class="badge bg-warning text-dark">
                                            Düşük Stok
                                        </span>

                                    @endif

                                </td>

                            </tr>

                        @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="alert alert-success mb-0">

                    <i class="bi bi-check-circle me-2"></i>

                    Düşük stoklu ürün bulunmuyor.

                </div>

            @endif

        </div>

    </div>


    {{-- ALT BÖLÜM --}}
    <div class="row g-4">


        {{-- SON ÜRÜNLER --}}
        <div class="col-xl-6">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-header bg-white border-0 pt-4 px-4">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <h5 class="fw-bold mb-1">
                                Son Eklenen Ürünler
                            </h5>

                            <small class="text-muted">
                                Sisteme en son eklenen ürünler
                            </small>

                        </div>

                        <i class="bi bi-box-seam fs-4 text-primary"></i>

                    </div>

                </div>


                <div class="card-body px-4">

                    @forelse($latestProducts as $product)

                        <div class="d-flex justify-content-between align-items-center border-bottom py-3">

                            <div>

                                <div class="fw-semibold">
                                    {{ $product->name }}
                                </div>

                                <small class="text-muted">
                                    SKU:
                                    {{ $product->sku ?? '-' }}
                                </small>

                            </div>


                            <div class="text-end">

                                <div class="fw-semibold">
                                    {{ $product->stock ?? 0 }}
                                </div>

                                <small class="text-muted">
                                    stok
                                </small>

                            </div>

                        </div>

                    @empty

                        <div class="text-muted py-3">

                            <i class="bi bi-info-circle me-2"></i>

                            Henüz ürün bulunmuyor.

                        </div>

                    @endforelse

                </div>

            </div>

        </div>


        {{-- SON TEKLİFLER --}}
        <div class="col-xl-6">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-header bg-white border-0 pt-4 px-4">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <h5 class="fw-bold mb-1">
                                Son Teklif Talepleri
                            </h5>

                            <small class="text-muted">
                                Son gelen teklif talepleri
                            </small>

                        </div>

                        <i class="bi bi-chat-left-text fs-4 text-primary"></i>

                    </div>

                </div>


                <div class="card-body px-4">

                    @forelse($latestQuotes as $quote)

                        <div class="border-bottom py-3">

                            <div class="d-flex justify-content-between align-items-center">

                                <div>

                                    <div class="fw-semibold">
                                        {{ $quote->name ?? 'İsimsiz' }}
                                    </div>

                                    @if(isset($quote->email))

                                        <small class="text-muted">
                                            {{ $quote->email }}
                                        </small>

                                    @endif

                                </div>

                                <div>

                                    <span class="badge bg-light text-dark border">
                                        Teklif
                                    </span>

                                </div>

                            </div>

                        </div>

                    @empty

                        <div class="text-muted py-3">

                            <i class="bi bi-info-circle me-2"></i>

                            Henüz teklif talebi bulunmuyor.

                        </div>

                    @endforelse

                </div>

            </div>

        </div>

    </div>


    {{-- ALT BİLGİ --}}
    <div class="text-center text-muted small py-4">

        Güvenli İş Giyim Yönetim Paneli

    </div>

</div>

@endsection