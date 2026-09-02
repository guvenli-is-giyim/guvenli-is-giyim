@extends('front.layouts.app')

@section('content')

<div class="container py-5">

    {{-- BAŞARI --}}
    <div class="text-center mb-5">

        <div class="mb-3">
            <i class="bi bi-check-circle-fill text-success"
               style="font-size:70px;"></i>
        </div>

        <h1 class="fw-bold">
            Siparişiniz Başarıyla Oluşturuldu
        </h1>

        <p class="text-muted mb-1">
            Siparişiniz alınmıştır.
        </p>

        <p class="mb-0">
            Sipariş No:
            <strong>
                {{ $order->order_no }}
            </strong>
        </p>

    </div>


    {{-- MÜŞTERİ BİLGİLERİ --}}
    <div class="card border-0 shadow-sm mb-4">

        <div class="card-header bg-white py-3">

            <h5 class="fw-bold mb-0">
                <i class="bi bi-person me-2"></i>
                Müşteri Bilgileri
            </h5>

        </div>

        <div class="card-body">

            <div class="row g-3">

                <div class="col-md-6">

                    <strong>Ad Soyad</strong>

                    <div>
                        {{ $order->customer->name }}
                        {{ $order->customer->surname }}
                    </div>

                </div>


                <div class="col-md-6">

                    <strong>Telefon</strong>

                    <div>
                        {{ $order->customer->phone }}
                    </div>

                </div>


                <div class="col-md-6">

                    <strong>E-posta</strong>

                    <div>
                        {{ $order->customer->email }}
                    </div>

                </div>


                <div class="col-md-6">

                    <strong>Ödeme Yöntemi</strong>

                    <div>
                        {{ $order->payment_method }}
                    </div>

                </div>


                <div class="col-12">

                    <strong>Adres</strong>

                    <div>
                        {{ $order->customer->address }}
                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- SİPARİŞ ÜRÜNLERİ --}}
    <div class="card border-0 shadow-sm mb-4">

        <div class="card-header bg-white py-3">

            <h5 class="fw-bold mb-0">

                <i class="bi bi-bag me-2"></i>

                Sipariş Ürünleri

            </h5>

        </div>


        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">

                        <tr>

                            <th>
                                Ürün
                            </th>

                            <th>
                                Renk
                            </th>

                            <th>
                                Beden
                            </th>

                            <th class="text-center">
                                Adet
                            </th>

                            <th class="text-end">
                                Birim Fiyat
                            </th>

                            <th class="text-end">
                                Toplam
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @foreach($order->items as $item)

                            <tr>

                                {{-- ÜRÜN --}}
                                <td>

                                    <div class="fw-semibold">

                                        {{ $item->product->name ?? 'Ürün' }}

                                    </div>

                                </td>


                                {{-- RENK --}}
                                <td>

                                    @if($item->variant && $item->variant->color)

                                        <span class="badge bg-secondary">

                                            {{ $item->variant->color->name }}

                                        </span>

                                    @else

                                        <span class="text-muted">
                                            -
                                        </span>

                                    @endif

                                </td>


                                {{-- BEDEN --}}
                                <td>

                                    @if($item->variant && $item->variant->size)

                                        <span class="badge bg-dark">

                                            {{ $item->variant->size->name }}

                                        </span>

                                    @else

                                        <span class="text-muted">
                                            -
                                        </span>

                                    @endif

                                </td>


                                {{-- ADET --}}
                                <td class="text-center">

                                    {{ $item->quantity }}

                                </td>


                                {{-- BİRİM FİYAT --}}
                                <td class="text-end">

                                    {{ number_format($item->price, 2, ',', '.') }}
                                    ₺

                                </td>


                                {{-- TOPLAM --}}
                                <td class="text-end fw-bold">

                                    {{ number_format($item->total, 2, ',', '.') }}
                                    ₺

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    </div>


    {{-- TOPLAM --}}
    <div class="row justify-content-end">

        <div class="col-md-5">

            <div class="card border-0 shadow-sm">

                <div class="card-body">

                    <div class="d-flex justify-content-between mb-2">

                        <span>
                            Ara Toplam
                        </span>

                        <strong>
                            {{ number_format($order->subtotal, 2, ',', '.') }}
                            ₺
                        </strong>

                    </div>


                    <div class="d-flex justify-content-between mb-2">

                        <span>
                            Kargo
                        </span>

                        <strong>
                            {{ number_format($order->shipping, 2, ',', '.') }}
                            ₺
                        </strong>

                    </div>


                    <div class="d-flex justify-content-between mb-2">

                        <span>
                            İndirim
                        </span>

                        <strong>
                            {{ number_format($order->discount, 2, ',', '.') }}
                            ₺
                        </strong>

                    </div>


                    <hr>


                    <div class="d-flex justify-content-between">

                        <span class="fw-bold fs-5">
                            Genel Toplam
                        </span>

                        <strong class="fw-bold fs-4 text-success">

                            {{ number_format($order->total, 2, ',', '.') }}
                            ₺

                        </strong>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- BUTONLAR --}}
    <div class="text-center mt-4">

        <a
            href="{{ route('shop') }}"
            class="btn btn-primary px-4"
        >
            Alışverişe Devam Et
        </a>

        <a
            href="{{ route('home') }}"
            class="btn btn-outline-secondary px-4 ms-2"
        >
            Ana Sayfa
        </a>

    </div>

</div>

@endsection