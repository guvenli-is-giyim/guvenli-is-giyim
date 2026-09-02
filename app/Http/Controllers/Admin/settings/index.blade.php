@extends('admin.layouts.app')

@section('content')

<div class="container">

    <h2 class="mb-4">
        Site Ayarları
    </h2>

    <div class="card">

        <div class="card-body">

            <form>

                <div class="mb-3">

                    <label>Site Adı</label>

                    <input
                        type="text"
                        class="form-control"
                        value="Güvenli İş Giyim">

                </div>

                <div class="mb-3">

                    <label>Telefon</label>

                    <input
                        type="text"
                        class="form-control">

                </div>

                <div class="mb-3">

                    <label>E-posta</label>

                    <input
                        type="email"
                        class="form-control">

                </div>

                <div class="mb-3">

                    <label>Adres</label>

                    <textarea
                        class="form-control"
                        rows="3"></textarea>

                </div>

                <button
                    class="btn btn-primary">

                    Kaydet

                </button>

            </form>

        </div>

    </div>

</div>

@endsection