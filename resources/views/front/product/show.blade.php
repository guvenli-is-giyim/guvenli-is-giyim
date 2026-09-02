@extends('front.layouts.app')

@section('title', $product->name)

@section('content')

<section class="py-5 bg-light">

    <div class="container">

        <div class="row g-5 align-items-start">

            {{-- ÜRÜN GÖRSELİ --}}
            <div class="col-lg-6">

                <div class="bg-white rounded shadow-sm p-3">

                    @if($product->image)

                        <img
                            src="{{ asset('storage/'.$product->image) }}"
                            alt="{{ $product->name }}"
                            class="img-fluid w-100"
                            style="height:500px; object-fit:contain;"
                        >

                    @else

                        <div
                            class="d-flex align-items-center justify-content-center"
                            style="
                                height:500px;
                                background:#eef1f4;
                                color:#777;
                            "
                        >
                            Görsel Yok
                        </div>

                    @endif

                </div>

            </div>


            {{-- ÜRÜN BİLGİLERİ --}}
            <div class="col-lg-6">

                <div class="bg-white rounded shadow-sm p-4">

                    {{-- MARKA --}}
                    @if($product->brand)

                        <div
                            class="text-muted mb-2"
                            style="
                                font-size:12px;
                                font-weight:700;
                                text-transform:uppercase;
                            "
                        >
                            {{ $product->brand->name }}
                        </div>

                    @endif


                    {{-- ÜRÜN ADI --}}
                    <h1
                        class="fw-bold mb-3"
                        style="
                            color:#101B2D;
                            font-size:32px;
                        "
                    >
                        {{ $product->name }}
                    </h1>


                    {{-- FİYAT --}}
                    <div
                        class="mb-4"
                        style="
                            color:#f26522;
                            font-size:28px;
                            font-weight:800;
                        "
                    >
                        {{ number_format($product->price,2,',','.') }} ₺
                    </div>


                    {{-- STOK --}}
                    @if($product->stock <= 0)

                        <span class="badge bg-danger mb-3">
                            Tükendi
                        </span>

                    @elseif($product->stock <= 5)

                        <span class="badge bg-warning text-dark mb-3">
                            Son {{ $product->stock }} adet
                        </span>

                    @else

                        <span class="badge bg-success mb-3">
                            Stokta
                        </span>

                    @endif


                    {{-- KISA AÇIKLAMA --}}
                    @if($product->short_description)

                        <div class="mt-4">

                            <p class="text-muted">
                                {{ $product->short_description }}
                            </p>

                        </div>

                    @endif


                    <hr>


                    {{-- FORM --}}
                    <form
                        action="{{ route('quote.create') }}"
                        method="GET"
                        id="productSelectionForm"
                    >

                        <input
                            type="hidden"
                            name="product_id"
                            value="{{ $product->id }}"
                        >


                        {{-- ========================= --}}
                        {{-- RENK --}}
                        {{-- ========================= --}}

                        @if($product->colors->count())

                            <div class="mb-4">

                                <h6 class="fw-bold mb-2">
                                    Renk:
                                </h6>

                                <div class="d-flex flex-wrap gap-2">

                                    @foreach($product->colors as $color)

                                        <button
                                            type="button"
                                            class="selection-button color-button"
                                            data-type="color"
                                            data-id="{{ $color->id }}"
                                            data-name="{{ $color->name }}"
                                        >

                                            <span
                                                class="color-circle"
                                                style="
                                                    background-color: {{ $color->code ?: '#ddd' }};
                                                "
                                            ></span>

                                            {{ $color->name }}

                                        </button>

                                    @endforeach

                                </div>

                                <input
                                    type="hidden"
                                    name="color_id"
                                    id="selectedColor"
                                    value=""
                                >

                                <div
                                    id="selectedColorText"
                                    class="selected-text"
                                ></div>

                            </div>

                        @endif


                        {{-- ========================= --}}
                        {{-- BEDEN --}}
                        {{-- ========================= --}}

                        @if($product->sizes->count())

                            <div class="mb-4">

                                <h6 class="fw-bold mb-2">
                                    Beden:
                                </h6>

                                <div class="d-flex flex-wrap gap-2">

                                    @foreach($product->sizes as $size)

                                        <button
                                            type="button"
                                            class="selection-button size-button"
                                            data-type="size"
                                            data-id="{{ $size->id }}"
                                            data-name="{{ $size->name }}"
                                        >
                                            {{ $size->name }}
                                        </button>

                                    @endforeach

                                </div>

                                <input
                                    type="hidden"
                                    name="size_id"
                                    id="selectedSize"
                                    value=""
                                >

                                <div
                                    id="selectedSizeText"
                                    class="selected-text"
                                ></div>

                            </div>

                        @endif


                        {{-- UYARI --}}
                        <div
                            id="selectionWarning"
                            class="selection-warning"
                        >
                            Lütfen beden ve renk seçiniz.
                        </div>


                        {{-- TEKLİF --}}
                        <button
                            type="submit"
                            class="btn btn-warning w-100 py-3 fw-bold mt-2"
                            @if($product->stock <= 0)
                                disabled
                            @endif
                        >
                            Kurumsal Teklif Al
                        </button>

                    </form>


                    {{-- ÜRÜNLERE DÖN --}}
                    <a
                        href="{{ route('shop') }}"
                        class="btn btn-outline-dark w-100 mt-2 py-3"
                    >
                        Ürünlere Dön
                    </a>

                </div>

            </div>

        </div>


        {{-- ÜRÜN AÇIKLAMASI --}}
        @if($product->description)

            <div class="row mt-5">

                <div class="col-12">

                    <div class="bg-white rounded shadow-sm p-4">

                        <h3
                            class="fw-bold mb-3"
                            style="color:#101B2D;"
                        >
                            Ürün Açıklaması
                        </h3>

                        <div class="text-muted">
                            {!! nl2br(e($product->description)) !!}
                        </div>

                    </div>

                </div>

            </div>

        @endif

    </div>

