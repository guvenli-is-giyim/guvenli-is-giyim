@extends('front.layouts.app')

@section('title','Ürünler')

@section('content')

{{-- =========================================================
     SHOP HERO
========================================================= --}}

<section class="shop-hero">

    <div class="container">

        <div class="shop-hero-content">

            <span>
                GÜVENLİ İŞ GİYİM
            </span>

            <h1>
                İş Güvenliği Ürünleri
            </h1>

            <p>
                Profesyonel iş güvenliği ürünlerini keşfedin.
            </p>

        </div>

    </div>

</section>



{{-- =========================================================
     PRODUCTS
========================================================= --}}

<section class="shop-section">

    <div class="container">

        <div class="row g-4">

            {{-- =================================================
                 SIDEBAR
            ================================================= --}}

            <div class="col-lg-3">

                <div class="shop-sidebar">

                    <div class="sidebar-title">

                        <span>
                            ÜRÜNLER
                        </span>

                        <h3>
                            Kategoriler
                        </h3>

                    </div>


                    <a
                        href="{{ route('shop') }}"
                        class="category-link {{ !request('category') ? 'active' : '' }}"
                    >

                        <span>
                            Tüm Ürünler
                        </span>

                        <strong>
                            →
                        </strong>

                    </a>


                    @foreach($categories as $category)

                        <a
                            href="{{ route('shop',['category'=>$category->id]) }}"
                            class="category-link {{ request('category') == $category->id ? 'active' : '' }}"
                        >

                            <span>
                                {{ $category->name }}
                            </span>

                            <strong>
                                →
                            </strong>

                        </a>

                    @endforeach

                </div>

            </div>



            {{-- =================================================
                 PRODUCT AREA
            ================================================= --}}

            <div class="col-lg-9">

                <div class="products-topbar">

                    <div>

                        <span class="products-label">
                            ÜRÜNLERİMİZ
                        </span>

                        <h2>
                            İş Güvenliği Ürünleri
                        </h2>

                    </div>


                    <div class="product-count">

                        {{ $products->total() }} ürün

                    </div>

                </div>



                <div class="row g-4">

                    @forelse($products as $product)

                        <div class="col-xl-4 col-md-6">

                            <div class="shop-product-card">


                                {{-- PRODUCT IMAGE --}}

                                <div class="shop-product-image">

                                    @if($product->image)

                                        <img
                                            src="{{ asset('storage/'.$product->image) }}"
                                            alt="{{ $product->name }}"
                                        >

                                    @else

                                        <div class="shop-no-image">

                                            <strong>
                                                GÜVENLİ İŞ GİYİM
                                            </strong>

                                            <span>
                                                Görsel Yok
                                            </span>

                                        </div>

                                    @endif


                                    @if($product->featured)

                                        <span class="featured-badge">
                                            ÖNE ÇIKAN
                                        </span>

                                    @endif

                                </div>



                                {{-- PRODUCT BODY --}}

                                <div class="shop-product-body">


                                    @if($product->category)

                                        <div class="shop-product-category">

                                            {{ $product->category->name }}

                                        </div>

                                    @endif


                                    <h3>

                                        {{ $product->name }}

                                    </h3>


                                    @if($product->brand)

                                        <div class="shop-product-brand">

                                            {{ $product->brand->name }}

                                        </div>

                                    @endif


                                    <div class="shop-product-price">

                                        {{ number_format($product->price,2,',','.') }} ₺

                                    </div>



                                    {{-- STOCK --}}

                                    <div class="stock-area">

                                        @if($product->stock <= 0)

                                            <span class="stock stock-out">

                                                <i></i>
                                                Tükendi

                                            </span>

                                        @elseif($product->stock <= 5)

                                            <span class="stock stock-low">

                                                <i></i>
                                                Son {{ $product->stock }} adet

                                            </span>

                                        @else

                                            <span class="stock stock-ok">

                                                <i></i>
                                                Stokta

                                            </span>

                                        @endif

                                    </div>



                                    <a
                                        href="{{ route('product.show',$product) }}"
                                        class="product-detail-button"
                                    >

                                        Ürün Detayı

                                        <span>
                                            →
                                        </span>

                                    </a>


                                </div>

                            </div>

                        </div>

                    @empty

                        <div class="col-12">

                            <div class="empty-shop">

                                <div class="empty-icon">
                                    !
                                </div>

                                <h3>
                                    Henüz ürün bulunmuyor.
                                </h3>

                                <p>
                                    Bu kategoride görüntülenecek ürün bulunamadı.
                                </p>

                                <a
                                    href="{{ route('shop') }}"
                                    class="btn btn-dark"
                                >
                                    Tüm Ürünlere Dön
                                </a>

                            </div>

                        </div>

                    @endforelse

                </div>



                {{-- PAGINATION --}}

                @if($products->hasPages())

                    <div class="shop-pagination">

                        {{ $products->links() }}

                    </div>

                @endif

            </div>

        </div>

    </div>

