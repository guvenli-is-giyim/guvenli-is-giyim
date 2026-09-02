<!DOCTYPE html>
<html lang="tr">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'Güvenli İş Giyim')
    </title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    <style>

        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            padding: 0;
            width: 100%;
            overflow-x: hidden;
        }

        body {
            font-family: 'Montserrat', Arial, sans-serif;
            background: #f5f6f8;
            color: #172033;
        }

        a {
            text-decoration: none;
        }

        img {
            max-width: 100%;
        }


        /* =====================================================
           GENEL CONTAINER
        ===================================================== */

        .container {
            width: 100%;
            max-width: 1400px;
            margin-left: auto;
            margin-right: auto;
            padding-left: 20px;
            padding-right: 20px;
        }


        /* =====================================================
           ÜST BİLGİ BAR
        ===================================================== */

        .top-info {
            width: 100%;
            background: #0d1a2d;
            color: #ffffff;
            font-size: 12px;
            padding: 8px 0;
        }

        .top-info .container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .top-info-left,
        .top-info-right {
            display: flex;
            align-items: center;
            gap: 25px;
        }


        /* =====================================================
           ANA HEADER
        ===================================================== */

        .main-header {
            width: 100%;
            background: #ffffff;
            border-bottom: 1px solid #e5e7eb;
            padding: 18px 0;
        }

        .header-row {
            width: 100%;
            display: flex;
            align-items: center;
            gap: 25px;
        }


        /* LOGO */

        .site-logo {
            flex: 0 0 210px;
            width: 210px;
            color: #0d1a2d;
            font-weight: 800;
            font-size: 24px;
            line-height: 1.05;
        }

        .site-logo:hover {
            color: #0d1a2d;
        }

        .site-logo span {
            display: block;
            color: #f26522;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1px;
            margin-top: 6px;
        }


        /* ARAMA */

        .search-area {
            flex: 1 1 auto;
            min-width: 0;
            max-width: 650px;
            margin: 0 auto;
            display: flex;
        }

        .search-area input {
            flex: 1;
            min-width: 0;
            height: 45px;
            border: 1px solid #d7dce3;
            border-right: none;
            border-radius: 6px 0 0 6px;
            padding: 0 18px;
            outline: none;
            font-size: 13px;
        }

        .search-area input:focus {
            border-color: #f26522;
        }

        .search-area button {
            flex: 0 0 75px;
            width: 75px;
            height: 45px;
            border: none;
            border-radius: 0 6px 6px 0;
            background: #f26522;
            color: #ffffff;
            font-weight: 700;
        }


        /* SAĞ HEADER */

        .header-actions {
            flex: 0 0 auto;
            display: flex;
            align-items: center;
            gap: 20px;
            white-space: nowrap;
        }

        .header-action {
            color: #172033;
            text-align: center;
            font-size: 11px;
            font-weight: 700;
        }

        .header-action:hover {
            color: #f26522;
        }

        .header-action-icon {
            display: block;
            font-size: 21px;
            line-height: 25px;
            margin-bottom: 2px;
        }


        /* =====================================================
           ÜST KATEGORİ MENÜSÜ
        ===================================================== */

        .category-navigation {
            width: 100%;
            background: #ffffff;
            border-bottom: 1px solid #e5e7eb;
        }

        .category-nav-row {
            width: 100%;
            display: flex;
            align-items: stretch;
            min-height: 55px;
        }

        .all-categories {
            flex: 0 0 275px;
            width: 275px;
            min-width: 275px;

            display: flex;
            align-items: center;
            justify-content: center;
            gap: 9px;

            background: #f26522;
            color: #ffffff;

            font-size: 14px;
            font-weight: 800;

            white-space: nowrap;
        }

        .all-categories:hover {
            background: #db5517;
            color: #ffffff;
        }

        .category-links {
            flex: 1 1 auto;
            min-width: 0;

            display: flex;
            align-items: stretch;

            overflow-x: auto;
            overflow-y: hidden;
            scrollbar-width: none;
        }

        .category-links::-webkit-scrollbar {
            display: none;
        }

        .category-links a {
            flex: 0 0 auto;

            display: flex;
            align-items: center;
            justify-content: center;

            height: 55px;
            padding: 0 18px;

            color: #172033;

            font-size: 12px;
            font-weight: 700;

            white-space: nowrap;

            border-right: 1px solid #eeeeee;

            transition: .2s;
        }

        .category-links a:hover {
            color: #f26522;
            background: #fafafa;
        }


        /* =====================================================
           AVANTAJ / GÜVEN SATIRI
        ===================================================== */

        .benefit-bar {
            width: 100%;
            background: #0d1a2d;
            color: #ffffff;
            padding: 13px 0;
        }

        .benefit-row {
            width: 100%;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
            align-items: center;
        }

        .benefit-item {
            font-size: 12px;
            font-weight: 600;
            text-align: center;
            white-space: nowrap;
        }

        .benefit-item::before {
            content: "✓";
            color: #f26522;
            font-weight: 900;
            margin-right: 7px;
        }


        /* =====================================================
           ANA İÇERİK
        ===================================================== */

        .front-main {
            width: 100%;
            min-height: 400px;
            overflow: hidden;
        }


        /* =====================================================
           HOME / HERO
        ===================================================== */

        .hero-section {
            width: 100%;
            background: #0d1a2d;
            padding: 25px 0 30px;
        }

        .hero-layout {
            width: 100%;
            display: grid;
            grid-template-columns: 300px minmax(0, 1fr);
            gap: 20px;
        }


        /* SOL KATEGORİ KUTUSU */

        .hero-categories {
            width: 100%;
            background: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0,0,0,.12);
        }

        .hero-category-title {
            background: #f26522;
            color: #ffffff;
            padding: 18px 20px;
            font-size: 17px;
            font-weight: 800;
        }

        .hero-category-list {
            padding: 5px 0;
        }

        .hero-category-list a {
            display: flex;
            align-items: center;

            width: 100%;

            padding: 12px 18px;

            color: #263246;

            font-size: 12px;
            font-weight: 600;

            border-bottom: 1px solid #f0f0f0;

            transition: .2s;
        }

        .hero-category-list a:hover {
            background: #fff4ee;
            color: #f26522;
            padding-left: 23px;
        }


        /* =====================================================
           SLIDER
        ===================================================== */

        .hero-slider {
            position: relative;
            width: 100%;
            min-width: 0;

            height: 430px;

            background: #14253e;

            border-radius: 8px;
            overflow: hidden;
        }

        .hero-slider .carousel,
        .hero-slider .carousel-inner,
        .hero-slider .carousel-item {
            width: 100%;
            height: 430px;
        }

        .hero-slider img {
            display: block;
            width: 100%;
            height: 430px;
            object-fit: cover;
        }

        .hero-overlay {
            position: absolute;
            inset: 0;

            display: flex;
            align-items: center;

            padding: 45px;

            background:
                linear-gradient(
                    90deg,
                    rgba(7,18,34,.92) 0%,
                    rgba(7,18,34,.60) 45%,
                    rgba(7,18,34,.05) 100%
                );
        }

        .hero-content {
            max-width: 540px;
            color: #ffffff;
        }

        .hero-small-title {
            font-size: 15px;
            font-weight: 700;
            letter-spacing: 1.5px;
            margin-bottom: 10px;
        }

        .hero-title {
            margin: 0 0 15px;
            font-size: 42px;
            line-height: 1.08;
            font-weight: 800;
        }

        .hero-description {
            max-width: 450px;
            margin-bottom: 22px;
            font-size: 15px;
            line-height: 1.6;
        }

        .hero-button {
            display: inline-block;

            padding: 12px 24px;

            border-radius: 5px;

            background: #f26522;
            color: #ffffff;

            font-size: 13px;
            font-weight: 800;
        }

        .hero-button:hover {
            background: #db5517;
            color: #ffffff;
        }


        /* =====================================================
           HIZLI KATEGORİLER
        ===================================================== */

        .quick-categories {
            width: 100%;
            background: #ffffff;
            padding: 22px 0;
            border-bottom: 1px solid #e5e7eb;
        }

        .quick-category-row {
            display: grid;
            grid-template-columns: repeat(8, 1fr);
            gap: 10px;
        }

        .quick-category {
            text-align: center;
            color: #172033;
            font-size: 11px;
            font-weight: 700;
            padding: 5px;
            transition: .2s;
        }

        .quick-category:hover {
            color: #f26522;
            transform: translateY(-2px);
        }

        .quick-category-icon {
            width: 58px;
            height: 58px;
            margin: 0 auto 8px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 50%;
            background: #f1f3f5;

            font-size: 23px;
        }


        /* =====================================================
           İSTATİSTİK
        ===================================================== */

        .stats-section {
            width: 100%;
            background: #0d1a2d;
            color: #ffffff;
            padding: 20px 0;
        }

        .stats-row {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
        }

        .stat-box {
            text-align: center;
            padding: 5px 15px;
            border-right: 1px solid rgba(255,255,255,.18);
        }

        .stat-box:last-child {
            border-right: none;
        }

        .stat-number {
            display: block;
            font-size: 24px;
            font-weight: 800;
        }

        .stat-text {
            font-size: 11px;
            opacity: .85;
        }


        /* =====================================================
           FOOTER
        ===================================================== */

        .footer {
            width: 100%;
            background: #0d1a2d;
            color: #ffffff;
            padding: 45px 0 20px;
            margin-top: 40px;
        }

        .footer-title {
            font-weight: 800;
            margin-bottom: 15px;
        }

        .footer-text {
            color: #c8d0dc;
            font-size: 13px;
            line-height: 1.7;
        }

        .footer-links {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-links li {
            margin-bottom: 8px;
        }

        .footer-links a {
            color: #c8d0dc;
            font-size: 13px;
        }

        .footer-links a:hover {
            color: #f26522;
        }

        .footer-bottom {
            border-top: 1px solid rgba(255,255,255,.15);
            margin-top: 30px;
            padding-top: 18px;

            color: #aeb7c4;

            font-size: 12px;
            text-align: center;
        }


        /* =====================================================
           WHATSAPP
        ===================================================== */

        .whatsapp-button {
            position: fixed;

            right: 25px;
            bottom: 25px;

            width: 60px;
            height: 60px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 50%;

            background: #25D366;
            color: #ffffff;

            font-size: 27px;

            text-decoration: none;

            z-index: 9999;

            box-shadow: 0 5px 20px rgba(0,0,0,.25);
        }

        .whatsapp-button:hover {
            color: #ffffff;
            transform: scale(1.05);
        }


        /* =====================================================
           TABLET
        ===================================================== */

        @media (max-width: 1100px) {

            .site-logo {
                flex-basis: 180px;
                width: 180px;
                font-size: 21px;
            }

            .header-actions {
                gap: 10px;
            }

            .hero-layout {
                grid-template-columns: 260px minmax(0, 1fr);
            }

            .all-categories {
                flex-basis: 240px;
                width: 240px;
                min-width: 240px;
            }

            .quick-category-row {
                grid-template-columns: repeat(4, 1fr);
            }

        }


        /* =====================================================
           MOBİL
        ===================================================== */

        @media (max-width: 992px) {

            .top-info {
                display: none;
            }

            .header-row {
                flex-wrap: wrap;
            }

            .site-logo {
                flex: 1;
                width: auto;
            }

            .header-actions {
                display: none;
            }

            .search-area {
                order: 3;
                flex-basis: 100%;
                max-width: none;
                margin-top: 5px;
            }

            .category-nav-row {
                display: block;
            }

            .all-categories {
                width: 100%;
                min-width: 100%;
                height: 52px;
            }

            .category-links {
                width: 100%;
                overflow-x: auto;
            }

            .category-links a {
                height: 50px;
            }

            .benefit-row {
                grid-template-columns: repeat(2, 1fr);
            }

            .benefit-item {
                white-space: normal;
            }

            .hero-layout {
                grid-template-columns: 1fr;
            }

            .hero-categories {
                order: 2;
            }

            .hero-slider {
                order: 1;
            }

            .hero-category-list {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
            }

            .stats-row {
                grid-template-columns: repeat(2, 1fr);
            }

            .stat-box {
                border-right: none;
                border-bottom: 1px solid rgba(255,255,255,.15);
            }

        }


        /* =====================================================
           TELEFON
        ===================================================== */

        @media (max-width: 576px) {

            .container {
                padding-left: 15px;
                padding-right: 15px;
            }

            .site-logo {
                font-size: 19px;
            }

            .site-logo span {
                font-size: 8px;
            }

            .benefit-row {
                grid-template-columns: 1fr;
            }

            .hero-slider,
            .hero-slider .carousel,
            .hero-slider .carousel-inner,
            .hero-slider .carousel-item,
            .hero-slider img {
                height: 350px;
            }

            .hero-overlay {
                padding: 25px;
            }

            .hero-title {
                font-size: 30px;
            }

            .hero-description {
                font-size: 13px;
            }

            .hero-category-list {
                grid-template-columns: 1fr;
            }

            .quick-category-row {
                grid-template-columns: repeat(2, 1fr);
            }

            .stats-row {
                grid-template-columns: repeat(2, 1fr);
            }

        }

    </style>

</head>


<body>


{{-- =====================================================
     ÜST BİLGİ
===================================================== --}}

<div class="top-info">

    <div class="container">

        <div class="top-info-left">

            <span>
                ✓ 100% Güvenli Alışveriş
            </span>

            <span>
                ✓ Kurumsal Alımlara Özel
            </span>

        </div>

        <div class="top-info-right">

            <span>
                Hızlı Teslimat
            </span>

            <span>
                7/24 Destek
            </span>

        </div>

    </div>

</div>



{{-- =====================================================
     ANA HEADER
===================================================== --}}

<header class="main-header">

    <div class="container">

        <div class="header-row">


            {{-- LOGO --}}

            <a
                href="{{ route('home') }}"
                class="site-logo"
            >

                GÜVENLİ İŞ GİYİM

                <span>
                    İŞ GÜVENLİĞİ ÜRÜNLERİ
                </span>

            </a>



            {{-- ARAMA --}}

            <form
                action="{{ route('shop') }}"
                method="GET"
                class="search-area"
            >

                <input
                    type="text"
                    name="search"
                    placeholder="Aramak istediğiniz ürünü yazın..."
                >

                <button type="submit">
                    Ara
                </button>

            </form>



            {{-- SAĞ BUTONLAR --}}

            <div class="header-actions">

                <a
                    href="#"
                    class="header-action"
                >

                    <span class="header-action-icon">
                        👤
                    </span>

                    Hesabım

                </a>


                <a
                    href="#"
                    class="header-action"
                >

                    <span class="header-action-icon">
                        ♡
                    </span>

                    Favoriler

                </a>


                <a
                    href="#"
                    class="header-action"
                >

                    <span class="header-action-icon">
                        🛒
                    </span>

                    Sepetim

                </a>

            </div>

        </div>

    </div>

</header>



{{-- =====================================================
     TEK KATEGORİ MENÜSÜ
===================================================== --}}

<nav class="category-navigation">

    <div class="container">

        <div class="category-nav-row">


            <a
                href="{{ route('shop') }}"
                class="all-categories"
            >

                <span>☰</span>

                <span>TÜM KATEGORİLER</span>

            </a>


            <div class="category-links">

                @if(isset($categories))

                    @foreach($categories as $category)

                        <a
                            href="{{ route('shop',['category'=>$category->id]) }}"
                        >

                            {{ $category->name }}

                        </a>

                    @endforeach

                @else

                    <a href="{{ route('shop') }}">
                        İŞ GÜVENLİĞİ
                    </a>

                    <a href="{{ route('shop') }}">
                        İŞ AYAKKABILARI
                    </a>

                    <a href="{{ route('shop') }}">
                        İŞ ELBİSELERİ
                    </a>

                    <a href="{{ route('shop') }}">
                        BARETLER
                    </a>

                    <a href="{{ route('shop') }}">
                        ELDİVENLER
                    </a>

                @endif

            </div>

        </div>

    </div>

</nav>



{{-- =====================================================
     AVANTAJLAR
===================================================== --}}

<div class="benefit-bar">

    <div class="container">

        <div class="benefit-row">

            <div class="benefit-item">
                Kaliteli ve Güvenilir Ürünler
            </div>

            <div class="benefit-item">
                Kurumsal Alımlara Özel Fiyatlar
            </div>

            <div class="benefit-item">
                Hızlı Teslimat
            </div>

            <div class="benefit-item">
                7/24 Destek
            </div>

        </div>

    </div>

</div>



{{-- =====================================================
     SAYFA İÇERİĞİ
===================================================== --}}

<main class="front-main">

    @yield('content')

</main>



{{-- =====================================================
     WHATSAPP
===================================================== --}}

<a
    href="https://wa.me/905000000000"
    target="_blank"
    class="whatsapp-button"
    title="WhatsApp"
>
    ☎
</a>



{{-- =====================================================
     FOOTER
===================================================== --}}

<footer class="footer">

    <div class="container">

        <div class="row g-4">


            <div class="col-lg-4 col-md-6">

                <h4 class="footer-title">
                    GÜVENLİ İŞ GİYİM
                </h4>

                <p class="footer-text">

                    Profesyonel iş güvenliği ürünleri,
                    kurumsal çözümler ve toplu alımlarda
                    güvenilir hizmet.

                </p>

            </div>



            <div class="col-lg-2 col-md-6">

                <h5 class="footer-title">
                    Hızlı Menü
                </h5>

                <ul class="footer-links">

                    <li>
                        <a href="{{ route('home') }}">
                            Ana Sayfa
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('shop') }}">
                            Ürünler
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('quote.create') }}">
                            Teklif Al
                        </a>
                    </li>

                </ul>

            </div>



            <div class="col-lg-3 col-md-6">

                <h5 class="footer-title">
                    Kategoriler
                </h5>

                <ul class="footer-links">

                    @if(isset($categories))

                        @foreach($categories->take(5) as $category)

                            <li>

                                <a
                                    href="{{ route('shop',['category'=>$category->id]) }}"
                                >

                                    {{ $category->name }}

                                </a>

                            </li>

                        @endforeach

                    @endif

                </ul>

            </div>



            <div class="col-lg-3 col-md-6">

                <h5 class="footer-title">
                    Bize Ulaşın
                </h5>

                <p class="footer-text mb-1">
                    📞 05xx xxx xx xx
                </p>

                <p class="footer-text mb-1">
                    ✉ info@guvenliisgiyim.com
                </p>

                <p class="footer-text">
                    📍 Türkiye
                </p>

            </div>

        </div>


        <div class="footer-bottom">

            © {{ date('Y') }} Güvenli İş Giyim.
            Tüm hakları saklıdır.

        </div>

    </div>

</footer>



<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>


</body>

</html>