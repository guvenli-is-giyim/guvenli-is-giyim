@extends('front.layouts.app')

@section('content')

<div class="container py-5">

    <div class="mb-4">

        <h2 class="fw-bold mb-1">
            Siparişi Tamamla
        </h2>

        <p class="text-muted mb-0">
            Teslimat bilgilerinizi girerek siparişinizi oluşturabilirsiniz.
        </p>

    </div>


    @if ($errors->any())

        <div class="alert alert-danger">

            <strong>
                Lütfen aşağıdaki alanları kontrol edin:
            </strong>

            <ul class="mb-0 mt-2">

                @foreach ($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    @if(session('error'))

        <div class="alert alert-danger">
            {{ session('error') }}
        </div>

    @endif


    <div class="row g-4">


        {{-- MÜŞTERİ BİLGİLERİ --}}

        <div class="col-lg-7">

            <div class="card border-0 shadow-sm">

                <div class="card-body p-4">

                    <h4 class="fw-bold mb-4">
                        Teslimat Bilgileri
                    </h4>


                    <form
                        action="{{ route('checkout.store') }}"
                        method="POST"
                    >

                        @csrf


                        {{-- AD --}}

                        <div class="mb-3">

                            <label
                                for="name"
                                class="form-label fw-semibold"
                            >
                                Ad
                            </label>

                            <input
                                type="text"
                                id="name"
                                name="name"
                                class="form-control form-control-lg"
                                value="{{ old('name') }}"
                                placeholder="Adınız"
                                required
                            >

                        </div>


                        {{-- SOYAD --}}

                        <div class="mb-3">

                            <label
                                for="surname"
                                class="form-label fw-semibold"
                            >
                                Soyad
                            </label>

                            <input
                                type="text"
                                id="surname"
                                name="surname"
                                class="form-control form-control-lg"
                                value="{{ old('surname') }}"
                                placeholder="Soyadınız"
                                required
                            >

                        </div>


                        {{-- TELEFON --}}

                        <div class="mb-3">

                            <label
                                for="phone"
                                class="form-label fw-semibold"
                            >
                                Telefon
                            </label>

                            <input
                                type="tel"
                                id="phone"
                                name="phone"
                                class="form-control form-control-lg"
                                value="{{ old('phone') }}"
                                placeholder="05XX XXX XX XX"
                                required
                            >

                        </div>


                        {{-- E-POSTA --}}

                        <div class="mb-3">

                            <label
                                for="email"
                                class="form-label fw-semibold"
                            >
                                E-posta
                            </label>

                            <input
                                type="email"
                                id="email"
                                name="email"
                                class="form-control form-control-lg"
                                value="{{ old('email') }}"
                                placeholder="ornek@email.com"
                                required
                            >

                        </div>


                        {{-- ADRES --}}

                        <div class="mb-4">

                            <label
                                for="address"
                                class="form-label fw-semibold"
                            >
                                Teslimat Adresi
                            </label>

                            <textarea
                                id="address"
                                name="address"
                                class="form-control"
                                rows="5"
                                placeholder="Mahalle, sokak, bina no, daire no, ilçe / il"
                                required
                            >{{ old('address') }}</textarea>

                        </div>


                        {{-- ÖDEME --}}

                        <div class="border rounded p-3 mb-4">

                            <h5 class="fw-bold mb-3">
                                Ödeme
                            </h5>


                            <div class="form-check">

                                <input
                                    class="form-check-input"
                                    type="radio"
                                    name="payment_method"
                                    id="cash"
                                    value="cash"
                                    checked
                                >

                                <label
                                    class="form-check-label"
                                    for="cash"
                                >
                                    Sipariş sonrası ödeme
                                </label>

                            </div>


                            <small class="text-muted d-block mt-2">

                                Ödeme yöntemi daha sonra ödeme sistemi
                                entegrasyonuna bağlanabilir.

                            </small>

                        </div>


                        <button
                            type="submit"
                            class="btn btn-dark btn-lg w-100 py-3"
                        >

                            Siparişi Tamamla

                        </button>


                    </form>

                </div>

            </div>

        </div>


        {{-- SİPARİŞ ÖZETİ --}}

        <div class="col-lg-5">

            <div
                class="card border-0 shadow-sm"
                style="position: sticky; top: 25px;"
            >

                <div class="card-body p-4">

                    <h4 class="fw-bold mb-4">
                        Sipariş Özeti
                    </h4>


                    @foreach ($cart as $item)

                        @php

                            $quantity = $item['quantity'] ?? 1;

                            $price = $item['price'] ?? 0;

                            $itemTotal = $price * $quantity;

                            $checkoutProduct =
                                \App\Models\Product::find($item['id']);

                        @endphp


                        <div class="d-flex align-items-start mb-3">


                            {{-- RESİM --}}

                            @if (!empty($item['image']))

                                <img
                                    src="{{ asset('storage/' . $item['image']) }}"
                                    alt="{{ $item['name'] ?? 'Ürün' }}"
                                    style="
                                        width:70px;
                                        height:70px;
                                        object-fit:cover;
                                        border-radius:8px;
                                    "
                                    class="me-3"
                                >

                            @else

                                <div
                                    class="bg-light d-flex align-items-center justify-content-center me-3"
                                    style="
                                        width:70px;
                                        height:70px;
                                        border-radius:8px;
                                    "
                                >

                                    <span class="text-muted">
                                        Ürün
                                    </span>

                                </div>

                            @endif


                            {{-- ÜRÜN --}}

                            <div class="flex-grow-1">

                                <div class="fw-semibold">

                                    {{ $item['name'] ?? 'Ürün' }}

                                </div>


                                <div class="text-muted small">

                                    {{ $quantity }} adet

                                </div>


                                <div class="mt-1">

                                    {{ number_format($price, 2, ',', '.') }} ₺

                                </div>


                                {{-- STOK --}}

                                @if($checkoutProduct)

                                    @if($checkoutProduct->stock < $quantity)

                                        <div class="mt-1">

                                            <span class="badge bg-danger">

                                                Yetersiz stok

                                            </span>

                                        </div>

                                    @endif

                                @endif

                            </div>


                            {{-- TOPLAM --}}

                            <div class="fw-bold">

                                {{ number_format(
                                    $itemTotal,
                                    2,
                                    ',',
                                    '.'
                                ) }} ₺

                            </div>

                        </div>

                    @endforeach


                    <hr class="my-4">


                    {{-- ARA TOPLAM --}}

                    <div class="d-flex justify-content-between mb-2">

                        <span class="text-muted">
                            Ara Toplam
                        </span>

                        <span>

                            {{ number_format(
                                $total,
                                2,
                                ',',
                                '.'
                            ) }} ₺

                        </span>

                    </div>


                    {{-- KARGO --}}

                    <div class="d-flex justify-content-between mb-2">

                        <span class="text-muted">
                            Kargo
                        </span>

                        <span class="text-success fw-semibold">
                            Ücretsiz
                        </span>

                    </div>


                    <hr>


                    {{-- GENEL TOPLAM --}}

                    <div class="d-flex justify-content-between align-items-center">

                        <span class="fw-bold fs-5">
                            Genel Toplam
                        </span>

                        <span class="fw-bold fs-4">

                            {{ number_format(
                                $total,
                                2,
                                ',',
                                '.'
                            ) }} ₺

                        </span>

                    </div>


                </div>

            </div>

        </div>

    </div>

</div>

@endsection