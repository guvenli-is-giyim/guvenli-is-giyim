@extends('admin.layouts.app')

@section('content')

<div class="container">

    <h2 class="mb-4">

        Banner Düzenle

    </h2>

    <form action="{{ route('admin.banners.update',$banner) }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="card">

            <div class="card-body">

                <div class="mb-3">

                    <label>Başlık</label>

                    <input type="text"
                           name="title"
                           value="{{ $banner->title }}"
                           class="form-control">

                </div>

                <div class="mb-3">

                    <label>Alt Başlık</label>

                    <input type="text"
                           name="subtitle"
                           value="{{ $banner->subtitle }}"
                           class="form-control">

                </div>

                <div class="row">

                    <div class="col-md-6">

                        <label>Buton Yazısı</label>

                        <input type="text"
                               name="button_text"
                               value="{{ $banner->button_text }}"
                               class="form-control">

                    </div>

                    <div class="col-md-6">

                        <label>Buton Linki</label>

                        <input type="text"
                               name="button_link"
                               value="{{ $banner->button_link }}"
                               class="form-control">

                    </div>

                </div>

                <div class="mt-3">

                    <img src="{{ asset('uploads/banners/'.$banner->image) }}"
                         width="250"
                         class="img-thumbnail mb-3">

                    <input type="file"
                           name="image"
                           class="form-control">

                </div>

                <div class="row mt-3">

                    <div class="col-md-3">

                        <label>Sıralama</label>

                        <input type="number"
                               name="sort_order"
                               value="{{ $banner->sort_order }}"
                               class="form-control">

                    </div>

                    <div class="col-md-3 d-flex align-items-end">

                        <div class="form-check">

                            <input type="checkbox"
                                   name="status"
                                   class="form-check-input"
                                   {{ $banner->status ? 'checked' : '' }}>

                            <label class="form-check-label">

                                Aktif

                            </label>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="mt-3">

            <button class="btn btn-success">

                Güncelle

            </button>

            <a href="{{ route('admin.banners.index') }}"
               class="btn btn-secondary">

                Geri

            </a>

        </div>

    </form>

</div>

@endsection