@extends('admin.layouts.app')

@section('content')

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2 class="fw-bold">
            Müşteriler
        </h2>

    </div>


    @if(session('success'))

        <div class="alert alert-success">
            {{ session('success') }}
        </div>

    @endif


    @if($customers->count())

        <div class="card shadow-sm border-0">

            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table table-bordered table-hover align-middle mb-0">

                        <thead>

                            <tr>

                                <th>ID</th>

                                <th>Ad Soyad</th>

                                <th>Telefon</th>

                                <th>E-posta</th>

                                <th>Adres</th>

                                <th>Kayıt Tarihi</th>

                                <th>İşlem</th>

                            </tr>

                        </thead>


                        <tbody>

                        @foreach($customers as $customer)

                            <tr>

                                <td>
                                    {{ $customer->id }}
                                </td>


                                <td>

                                    <strong>
                                        {{ $customer->name }}
                                        {{ $customer->surname }}
                                    </strong>

                                </td>


                                <td>
                                    {{ $customer->phone }}
                                </td>


                                <td>
                                    {{ $customer->email }}
                                </td>


                                <td style="max-width:250px;">

                                    {{ $customer->address }}

                                </td>


                                <td>

                                    {{ $customer->created_at->format('d.m.Y H:i') }}

                                </td>


                                <td>

                                    @if(Route::has('admin.customers.show'))

                                        <a
                                            href="{{ route(
                                                'admin.customers.show',
                                                $customer
                                            ) }}"
                                            class="btn btn-primary btn-sm"
                                        >
                                            Görüntüle
                                        </a>

                                    @endif


                                    <form
                                        action="{{ route(
                                            'admin.customers.destroy',
                                            $customer
                                        ) }}"
                                        method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Bu müşteriyi silmek istediğinize emin misiniz?')"
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

            {{ $customers->links() }}

        </div>


    @else

        <div class="alert alert-info">

            Henüz müşteri bulunmuyor.

        </div>

    @endif

</div>

@endsection