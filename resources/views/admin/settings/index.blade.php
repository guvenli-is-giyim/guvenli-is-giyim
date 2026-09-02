@extends('admin.layouts.app')

@section('content')

<div class="container">

    <h2 class="fw-bold mb-4">
        Site Ayarları
    </h2>

    @if(session('success'))

        <div class="alert alert-success">
            {{ session('success') }}
        </div>

    @endif

    @if($errors->any())

        <div class="alert alert-danger">

            @foreach($errors->all() as $error)

                <div>
                    {{ $error }}
                </div>

            @endforeach

        </div>

    @endif

    <div class="card shadow-sm border-0">

        <div class="card-body p-4">

            <form
                action="{{ route('admin.settings.update') }}"
                method="POST"
            >

                @csrf

                <div class="row g-4">

                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Site Adı
                        </label>

                        <input
                            type="text"
                            name="site_name"
                            class="form-control"
                            value="{{ old('site_name', $setting->site_name) }}"
                            placeholder="Güvenli İş Giyim"
                        >

                    </div>


                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Telefon
                        </label>

                        <input
                            type="text"
                            name="phone"
                            class="form-control"
                            value="{{ old('phone', $setting->phone) }}"
                            placeholder="05XX XXX XX XX"
                        >

                    </div>


                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            E-posta
                        </label>

                        <input
                            type="email"
                            name="email"
                            class="form-control"
                            value="{{ old('email', $setting->email) }}"
                            placeholder="info@guvenliisgiyim.com"
                        >

                    </div>


                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Logo
                        </label>

                        <input
                            type="text"
                            name="logo"
                            class="form-control"
                            value="{{ old('logo', $setting->logo) }}"
                            placeholder="logo.png"
                        >

                    </div>


                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Favicon
                        </label>

                        <input
                            type="text"
                            name="favicon"
                            class="form-control"
                            value="{{ old('favicon', $setting->favicon) }}"
                            placeholder="favicon.ico"
                        >

                    </div>


                    <div class="col-12">

                        <label class="form-label fw-semibold">
                            Adres
                        </label>

                        <textarea
                            name="address"
                            rows="4"
                            class="form-control"
                            placeholder="Firma adresi"
                        >{{ old('address', $setting->address) }}</textarea>

                    </div>


                    <div class="col-12">

                        <button
                            type="submit"
                            class="btn btn-primary px-4"
                        >
                            Ayarları Kaydet
                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection