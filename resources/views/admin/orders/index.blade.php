@extends('admin.layouts.app')

@section('content')

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2 class="fw-bold">
            Siparişler
        </h2>

    </div>


    @if(session('success'))

        <div class="alert alert-success">
            {{ session('success') }}
        </div>

    @endif


    @if($orders->count())

        <div class="card shadow-sm border-0">

            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table table-bordered table-hover align-middle mb-0">

                        <thead>

                            <tr>

                                <th>
                                    ID
                                </th>

                                <th>
                                    Sipariş No
                                </th>

                                <th>
                                    Müşteri
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

                                <th>
                                    İşlem
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                        @foreach($orders as $order)

                            <tr>

                                <td>
                                    {{ $order->id }}
                                </td>


                                <td>

                                    <strong>
                                        {{ $order->order_no }}
                                    </strong>

                                </td>


                                <td>

                                    @if($order->customer)

                                        {{ $order->customer->name }}
                                        {{ $order->customer->surname }}

                                    @else

                                        -

                                    @endif

                                </td>


                                <td>

                                    {{ $order->created_at->format('d.m.Y H:i') }}

                                </td>


                                <td>

                                    <strong>

                                        {{ number_format(
                                            $order->total,
                                            2,
                                            ',',
                                            '.'
                                        ) }} ₺

                                    </strong>

                                </td>


                                <td>

                                    @if($order->status === 'pending')

                                        <span class="badge bg-warning text-dark">
                                            Bekliyor
                                        </span>

                                    @elseif($order->status === 'processing')

                                        <span class="badge bg-primary">
                                            Hazırlanıyor
                                        </span>

                                    @elseif($order->status === 'shipped')

                                        <span class="badge bg-info text-dark">
                                            Kargoya Verildi
                                        </span>

                                    @elseif($order->status === 'completed')

                                        <span class="badge bg-success">
                                            Tamamlandı
                                        </span>

                                    @elseif($order->status === 'cancelled')

                                        <span class="badge bg-danger">
                                            İptal Edildi
                                        </span>

                                    @else

                                        <span class="badge bg-secondary">
                                            {{ $order->status }}
                                        </span>

                                    @endif

                                </td>


                                <td>

                                    <a
                                        href="{{ route(
                                            'admin.orders.show',
                                            $order
                                        ) }}"
                                        class="btn btn-primary btn-sm"
                                    >
                                        Görüntüle
                                    </a>


                                    <form
                                        action="{{ route(
                                            'admin.orders.destroy',
                                            $order
                                        ) }}"
                                        method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Bu siparişi silmek istediğinize emin misiniz?')"
                                    >

                                        @csrf

                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-danger btn-sm"
                                        >
                                            Sil
                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

        </div>


        <div class="mt-4">

            {{ $orders->links() }}

        </div>


    @else

        <div class="alert alert-info">

            Henüz sipariş bulunmuyor.

        </div>

    @endif

</div>

@endsection