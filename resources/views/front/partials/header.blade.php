{{-- TOP BAR --}}
<div style="background:#0f1d33;color:#fff;font-size:14px;">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center py-2">

            <div class="d-flex gap-4">
                <span>🚚 750 TL ve Üzeri Ücretsiz Kargo</span>
                <span>📦 Hızlı Teslimat</span>
            </div>

            <div class="d-flex gap-4">
                <a href="#" class="text-white text-decoration-none">Hakkımızda</a>
                <a href="#" class="text-white text-decoration-none">İletişim</a>
                <a href="#" class="text-white text-decoration-none">Yardım</a>

                <a href="#" class="text-success text-decoration-none fw-bold">
                    WhatsApp Destek
                </a>
            </div>

        </div>
    </div>
</div>

{{-- HEADER --}}
<header class="bg-white border-bottom">

    <div class="container">

        <div class="row align-items-center py-3">

            {{-- LOGO --}}
            <div class="col-lg-3">

                <a href="{{ route('home') }}" class="text-decoration-none">

                    <h2 class="m-0 fw-bold">

                        <span style="color:#0f1d33;">GÜVENLİ</span>

                        <span style="color:#ff9800;"> İŞ</span>

                    </h2>

                    <small class="text-muted">
                        İş Güvenliği Ekipmanları
                    </small>

                </a>

            </div>

            {{-- SEARCH --}}
            <div class="col-lg-5">

                <form>

                    <div class="input-group">

                        <input
                            type="text"
                            class="form-control"
                            placeholder="Ürün, kategori veya marka ara...">

                        <button
                            class="btn btn-warning"
                            type="submit">

                            🔍

                        </button>

                    </div>

                </form>

            </div>

            {{-- RIGHT --}}
            <div class="col-lg-4">

                <div class="d-flex justify-content-end gap-4">

                    <a href="#" class="text-dark text-decoration-none">
                        👤 Hesabım
                    </a>

                    <a href="#" class="text-dark text-decoration-none">
                        ❤ Favoriler
                    </a>

                    <a href="#" class="text-dark text-decoration-none">
                        🛒 Sepet
                    </a>

                </div>

            </div>

        </div>

    </div>

</header>

{{-- NAVBAR --}}
<nav style="background:#101B2D;">

    <div class="container">

        <div class="d-flex align-items-center">

            <a
                href="#"
                class="text-white text-decoration-none px-4 py-3 fw-bold">

                ☰ TÜM KATEGORİLER

            </a>

            <a href="#" class="text-white text-decoration-none px-3">
                İş Eldivenleri
            </a>

            <a href="#" class="text-white text-decoration-none px-3">
                İş Ayakkabıları
            </a>

            <a href="#" class="text-white text-decoration-none px-3">
                İş Elbiseleri
            </a>

            <a href="#" class="text-white text-decoration-none px-3">
                Baret
            </a>

            <div class="ms-auto">

                <a
                    href="{{ route('quote.create') }}"
                    class="btn btn-warning">

                    TEKLİF AL

                </a>

            </div>

        </div>

    </div>

</nav>