</section>



{{-- =========================================================
     QUOTE CTA
========================================================= --}}

<section class="shop-quote">

    <div class="container">

        <div class="shop-quote-box">

            <div>

                <span>
                    KURUMSAL ALIMLAR
                </span>

                <h2>
                    Toplu ürün alımlarınız için
                    <strong>teklif alın.</strong>
                </h2>

                <p>
                    İhtiyacınızı bize iletin, size özel kurumsal fiyat
                    teklifimizi hazırlayalım.
                </p>

            </div>


            <a
                href="{{ route('quote.create') }}"
                class="shop-quote-button"
            >

                Teklif Al

                <span>
                    →
                </span>

            </a>

        </div>

    </div>

</section>



{{-- =========================================================
     PAGE CSS
========================================================= --}}

<style>

:root {
    --shop-navy: #101b2d;
    --shop-dark: #0b1320;
    --shop-yellow: #f5b400;
    --shop-bg: #f5f7fa;
    --shop-border: #e4e7eb;
    --shop-muted: #6b7280;
}


/* =========================================================
   HERO
========================================================= */

.shop-hero {
    background:
        linear-gradient(
            135deg,
            #0b1320,
            #172943
        );

    padding: 65px 0;
}

.shop-hero-content span {
    color: var(--shop-yellow);
    font-size: 12px;
    font-weight: 800;
    letter-spacing: 2px;
}

.shop-hero-content h1 {
    color: #fff;
    font-size: 46px;
    font-weight: 800;
    margin: 12px 0;
}

.shop-hero-content p {
    color: rgba(255,255,255,.7);
    font-size: 17px;
    margin: 0;
}


/* =========================================================
   MAIN
========================================================= */

.shop-section {
    background: var(--shop-bg);
    padding: 70px 0;
}


/* =========================================================
   SIDEBAR
========================================================= */

.shop-sidebar {
    background: #fff;
    border: 1px solid var(--shop-border);
    padding: 25px;
    position: sticky;
    top: 25px;
}

.sidebar-title {
    margin-bottom: 18px;
}

.sidebar-title span {
    color: #b17d00;
    font-size: 11px;
    font-weight: 800;
    letter-spacing: 1.5px;
}

.sidebar-title h3 {
    color: var(--shop-dark);
    font-size: 24px;
    font-weight: 800;
    margin: 6px 0 0;
}

.category-link {
    display: flex;
    justify-content: space-between;
    align-items: center;

    padding: 14px 12px;

    color: #374151;
    text-decoration: none;

    border-bottom: 1px solid #eef0f2;

    font-size: 14px;
    font-weight: 600;

    transition: .2s ease;
}

.category-link strong {
    color: #9ca3af;
}

.category-link:hover {
    color: #111827;
    background: #f8fafc;
    padding-left: 17px;
}

.category-link.active {
    background: var(--shop-navy);
    color: #fff;
    border-color: var(--shop-navy);
}

.category-link.active strong {
    color: var(--shop-yellow);
}


/* =========================================================
   TOPBAR
========================================================= */

.products-topbar {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    margin-bottom: 30px;
}

.products-label {
    color: #b17d00;
    font-size: 11px;
    font-weight: 800;
    letter-spacing: 1.5px;
}

.products-topbar h2 {
    color: var(--shop-dark);
    font-size: 30px;
    font-weight: 800;
    margin: 6px 0 0;
}

.product-count {
    color: var(--shop-muted);
    font-size: 14px;
}


/* =========================================================
   PRODUCT CARD
========================================================= */

.shop-product-card {
    background: #fff;
    border: 1px solid var(--shop-border);
    height: 100%;
    transition: .25s ease;
}

.shop-product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 18px 35px rgba(0,0,0,.09);
}


/* =========================================================
   IMAGE
========================================================= */

.shop-product-image {
    height: 245px;
    background: #eef1f4;
    position: relative;
    overflow: hidden;
}

.shop-product-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: .3s ease;
}

.shop-product-card:hover .shop-product-image img {
    transform: scale(1.04);
}

.shop-no-image {
    width: 100%;
    height: 100%;

    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;

    background: #dfe4e9;
    color: var(--shop-navy);
}

.shop-no-image strong {
    font-size: 12px;
    letter-spacing: 1px;
}

.shop-no-image span {
    margin-top: 8px;
    font-size: 13px;
    color: #6b7280;
}


/* FEATURED */

