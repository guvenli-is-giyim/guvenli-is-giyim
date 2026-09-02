<!DOCTYPE html>
<html lang="tr">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Güvenli İş Giyim Admin Paneli</title>

    @vite(['resources/css/app.css','resources/js/app.js'])

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="d-flex">

    <aside class="bg-dark text-white d-flex flex-column" style="width:260px;min-height:100vh;">

        <div class="p-4 border-bottom text-center">

            <h4 class="mb-0">

                Güvenli İş Giyim

            </h4>

            <small class="text-secondary">
                Admin Paneli
            </small>

        </div>

        <div class="list-group list-group-flush">

            <a href="{{ route('admin.dashboard') }}"
               class="list-group-item list-group-item-action">
                🏠 Dashboard
            </a>

            <a href="{{ route('admin.products.index') }}"
               class="list-group-item list-group-item-action">
                📦 Ürünler
            </a>

            <a href="{{ route('admin.categories.index') }}"
               class="list-group-item list-group-item-action">
                📂 Kategoriler
            </a>

            <a href="{{ route('admin.brands.index') }}"
               class="list-group-item list-group-item-action">
                🏷️ Markalar
            </a>

            <a href="{{ route('admin.colors.index') }}"
               class="list-group-item list-group-item-action">
                🎨 Renkler
            </a>

            <a href="{{ route('admin.sizes.index') }}"
               class="list-group-item list-group-item-action">
                📏 Bedenler
            </a>

            <a href="{{ route('admin.orders.index') }}"
               class="list-group-item list-group-item-action">
                🛒 Siparişler
            </a>

            <a href="{{ route('admin.customers.index') }}"
               class="list-group-item list-group-item-action">
                👥 Müşteriler
            </a>

            <a href="{{ route('admin.quote-requests.index') }}"
               class="list-group-item list-group-item-action">
                📋 Teklif Talepleri
            </a>

            <a href="{{ route('admin.banners.index') }}"
               class="list-group-item list-group-item-action">
                🖼️ Bannerlar
            </a>

            <a href="{{ route('admin.settings.index') }}"
               class="list-group-item list-group-item-action">
                ⚙️ Ayarlar
            </a>

        </div>

        <div class="p-3 border-top mt-auto">

            <form method="POST" action="{{ route('admin.logout') }}">

                @csrf

                <button type="submit" class="btn btn-outline-light w-100">

                    🚪 Çıkış Yap

                </button>

            </form>

        </div>

    </aside>

    <main class="flex-grow-1 p-4">

        @yield('content')

    </main>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>