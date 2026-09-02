@if($banners->count())

<div id="homeSlider" class="carousel slide carousel-fade" data-bs-ride="carousel">

    <div class="carousel-inner">

        @foreach($banners as $banner)

            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">

                <div style="position:relative;height:650px;overflow:hidden;">

                    <img src="{{ asset('uploads/banners/'.$banner->image) }}"
                         class="w-100 h-100"
                         style="object-fit:cover;">

                    <div style="position:absolute;inset:0;background:rgba(0,0,0,.45);"></div>

                    <div class="container h-100">

                        <div class="row h-100 align-items-center">

                            <div class="col-lg-7">

                                @if($banner->subtitle)
                                    <div class="section-eyebrow text-warning mb-3">
                                        {{ $banner->subtitle }}
                                    </div>
                                @endif

                                <h1 class="display-3 fw-bold text-white mb-4">
                                    {{ $banner->title }}
                                </h1>

                                @if($banner->button_text)
                                    <a href="{{ $banner->button_link }}"
                                       class="btn btn-warning btn-lg px-5">
                                        {{ $banner->button_text }}
                                    </a>
                                @endif

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        @endforeach

    </div>

    @if($banners->count() > 1)

        <button class="carousel-control-prev"
                type="button"
                data-bs-target="#homeSlider"
                data-bs-slide="prev">

            <span class="carousel-control-prev-icon"></span>

        </button>

        <button class="carousel-control-next"
                type="button"
                data-bs-target="#homeSlider"
                data-bs-slide="next">

            <span class="carousel-control-next-icon"></span>

        </button>

    @endif

</div>

@else

<section style="background: var(--navy); position:relative; overflow:hidden;">
    <div class="container py-5">
        <div class="row align-items-center gy-4">
            <div class="col-lg-7">
                <div class="section-eyebrow mb-2">İş Güvenliği Ekipmanları</div>

                <h1 class="text-white mb-3" style="font-size:3.2rem; line-height:1;">
                    Profesyonel İş Güvenliği<br>
                    Ekipmanları
                </h1>

                <p class="text-white-50 mb-4" style="max-width:480px;font-size:1.05rem;">
                    Kaliteli, güvenli ve dayanıklı ürünler uygun fiyat avantajlarıyla.
                    Şantiyeden fabrikaya, her iş kolu için doğru koruma.
                </p>

                <a href="{{ route('shop') }}" class="btn btn-cta btn-lg">
                    Ürünleri İncele →
                </a>

                <a href="{{ route('quote.create') }}"
                   class="btn btn-lg ms-2"
                   style="border:1px solid rgba(255,255,255,.4);color:#fff;">
                    Teklif Al
                </a>

            </div>

            <div class="col-lg-5">

                <div class="d-flex align-items-center justify-content-center"
                     style="height:260px;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);border-radius:8px;">

                    <span style="font-size:5rem;">⛑️</span>

                </div>

            </div>

        </div>
    </div>

    <div class="hazard-stripe"
         style="position:absolute;bottom:0;left:0;right:0;">
    </div>

</section>

@endif