.featured-badge {
    position: absolute;
    top: 15px;
    left: 15px;

    background: var(--shop-yellow);
    color: #111827;

    padding: 6px 10px;

    font-size: 10px;
    font-weight: 800;
}


/* =========================================================
   BODY
========================================================= */

.shop-product-body {
    padding: 22px;
}

.shop-product-category {
    color: #9ca3af;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    margin-bottom: 7px;
}

.shop-product-body h3 {
    color: var(--shop-dark);
    font-size: 18px;
    font-weight: 750;
    line-height: 1.35;
    min-height: 49px;
    margin: 0 0 7px;
}

.shop-product-brand {
    color: var(--shop-muted);
    font-size: 13px;
    margin-bottom: 13px;
}

.shop-product-price {
    color: var(--shop-navy);
    font-size: 21px;
    font-weight: 800;
    margin-bottom: 12px;
}


/* =========================================================
   STOCK
========================================================= */

.stock-area {
    min-height: 24px;
    margin-bottom: 17px;
}

.stock {
    font-size: 12px;
    font-weight: 700;
    display: inline-flex;
    align-items: center;
    gap: 7px;
}

.stock i {
    width: 7px;
    height: 7px;
    border-radius: 50%;
    display: inline-block;
}

.stock-ok {
    color: #15803d;
}

.stock-ok i {
    background: #22c55e;
}

.stock-low {
    color: #a16207;
}

.stock-low i {
    background: #eab308;
}

.stock-out {
    color: #dc2626;
}

.stock-out i {
    background: #ef4444;
}


/* =========================================================
   DETAIL BUTTON
========================================================= */

.product-detail-button {
    width: 100%;

    display: flex;
    justify-content: space-between;
    align-items: center;

    padding: 12px 15px;

    background: var(--shop-navy);
    color: #fff;

    text-decoration: none;

    font-size: 13px;
    font-weight: 700;

    transition: .2s ease;
}

.product-detail-button:hover {
    background: var(--shop-yellow);
    color: #111827;
}

.product-detail-button span {
    font-size: 18px;
}


/* =========================================================
   EMPTY
========================================================= */

.empty-shop {
    background: #fff;
    border: 1px solid var(--shop-border);
    text-align: center;
    padding: 60px 30px;
}

.empty-icon {
    width: 50px;
    height: 50px;
    margin: 0 auto 15px;

    border-radius: 50%;

    background: #fef3c7;
    color: #92400e;

    display: flex;
    align-items: center;
    justify-content: center;

    font-weight: 800;
}

.empty-shop h3 {
    font-size: 22px;
    font-weight: 800;
}

.empty-shop p {
    color: var(--shop-muted);
}


/* =========================================================
   PAGINATION
========================================================= */

.shop-pagination {
    margin-top: 35px;
}

.shop-pagination nav {
    display: flex;
    justify-content: center;
}


/* =========================================================
   QUOTE
========================================================= */

.shop-quote {
    background: var(--shop-navy);
    padding: 75px 0;
}

.shop-quote-box {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 35px;

    background: #172943;

    border: 1px solid rgba(255,255,255,.08);

    padding: 45px;
}

.shop-quote-box > div > span {
    color: var(--shop-yellow);
    font-size: 11px;
    font-weight: 800;
    letter-spacing: 2px;
}

.shop-quote-box h2 {
    color: #fff;
    font-size: 34px;
    font-weight: 800;
    margin: 10px 0;
}

.shop-quote-box h2 strong {
    color: var(--shop-yellow);
}

.shop-quote-box p {
    color: rgba(255,255,255,.7);
    margin: 0;
    line-height: 1.7;
}

.shop-quote-button {
    flex-shrink: 0;

    background: var(--shop-yellow);
    color: #111827;

    text-decoration: none;

    padding: 14px 27px;

    font-weight: 800;

    transition: .2s ease;
}

.shop-quote-button:hover {
    background: #fff;
    color: #111827;
}

.shop-quote-button span {
    margin-left: 10px;
}


/* =========================================================
   MOBILE
========================================================= */

@media (max-width: 991px) {

    .shop-sidebar {
        position: static;
    }

}

@media (max-width: 767px) {

    .shop-hero {
        padding: 50px 0;
    }

    .shop-hero-content h1 {
        font-size: 36px;
    }

    .shop-section {
        padding: 50px 0;
    }

    .products-topbar {
        align-items: flex-start;
        flex-direction: column;
        gap: 10px;
    }

    .products-topbar h2 {
        font-size: 26px;
    }

    .shop-product-image {
        height: 220px;
    }

    .shop-quote-box {
        padding: 30px;
        flex-direction: column;
        align-items: flex-start;
    }

    .shop-quote-box h2 {
        font-size: 28px;
    }

}

</style>

@endsection