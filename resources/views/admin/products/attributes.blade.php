@extends('admin.layouts.app')

@section('content')

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2>
            {{ $product->name }} - Ürün Özellikleri
        </h2>

        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
            Geri Dön
        </a>

    </div>

    @if(session('success'))

        <div class="alert alert-success">
            {{ session('success') }}
        </div>

    @endif

    <div class="card mb-4">

        <div class="card-header">
            Yeni Özellik Ekle
        </div>

        <div class="card-body">

            <form action="{{ route('admin.products.attributes.store',$product) }}" method="POST">

                @csrf

                <div class="row">

                    <div class="col-md-4">

                        <label>Özellik Adı</label>

                        <input
                            type="text"
                            name="title"
                            class="form-control"
                            placeholder="Örn: Kumaş">

                    </div>

                    <div class="col-md-4">

                        <label>Değer</label>

                        <input
                            type="text"
                            name="value"
                            class="form-control"
                            placeholder="Örn: %100 Pamuk">

                    </div>

                    <div class="col-md-2">

                        <label>Sıra</label>

                        <input
                            type="number"
                            name="sort_order"
                            value="0"
                            class="form-control">

                    </div>

                    <div class="col-md-2 d-flex align-items-end">

                        <button class="btn btn-success w-100">

                            Kaydet

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

    <div class="card">

        <div class="card-header">

            Özellik Listesi

        </div>

        <div class="card-body p-0">

            <table class="table table-bordered mb-0">

                <thead>

                    <tr>

                        <th width="60">#</th>

                        <th>Özellik</th>

                        <th>Değer</th>

                        <th width="120">Sıra</th>

                        <th width="120">İşlem</th>

                    </tr>

                </thead>

                <tbody>

                @forelse($attributes as $attribute)

                    <tr>

                        <td>{{ $attribute->id }}</td>

                        <td>{{ $attribute->title }}</td>

                        <td>{{ $attribute->value }}</td>

                        <td>{{ $attribute->sort_order }}</td>

                        <td>

                            <form action="{{ route('admin.products.attributes.destroy',$attribute) }}"
                                  method="POST">

                                @csrf
                                @method('DELETE')

                                <button
                                    onclick="return confirm('Silinsin mi?')"
                                    class="btn btn-danger btn-sm">

                                    Sil

                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="5" class="text-center">

                            Henüz özellik eklenmedi.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection