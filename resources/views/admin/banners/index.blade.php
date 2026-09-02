@extends('admin.layouts.app')

@section('content')

<div class="container">

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2>Banner Yönetimi</h2>

        <a href="{{ route('admin.banners.create') }}" class="btn btn-primary">
            + Yeni Banner
        </a>

    </div>

    <div class="card">

        <div class="card-body p-0">

            <table class="table table-bordered table-hover mb-0">

                <thead>

                    <tr>

                        <th width="60">ID</th>

                        <th width="180">Resim</th>

                        <th>Başlık</th>

                        <th>Alt Başlık</th>

                        <th>Sıra</th>

                        <th>Durum</th>

                        <th width="170">İşlem</th>

                    </tr>

                </thead>

                <tbody>

                @forelse($banners as $banner)

                    <tr>

                        <td>{{ $banner->id }}</td>

                        <td>

                            <img src="{{ asset('uploads/banners/'.$banner->image) }}"
                                 width="160"
                                 class="img-thumbnail">

                        </td>

                        <td>{{ $banner->title }}</td>

                        <td>{{ $banner->subtitle }}</td>

                        <td>{{ $banner->sort_order }}</td>

                        <td>

                            @if($banner->status)

                                <span class="badge bg-success">
                                    Aktif
                                </span>

                            @else

                                <span class="badge bg-danger">
                                    Pasif
                                </span>

                            @endif

                        </td>

                        <td>

                            <a href="{{ route('admin.banners.edit',$banner) }}"
                               class="btn btn-warning btn-sm">

                                Düzenle

                            </a>

                            <form action="{{ route('admin.banners.destroy',$banner) }}"
                                  method="POST"
                                  class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('Banner silinsin mi?')">

                                    Sil

                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="7" class="text-center">

                            Henüz banner eklenmedi.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

    <div class="mt-3">

        {{ $banners->links() }}

    </div>

</div>

@endsection