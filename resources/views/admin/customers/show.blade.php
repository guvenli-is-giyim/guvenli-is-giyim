@extends('admin.layouts.app')

@section('content')

<div class="container">

    <h2 class="mb-4">
        Müşteri Detayı
    </h2>


    @if(session('success'))

        <div class="alert alert-success">
            {{ session('success') }}
        </div>

    @endif


    <div class="card shadow-sm mb-4">

        <div class="card-body">

            <h5 class="mb-4">
                Müşteri Bilgileri
            </h5>


            <div class="row">

                <div class="col-md-6 mb-3">

                    <strong>
                        Ad Soyad
                    </strong>

                    <div>
                        {{ $customer->name }}
                    </div>

                </div>


                <div class="col-md-6 mb-3">

                    <strong>
                        Telefon
                    </strong>

                    <div>
                        {{ $customer->phone ?? '-' }}
                    </div>

                </div>


                <div class="col-md-6 mb-3">

                    <strong>
                        E-posta
                    </strong>

                    <div>
                        {{ $customer->email ?? '-' }}
                    </div>

                </div>


                <div class="col-md-6 mb-3">

                    <strong>
                        Adres
                    </strong>

                    <div>
                        {{ $customer->address ?? '-' }}
                    </div>

                </div>


                <div class="col-md-6 mb-3">

                    <strong>
                        Kayıt Tarihi
                    </strong>

                    <div>
                        {{ $customer->created_at?->format('d.m.Y H:i') }}
                    </div>

                </div>

            </div>

        </div>

    </div>


    <div class="card shadow-sm mb-4">

        <div class="card-body">

            <h5 class="mb-4">
                Siparişler
            </h5>


            @if($customer->orders->count())

                <div class="table-responsive">

                    <table class="table table-bordered align-middle">

                        <thead>

                            <tr>

                                <th>
                                    Sipariş ID
                                </th>

                                <th>
                                    Tarih
                                </th>

                                <th>
                                    Toplam
                                </th>

                                <th>
                                    Durum
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @foreach($customer->orders as $order)

                                <tr>

                                    <td>
                                        #{{ $order->id }}
                                    </td>

                                    <td>
                                        {{ $order->created_at?->format('d.m.Y H:i') }}
                                    </td>

                                    <td>
                                        {{ number_format($order->total ?? 0, 2, ',', '.') }} ₺
                                    </td>

                                    <td>
                                        {{ $order->status ?? '-' }}
                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="alert alert-info mb-0">

                    Bu müşteriye ait henüz sipariş bulunmuyor.

                </div>

            @endif

        </div>

    </div>


    <a
        href="{{ route('admin.customers.index') }}"
        class="btn btn-secondary"
    >

        Geri

    </a>

</div>

@endsection