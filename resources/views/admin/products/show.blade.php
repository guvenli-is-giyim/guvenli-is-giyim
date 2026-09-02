@extends('admin.layouts.app')

@section('content')

<div class="container">

    <div class="d-flex justify-content-between mb-4">

        <h2>{{ $product->name }}</h2>

        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
            Geri Dön
        </a>

    </div>

    <div class="card mb-4">

        <div class="card-body">

            <table class="table">

                <tr>
                    <th width="220">Kategori</th>
                    <td>{{ $product->category->name ?? '-' }}</td>
                </tr>

                <tr>
                    <th>Marka</th>
                    <td>{{ $product->brand->name ?? '-' }}</td>
                </tr>

                <tr>
                    <th>Ürün Adı</th>
                    <td>{{ $product->name }}</td>
                </tr>

                <tr>
                    <th>SKU</th>
                    <td>{{ $product->sku }}</td>
                </tr>

                <tr>
                    <th>Barkod</th>
                    <td>{{ $product->barcode }}</td>
                </tr>

                <tr>
                    <th>Kısa Açıklama</th>
                    <td>{{ $product->short_description }}</td>
                </tr>

                <tr>
                    <th>Detaylı Açıklama</th>
                    <td>{!! nl2br(e($product->description)) !!}</td>
                </tr>

                <tr>
                    <th>Durum</th>

                    <td>

                        @if($product->status)

                            <span class="badge bg-success">
                                Aktif
                            </span>

                        @else

                            <span class="badge bg-danger">
                                Pasif
                            </span>

                        @endif

                    </td>

                </tr>

                <tr>

                    <th>Öne Çıkan</th>

                    <td>

                        @if($product->featured)

                            Evet

                        @else

                            Hayır

                        @endif

                    </td>

                </tr>

            </table>

        </div>

    </div>

    @if($product->images->count())

    <div class="card">

        <div class="card-header">

            Ürün Resimleri

        </div>

        <div class="card-body">

            <div class="row">

                @foreach($product->images as $image)

                <div class="col-md-3 mb-3">

                    <img
                        src="{{ asset('uploads/products/'.$image->image) }}"
                        class="img-fluid rounded border">

                </div>

                @endforeach

            </div>

        </div>

    </div>

    @endif

</div>

@endsection