</section>


<style>

/* SEÇİM BUTONLARI */

.selection-button {
    appearance: none;
    -webkit-appearance: none;

    border: 2px solid #d5d9de;

    background: #ffffff;

    color: #101B2D;

    border-radius: 6px;

    padding: 9px 15px;

    font-size: 14px;

    font-weight: 600;

    cursor: pointer;

    transition: all .15s ease;

    display: inline-flex;

    align-items: center;

    justify-content: center;

    min-height: 42px;
}


/* HOVER */

.selection-button:hover {
    border-color: #101B2D;
    background: #f3f5f7;
}


/* SEÇİLİ */

.selection-button.selected {
    background: #101B2D !important;
    border-color: #101B2D !important;
    color: #ffffff !important;
}


/* RENK DAİRESİ */

.color-circle {
    width: 18px;
    height: 18px;

    border-radius: 50%;

    display: inline-block;

    margin-right: 7px;

    border: 1px solid #999;

    flex-shrink: 0;
}


/* SEÇİLEN BİLGİ */

.selected-text {
    margin-top: 8px;

    font-size: 13px;

    font-weight: 600;

    color: #101B2D;
}


/* UYARI */

.selection-warning {
    display: none;

    background: #fff3cd;

    border: 1px solid #ffecb5;

    color: #664d03;

    padding: 10px 12px;

    border-radius: 6px;

    margin-bottom: 10px;

    font-size: 14px;
}

.selection-warning.show {
    display: block;
}

</style>


<script>

document.addEventListener('DOMContentLoaded', function () {

    /*
    |--------------------------------------------------------------------------
    | RENK SEÇİMİ
    |--------------------------------------------------------------------------
    */

    const colorButtons = document.querySelectorAll('.color-button');

    colorButtons.forEach(function (button) {

        button.addEventListener('click', function () {

            colorButtons.forEach(function (item) {
                item.classList.remove('selected');
            });

            this.classList.add('selected');

            document.getElementById('selectedColor').value =
                this.dataset.id;

            document.getElementById('selectedColorText').textContent =
                'Seçilen renk: ' + this.dataset.name;

        });

    });


    /*
    |--------------------------------------------------------------------------
    | BEDEN SEÇİMİ
    |--------------------------------------------------------------------------
    */

    const sizeButtons = document.querySelectorAll('.size-button');

    sizeButtons.forEach(function (button) {

        button.addEventListener('click', function () {

            sizeButtons.forEach(function (item) {
                item.classList.remove('selected');
            });

            this.classList.add('selected');

            document.getElementById('selectedSize').value =
                this.dataset.id;

            document.getElementById('selectedSizeText').textContent =
                'Seçilen beden: ' + this.dataset.name;

        });

    });


    /*
    |--------------------------------------------------------------------------
    | FORM KONTROLÜ
    |--------------------------------------------------------------------------
    */

    const form =
        document.getElementById('productSelectionForm');

    if (!form) {
        return;
    }


    form.addEventListener('submit', function (event) {

        const colorInput =
            document.getElementById('selectedColor');

        const sizeInput =
            document.getElementById('selectedSize');

        const warning =
            document.getElementById('selectionWarning');


        const hasColors =
            colorButtons.length > 0;

        const hasSizes =
            sizeButtons.length > 0;


        let valid = true;


        if (hasColors && !colorInput.value) {
            valid = false;
        }


        if (hasSizes && !sizeInput.value) {
            valid = false;
        }


        if (!valid) {

            event.preventDefault();

            warning.classList.add('show');

            return;
        }


        warning.classList.remove('show');

    });

});

</script>

@endsection