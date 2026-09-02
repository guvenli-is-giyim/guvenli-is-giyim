@extends('front.layouts.app')

@section('content')

<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h1 class="fw-bold mb-1">
                Sepetim
            </h1>

            <p class="text-muted mb-0">
                Sepetinizdeki ürünleri kontrol edin.
            </p>
        </div>

        <a
            href="{{ route('shop') }}"
            class="btn btn-outline-secondary"
        >
            <i class="bi bi-arrow-left me-1"></i>
            Alışverişe Devam Et
        </a>

    </div>


    {{-- MESAJLAR --}}
    @if(session('success'))

        <div class="alert alert-success">
            {{ session('success') }}
        </div>

    @endif


    @if(session('error'))

        <div class="alert alert-danger">
            {{ session('error') }}
        </div>

    @endif


    {{-- SEPET BOŞ --}}
    @if(empty($cart))

        <div class="card border-0 shadow-sm">

            <div class="card-body text-center py-5">

                <i
                    class="bi bi-cart-x text-muted"
                    style="font-size:70px;"
                ></i>

                <h3 class="fw-bold mt-3">
                    Sepetiniz boş
                </h3>

                <p class="text-muted">
                    Henüz sepetinize ürün eklemediniz.
                </p>

                <a
                    href="{{ route('shop') }}"
                    class="btn btn-success px-4"
                >
                    Ürünleri İncele
                </a>

            </div>

        </div>

    @else

        <div class="row g-4">

            {{-- SEPET ÜRÜNLERİ --}}
            <div class="col-lg-8">

                <div class="card border-0 shadow-sm">

                    <div class="card-header bg-white py-3">

                        <h5 class="fw-bold mb-0">
                            <i class="bi bi-bag me-2"></i>
                            Sepet Ürünleri
                        </h5>

                    </div>


                    <div class="card-body p-0">

                        @foreach($cart as $key => $item)

                            @php

                                $quantity =
                                    (int) ($item['quantity'] ?? 1);

                                $price =
                                    (float) ($item['price'] ?? 0);

                                $lineTotal =
                                    $price * $quantity;

                            @endphp


                            <div class="p-4 border-bottom">

                                <div class="row align-items-center g-3">

                                    {{-- GÖRSEL --}}
                                    <div class="col-md-2">

                                        @if(!empty($item['image']))

                                            <img
                                                src="{{ asset('storage/' . $item['image']) }}"
                                                alt="{{ $item['name'] }}"
                                                class="img-fluid rounded"
                                                style="height:100px; width:100px; object-fit:cover;"
                                            >

                                        @else

                                            <div
                                                class="bg-light rounded d-flex align-items-center justify-content-center"
                                                style="height:100px; width:100px;"
                                            >
                                                <i class="bi bi-image text-muted fs-3"></i>
                                            </div>

                                        @endif

                                    </div>


                                    {{-- ÜRÜN --}}
                                    <div class="col-md-4">

                                        <h5 class="fw-bold mb-2">

                                            {{ $item['name'] ?? 'Ürün' }}

                                        </h5>


                                        @if(!empty($item['color_name']))

                                            <div class="small mb-1">

                                                <span class="text-muted">
                                                    Renk:
                                                </span>

                                                <strong>
                                                    {{ $item['color_name'] }}
                                                </strong>

                                            </div>

                                        @endif


                                        @if(!empty($item['size_name']))

                                            <div class="small">

                                                <span class="text-muted">
                                                    Beden:
                                                </span>

                                                <strong>
                                                    {{ $item['size_name'] }}
                                                </strong>

                                            </div>

                                        @endif

                                    </div>


                                    {{-- BİRİM FİYAT --}}
                                    <div class="col-md-2">

                                        <div class="small text-muted">
                                            Birim fiyat
                                        </div>

                                        <strong>

                                            {{ number_format($price, 2, ',', '.') }}
                                            ₺

                                        </strong>

                                    </div>


                                    {{-- ADET --}}
                                    <div class="col-md-2">

                                        <form
                                            action="{{ route('cart.update', $key) }}"
                                            method="POST"
                                            class="d-flex"
                                        >

                                            @csrf

                                            @method('PUT')

                                            <input
                                                type="number"
                                                name="quantity"
                                                value="{{ $quantity }}"
                                                min="1"
                                                class="form-control"
                                                style="width:80px;"
                                            >

                                            <button
                                                type="submit"
                                                class="btn btn-outline-primary ms-2"
                                                title="Güncelle"
                                            >
                                                <i class="bi bi-arrow-repeat"></i>
                                            </button>

                                        </form>

                                    </div>


                                    {{-- TOPLAM / SİL --}}
                                    <div class="col-md-2 text-md-end">

                                        <div class="fw-bold fs-5 mb-2">

                                            {{ number_format($lineTotal, 2, ',', '.') }}
                                            ₺

                                        </div>


                                        <form
                                            action="{{ route('cart.remove', $key) }}"
                                            method="POST"
                                        >

                                            @csrf

                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn btn-sm btn-outline-danger"
                                            >
                                                <i class="bi bi-trash me-1"></i>
                                                Sil
                                            </button>

                                        </form>

                                    </div>

                                </div>

                            </div>

                        @endforeach

                    </div>

                </div>


                {{-- SEPETİ TEMİZLE --}}
                <div class="mt-3">

                    <form
                        action="{{ route('cart.clear') }}"
                        method="POST"
                    >

                        @csrf

                        <button
                            type="submit"
                            class="btn btn-outline-danger"
                        >
                            <i class="bi bi-trash me-1"></i>
                            Sepeti Temizle
                        </button>

                    </form>

                </div>

            </div>


            {{-- SİPARİŞ ÖZETİ --}}
            <div class="col-lg-4">

                <div class="card border-0 shadow-sm">

                    <div class="card-header bg-white py-3">

                        <h5 class="fw-bold mb-0">
                            Sipariş Özeti
                        </h5>

                    </div>


                    <div class="card-body">

                        @php
                            $subtotal = 0;

                            foreach ($cart as $item) {
                                $subtotal +=
                                    ((float) ($item['price'] ?? 0))
                                    *
                                    ((int) ($item['quantity'] ?? 1));
                            }
                        @endphp


                        <div class="d-flex justify-content-between mb-3">

                            <span>
                                Ara Toplam
                            </span>

                            <strong>
                                {{ number_format($subtotal, 2, ',', '.') }}
                                ₺
                            </strong>

                        </div>


                        <div class="d-flex justify-content-between mb-3">

                            <span>
                                Kargo
                            </span>

                            <strong>
                                Ücretsiz
                            </strong>

                        </div>


                        <hr>


                        <div class="d-flex justify-content-between mb-4">

                            <span class="fw-bold fs-5">
                                Toplam
                            </span>

                            <strong class="fw-bold fs-4 text-success">

                                {{ number_format($subtotal, 2, ',', '.') }}
                                ₺

                            </strong>

                        </div>


                        <a
                            href="{{ route('checkout.index') }}"
                            class="btn btn-success btn-lg w-100"
                        >

                            <i class="bi bi-credit-card me-2"></i>

                            Siparişi Tamamla

                        </a>

                    </div>

                </div>

            </div>

        </div>

    @endif

</div>

@endsection