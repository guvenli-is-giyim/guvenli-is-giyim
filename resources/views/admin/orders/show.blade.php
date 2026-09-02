@extends('admin.layouts.app')

@section('content')

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2 class="fw-bold">
            Sipariş Detayı
        </h2>

        <a
            href="{{ route('admin.orders.index') }}"
            class="btn btn-secondary"
        >
            Siparişlere Dön
        </a>

    </div>


    @if(session('success'))

        <div class="alert alert-success">
            {{ session('success') }}
        </div>

    @endif


    {{-- SİPARİŞ BİLGİLERİ --}}

    <div class="card shadow-sm border-0 mb-4">

        <div class="card-body">

            <div class="row g-4">

                <div class="col-md-4">

                    <small class="text-muted">
                        Sipariş No
                    </small>

                    <h5 class="fw-bold">
                        {{ $order->order_no }}
                    </h5>

                </div>


                <div class="col-md-4">

                    <small class="text-muted">
                        Tarih
                    </small>

                    <h5>
                        {{ $order->created_at->format('d.m.Y H:i') }}
                    </h5>

                </div>


                <div class="col-md-4">

                    <small class="text-muted">
                        Toplam
                    </small>

                    <h5 class="fw-bold text-success">
                        {{ number_format($order->total, 2, ',', '.') }} ₺
                    </h5>

                </div>

            </div>

        </div>

    </div>


    {{-- MÜŞTERİ --}}

    <div class="card shadow-sm border-0 mb-4">

        <div class="card-header bg-white">

            <h5 class="mb-0 fw-bold">
                Müşteri Bilgileri
            </h5>

        </div>


        <div class="card-body">

            @if($order->customer)

                <div class="row g-3">

                    <div class="col-md-6">

                        <strong>
                            Ad Soyad
                        </strong>

                        <div>
                            {{ $order->customer->name }}
                            {{ $order->customer->surname }}
                        </div>

                    </div>


                    <div class="col-md-6">

                        <strong>
                            Telefon
                        </strong>

                        <div>
                            {{ $order->customer->phone }}
                        </div>

                    </div>


                    <div class="col-md-6">

                        <strong>
                            E-posta
                        </strong>

                        <div>
                            {{ $order->customer->email }}
                        </div>

                    </div>


                    <div class="col-md-6">

                        <strong>
                            Adres
                        </strong>

                        <div>
                            {{ $order->customer->address }}
                        </div>

                    </div>

                </div>

            @else

                <div class="alert alert-warning mb-0">
                    Müşteri bilgisi bulunamadı.
                </div>

            @endif

        </div>

    </div>


    {{-- DURUM --}}

    <div class="card shadow-sm border-0 mb-4">

        <div class="card-header bg-white">

            <h5 class="mb-0 fw-bold">
                Sipariş Durumu
            </h5>

        </div>


        <div class="card-body">

            <form
                action="{{ route('admin.orders.update', $order) }}"
                method="POST"
            >

                @csrf

                @method('PUT')


                <div class="row align-items-end">

                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Durum
                        </label>

                        <select
                            name="status"
                            class="form-select"
                        >

                            <option
                                value="pending"
                                @selected($order->status === 'pending')
                            >
                                Bekliyor
                            </option>

                            <option
                                value="processing"
                                @selected($order->status === 'processing')
                            >
                                Hazırlanıyor
                            </option>

                            <option
                                value="shipped"
                                @selected($order->status === 'shipped')
                            >
                                Kargoya Verildi
                            </option>

                            <option
                                value="completed"
                                @selected($order->status === 'completed')
                            >
                                Tamamlandı
                            </option>

                            <option
                                value="cancelled"
                                @selected($order->status === 'cancelled')
                            >
                                İptal Edildi
                            </option>

                        </select>

                    </div>


                    <div class="col-md-3">

                        <button
                            type="submit"
                            class="btn btn-primary"
                        >
                            Durumu Güncelle
                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>


    {{-- ÜRÜNLER --}}

    <div class="card shadow-sm border-0 mb-4">

        <div class="card-header bg-white">

            <h5 class="mb-0 fw-bold">
                Sipariş Ürünleri
            </h5>

        </div>


        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-bordered mb-0 align-middle">

                    <thead>

                        <tr>

                            <th>
                                Ürün
                            </th>

                            <th>
                                Adet
                            </th>

                            <th>
                                Birim Fiyat
                            </th>

                            <th>
                                Toplam
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                    @forelse($order->items as $item)

                        <tr>

                            <td>

                                {{ $item->product->name ?? 'Ürün silinmiş' }}

                            </td>


                            <td>

                                {{ $item->quantity }}

                            </td>


                            <td>

                                {{ number_format(
                                    $item->price,
                                    2,
                                    ',',
                                    '.'
                                ) }} ₺

                            </td>


                            <td class="fw-bold">

                                {{ number_format(
                                    $item->total,
                                    2,
                                    ',',
                                    '.'
                                ) }} ₺

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="4"
                                class="text-center py-4"
                            >

                                Sipariş ürünü bulunamadı.

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>


    {{-- TOPLAM --}}

    <div class="card shadow-sm border-0">

        <div class="card-body">

            <div class="row justify-content-end">

                <div class="col-md-5">

                    <div class="d-flex justify-content-between mb-2">

                        <span>
                            Ara Toplam
                        </span>

                        <strong>
                            {{ number_format(
                                $order->subtotal,
                                2,
                                ',',
                                '.'
                            ) }} ₺
                        </strong>

                    </div>


                    <div class="d-flex justify-content-between mb-2">

                        <span>
                            Kargo
                        </span>

                        <strong>
                            {{ number_format(
                                $order->shipping,
                                2,
                                ',',
                                '.'
                            ) }} ₺
                        </strong>

                    </div>


                    <div class="d-flex justify-content-between mb-2">

                        <span>
                            İndirim
                        </span>

                        <strong>
                            {{ number_format(
                                $order->discount,
                                2,
                                ',',
                                '.'
                            ) }} ₺
                        </strong>

                    </div>


                    <hr>


                    <div class="d-flex justify-content-between">

                        <strong class="fs-5">
                            Genel Toplam
                        </strong>

                        <strong class="fs-5 text-success">

                            {{ number_format(
                                $order->total,
                                2,
                                ',',
                                '.'
                            ) }} ₺

                        </strong>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection