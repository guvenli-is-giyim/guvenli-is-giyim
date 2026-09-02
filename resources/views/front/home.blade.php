@extends('front.layouts.app')

@section('title','Güvenli İş Giyim')

@section('content')

{{-- =====================================================
     ANA HERO ALANI
===================================================== --}}

<section class="hero-section">

    <div class="container">

        <div class="hero-layout">

            {{-- SOL KATEGORİLER --}}
            <div class="hero-categories">

                <div class="hero-category-title">
                    Kategoriler
                </div>

                <div class="hero-category-list">

                    @foreach($categories as $category)

                        <a href="{{ route('shop',['category'=>$category->id]) }}">

                            <span style="margin-right:10px;">
                                ›
                            </span>

                            {{ $category->name }}

                        </a>

                    @endforeach

                </div>

            </div>


            {{-- BANNER --}}
            <div class="hero-slider">

                @if(isset($banners) && $banners->count())

                    <div
                        id="mainSlider"
                        class="carousel slide"
                        data-bs-ride="carousel"
                    >

                        <div class="carousel-inner">

                            @foreach($banners as $key => $banner)

                                <div
                                    class="carousel-item {{ $key == 0 ? 'active' : '' }}"
                                >

                                    @if($banner->image)

                                        <img
                                            src="{{ asset('storage/'.$banner->image) }}"
                                            alt="{{ $banner->title }}"
                                        >

                                    @endif


                                    <div class="hero-overlay">

                                        <div class="hero-content">

                                            @if($banner->subtitle ?? false)

                                                <div class="hero-small-title">
                                                    {{ $banner->subtitle }}
                                                </div>

                                            @endif


                                            <h1 class="hero-title">

                                                {{ $banner->title }}

                                            </h1>


                                            @if($banner->description)

                                                <p class="hero-description">

                                                    {{ $banner->description }}

                                                </p>

                                            @endif


                                            @if($banner->button_text)

                                                <a
                                                    href="{{ $banner->button_link ?: '#' }}"
                                                    class="hero-button"
                                                >

                                                    {{ $banner->button_text }}

                                                </a>

                                            @endif

                                        </div>

                                    </div>

                                </div>

                            @endforeach

                        </div>


                        @if($banners->count() > 1)

                            <button
                                class="carousel-control-prev"
                                type="button"
                                data-bs-target="#mainSlider"
                                data-bs-slide="prev"
                            >

                                <span class="carousel-control-prev-icon"></span>

                            </button>


                            <button
                                class="carousel-control-next"
                                type="button"
                                data-bs-target="#mainSlider"
                                data-bs-slide="next"
                            >

                                <span class="carousel-control-next-icon"></span>

                            </button>

                        @endif

                    </div>

                @else

                    {{-- BANNER YOKSA --}}

                    <div
                        style="
                            height:430px;
                            display:flex;
                            align-items:center;
                            padding:45px;
                            color:white;
                            background:
                            linear-gradient(
                                135deg,
                                #14253e,
                                #263b5c
                            );
                        "
                    >

                        <div class="hero-content">

                            <div class="hero-small-title">
                                GÜVENLİ İŞ GİYİM
                            </div>

                            <h1 class="hero-title">
                                İş Güvenliğinde
                                Profesyonel Çözümler
                            </h1>

                            <p class="hero-description">
                                İş güvenliği ekipmanları,
                                iş kıyafetleri ve profesyonel
                                koruyucu ürünler.
                            </p>

                            <a
                                href="{{ route('shop') }}"
                                class="hero-button"
                            >
                                Ürünleri İncele
                            </a>

                        </div>

                    </div>

                @endif

            </div>

        </div>

    </div>

</section>



{{-- =====================================================
     HIZLI KATEGORİLER
===================================================== --}}

<section class="quick-categories">

    <div class="container">

        <div class="quick-category-row">

            @foreach($categories as $category)

                <a
                    href="{{ route('shop',['category'=>$category->id]) }}"
                    class="quick-category"
                >

                    <div class="quick-category-icon">

                        @if($category->name == 'İş Ayakkabıları')
                            👞
                        @elseif($category->name == 'İş Elbiseleri')
                            👕
                        @elseif($category->name == 'Eldivenler')
                            🧤
                        @elseif($category->name == 'Baret ve Koruyucu Ekipmanlar')
                            ⛑
                        @elseif($category->name == 'Reflektörlü Ürünler')
                            🦺
                        @else
                            🛡
                        @endif

                    </div>

                    {{ $category->name }}

                </a>

            @endforeach

        </div>

    </div>

</section>



{{-- =====================================================
     İSTATİSTİKLER
===================================================== --}}

<section class="stats-section">

    <div class="container">

        <div class="stats-row">

            <div class="stat-box">

                <span class="stat-number">
                    100+
                </span>

                <span class="stat-text">
                    Profesyonel Ürün
                </span>

            </div>


            <div class="stat-box">

                <span class="stat-number">
                    7/24
                </span>

                <span class="stat-text">
                    Müşteri Desteği
                </span>

            </div>


            <div class="stat-box">

                <span class="stat-number">
                    %100
                </span>

                <span class="stat-text">
                    Güvenilir Hizmet
                </span>

            </div>


            <div class="stat-box">

                <span class="stat-number">
                    HIZLI
                </span>

                <span class="stat-text">
                    Teslimat
                </span>

            </div>

        </div>

    </div>

</section>



{{-- =====================================================
     ÖNE ÇIKAN ÜRÜNLER
===================================================== --}}

<section class="py-5 bg-white">

    <div class="container">


        <div class="d-flex justify-content-between align-items-end mb-4">

            <div>

                <div
                    style="
                        color:#f26522;
                        font-size:12px;
                        font-weight:800;
                        letter-spacing:1px;
                        margin-bottom:5px;
                    "
                >
                    ÖNE ÇIKANLAR
                </div>

                <h2
                    class="fw-bold mb-1"
                    style="color:#0d1a2d;"
                >
                    Öne Çıkan Ürünler
                </h2>

                <p class="text-muted mb-0">
                    Profesyonel iş güvenliği ürünleri
                </p>

            </div>


            <a
                href="{{ route('shop') }}"
                class="btn btn-outline-dark"
            >
                Tüm Ürünler
            </a>

        </div>



        <div class="row g-4">

            @forelse($featuredProducts as $product)

                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">

                    <div
                        class="card h-100 border-0"
                        style="
                            border-radius:8px;
                            overflow:hidden;
                            box-shadow:0 5px 20px rgba(0,0,0,.08);
                        "
                    >


                        {{-- ÜRÜN GÖRSELİ --}}

                        @if($product->image)

                            <img
                                src="{{ asset('storage/'.$product->image) }}"
                                alt="{{ $product->name }}"
                                style="
                                    width:100%;
                                    height:230px;
                                    object-fit:cover;
                                "
                            >

                        @else

                            <div
                                style="
                                    width:100%;
                                    height:230px;
                                    display:flex;
                                    align-items:center;
                                    justify-content:center;
                                    background:#eef1f4;
                                    color:#7b8492;
                                    font-size:13px;
                                    font-weight:600;
                                "
                            >
                                Görsel Yok
                            </div>

                        @endif


                        <div class="card-body p-4">


                            @if($product->brand)

                                <div
                                    style="
                                        color:#8b94a3;
                                        font-size:10px;
                                        font-weight:700;
                                        text-transform:uppercase;
                                        margin-bottom:7px;
                                    "
                                >

                                    {{ $product->brand->name }}

                                </div>

                            @endif


                            <h5
                                class="fw-bold"
                                style="
                                    color:#172033;
                                    font-size:15px;
                                "
                            >

                                {{ $product->name }}

                            </h5>


                            <div
                                class="d-flex justify-content-between align-items-center mt-3"
                            >

                                <div
                                    style="
                                        color:#f26522;
                                        font-size:18px;
                                        font-weight:800;
                                    "
                                >

                                    {{ number_format($product->price,2,',','.') }}
                                    ₺

                                </div>


                                <a
                                    href="{{ route('product.show',$product) }}"
                                    style="
                                        width:38px;
                                        height:38px;
                                        display:flex;
                                        align-items:center;
                                        justify-content:center;
                                        border-radius:5px;
                                        background:#0d1a2d;
                                        color:#fff;
                                    "
                                >
                                    →
                                </a>

                            </div>

                        </div>

                    </div>

                </div>

            @empty

                <div class="col-12">

                    <div class="alert alert-info">

                        Henüz öne çıkan ürün bulunmuyor.

                    </div>

                </div>

            @endforelse

        </div>

    </div>

</section>



{{-- =====================================================
     KURUMSAL TEKLİF
===================================================== --}}

<section
    style="
        background:#f1f3f5;
        padding:70px 0;
    "
>

    <div class="container">

        <div
            class="row align-items-center"
        >

            <div class="col-lg-8">

                <div
                    style="
                        color:#f26522;
                        font-size:12px;
                        font-weight:800;
                        letter-spacing:1px;
                        margin-bottom:10px;
                    "
                >
                    KURUMSAL ÇÖZÜMLER
                </div>


                <h2
                    class="fw-bold"
                    style="
                        color:#0d1a2d;
                        font-size:32px;
                    "
                >
                    Kurumsal Alımlarınız İçin
                    Özel Teklif Alın
                </h2>


                <p
                    class="text-muted mb-0"
                    style="max-width:650px;"
                >

                    İş güvenliği ürünlerinde toplu alımlarınız
                    için bizimle iletişime geçin.
                    İhtiyacınıza uygun ürün ve fiyat seçenekleri
                    sunalım.

                </p>

            </div>


            <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">

                <a
                    href="{{ route('quote.create') }}"
                    class="hero-button"
                >

                    Teklif İsteyin

                </a>

            </div>

        </div>

    </div>

</section>



{{-- =====================================================
     BİZE ULAŞIN
===================================================== --}}

<section class="py-5 bg-white">

    <div class="container">

        <div class="row g-4 align-items-center">


            <div class="col-lg-6">

                <div
                    style="
                        color:#f26522;
                        font-size:12px;
                        font-weight:800;
                        letter-spacing:1px;
                        margin-bottom:8px;
                    "
                >
                    İLETİŞİM
                </div>


                <h2
                    class="fw-bold"
                    style="color:#0d1a2d;"
                >
                    Bize Ulaşın
                </h2>


                <p class="text-muted">

                    İş güvenliği ürünleri ve toplu alımlar
                    hakkında bilgi almak için bizimle
                    iletişime geçebilirsiniz.

                </p>


                <div class="mt-4">

                    <div class="mb-3">

                        <strong>
                            📞 Telefon
                        </strong>

                        <div class="text-muted">
                            05xx xxx xx xx
                        </div>

                    </div>


                    <div>

                        <strong>
                            ✉ E-posta
                        </strong>

                        <div class="text-muted">
                            info@guvenliisgiyim.com
                        </div>

                    </div>

                </div>

            </div>



            <div class="col-lg-6">

                <div
                    class="p-4"
                    style="
                        background:#0d1a2d;
                        border-radius:8px;
                        color:#fff;
                    "
                >

                    <h3 class="fw-bold">
                        Hızlı Teklif Alın
                    </h3>


                    <p
                        style="
                            color:#c8d0dc;
                            font-size:14px;
                        "
                    >

                        Toplu ürün alımlarınız için
                        teklif formumuzu doldurun.

                    </p>


                    <a
                        href="{{ route('quote.create') }}"
                        class="hero-button"
                    >

                        Teklif Formuna Git

                    </a>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection